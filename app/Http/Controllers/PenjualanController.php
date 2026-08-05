<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            ->with('user')
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                })
                ->orWhere('metode_pembayaran', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => $user->id,
                'status'  => 'OPEN'
            ],
            [
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%");
            })
            ->orderBy('nama')
            ->get();

        $mode = 'create';

        return view('penjualan.pos', compact(
            'sale',
            'products',
            'mode'
        ));
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load([
            'user',
            'itemPenjualan.produk'
        ]);

        return view('penjualan.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        if ($penjualan->status === 'COMPLETED') {
            abort(403, 'Transaksi sudah selesai.');
        }

        $sale = $penjualan;

        $sale->load([
            'itemPenjualan.produk'
        ]);

        $products = Produk::orderBy('nama')->get();

        $mode = 'edit';

        return view('penjualan.pos', compact(
            'sale',
            'products',
            'mode'
        ));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS,TRANSFER'
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with(
                'errors',
                'Transaksi sudah diproses.'
            );
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with(
                'errors',
                'Keranjang masih kosong.'
            );
        }

        DB::transaction(function () use ($penjualan, $request) {
            $total = $penjualan
                ->itemPenjualan()
                ->sum('subtotal');

            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran'  => $total,
                'status'            => 'COMPLETED',
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with(
                'success',
                'Transaksi berhasil diselesaikan.'
            );
    }

    public function destroy(Penjualan $penjualan)
    {
        // Memastikan transaksi COMPLETED tidak dapat dihapus
        if ($penjualan->status !== 'OPEN') {
            return back()->with(
                'errors',
                'Transaksi yang sudah selesai (COMPLETED) tidak dapat dihapus.'
            );
        }

        DB::transaction(function () use ($penjualan) {
            foreach ($penjualan->itemPenjualan as $item) {
                $item->produk->increment(
                    'stok',
                    $item->kuantitas
                );
            }

            $penjualan
                ->itemPenjualan()
                ->delete();

            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with(
                'success',
                'Transaksi berhasil dibatalkan.'
            );
    }
}