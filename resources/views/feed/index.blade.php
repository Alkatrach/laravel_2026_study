@extends('layouts.app')

@section('title', 'Лента')

@section('content')
  <div id="content" class="container">
    <h1 id="title">Лента друзей</h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxxl-4 g-4">
      @forelse ($turtles as $turtle)
        <div class="col">
          <div class="card">
            <span class="content-type">{{ $turtle->type }}</span>
            <img src="{{ $turtle->image_url }}" class="img-fluid" alt="{{ $turtle->title }}">
            <div class="card-body">
              <h5 class="content-title">{{ $turtle->title }}</h5>
              <p class="small">
                <a href="{{ route('users.show', $turtle->user) }}">{{ $turtle->user->name }}</a>,
                {{ $turtle->created_at->format('d.m.Y H:i') }}
              </p>
              <p class="content-description">{{ $turtle->description }}</p>
              <button type="button" class="btn btn-primary js-show"
                data-url="{{ route('turtles.show', $turtle, false) }}">Подробнее</button>
            </div>
          </div>
        </div>
      @empty
        <p>Здесь появятся черепахи ваших друзей. Добавьте друзей на странице <a
            href="{{ route('users.index') }}">«Пользователи»</a>.</p>
      @endforelse
    </div>
  </div>
@endsection
