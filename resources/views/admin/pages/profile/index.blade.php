@extends('admin.layouts.app');

@section('title', 'Profile')

@section('subtitle', 'Manage my profile');

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin-profile-update') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" required value="{{ $user->name }}">
                  </div>
                  <div class="form-group">
                      <label for="store_name">Nama Toko</label>
                      <input type="text" name="store_name" id="store_name" class="form-control" required value="{{ $user->store_name }}">
                    </div>
                  <div class="form-group">
                    <label for="phone">Telepon</label>
                    <input type="tel" name="phone" id="phone" class="form-control" required value="{{ $user->phone }}">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required value="{{ $user->email }}">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small class="text-muted">Silahkan diisi jika ingin mengubah password</small>
                  </div>
                  <button type="submit" class="btn btn-primary" style="float: right">Update profil</button>
            </form>
        </div>
    </div>
@endsection
{{--  --}}
