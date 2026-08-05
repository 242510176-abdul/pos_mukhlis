@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

@include('layouts.navbar')

<div class="container mt-4">

    <div class="card">
        <div class="card-body">

            <h3 class="mb-4">Tambah User</h3>

           <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    @include('users._form')
</form>

        </div>
    </div>

</div>

@endsection