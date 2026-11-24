@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
  <div class="container mt-4 mb-4" style="max-width: 480px">
    <h1 id="title">Регистрация</h1>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
          class="form-control @error('name') is-invalid @enderror">
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="username" class="form-label">Username (латиницей)</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" required
          class="form-control @error('username') is-invalid @enderror">
        @error('username')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required
          class="form-control @error('email') is-invalid @enderror">
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" id="password" name="password" required
          class="form-control @error('password') is-invalid @enderror">
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Повторите пароль</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
      <a href="{{ route('login') }}" class="btn btn-link">Уже есть аккаунт</a>
    </form>
  </div>
@endsection
