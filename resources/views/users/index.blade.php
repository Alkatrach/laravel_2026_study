@extends('layouts.app')

@section('title', 'Пользователи')

@section('content')
  <div id="content" class="container">
    <h1 id="title">Пользователи</h1>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="list-group mb-4">
      @foreach ($users as $user)
        <div class="list-group-item d-flex justify-content-between align-items-center gap-2">
          <a href="{{ route('users.show', $user) }}">
            {{ $user->name }} <small>{{ '@' . $user->username }}</small>
          </a>
          <div class="d-flex align-items-center gap-2">
            <span class="badge text-bg-primary">{{ $user->turtles_count }}</span>
            @if (! $user->is(auth()->user()))
              @if ($friendIds->contains($user->id))
                <form method="POST" action="{{ route('friends.destroy', $user, false) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Удалить из друзей</button>
                </form>
              @else
                <form method="POST" action="{{ route('friends.store', $user, false) }}">
                  @csrf
                  <button type="submit" class="btn btn-primary btn-sm">В друзья</button>
                </form>
              @endif
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
