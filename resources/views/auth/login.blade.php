@extends('layouts.app')

@section('title', 'Вход')

@section('content')
  <div class="container mt-4 mb-4" style="max-width: 480px">
    <h1 id="title">Вход</h1>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
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

      <div class="form-check mb-3">
        <input type="checkbox" id="remember" name="remember" class="form-check-input">
        <label for="remember" class="form-check-label">Запомнить меня</label>
      </div>

      <button type="submit" class="btn btn-primary">Войти</button>
      <a href="{{ route('register') }}" class="btn btn-link">Регистрация</a>
    </form>
  </div>
@endsection
