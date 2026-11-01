@extends('layouts.app')

@section('content')
  <div id="content" class="container">
    <div class="d-flex justify-content-between align-turtles-center">
      <h1 id="title">Семейство черепах</h1>
      <button type="button" class="btn btn-primary js-form" data-url="{{ route('turtles.create') }}">
        <i class="fa-solid fa-plus"></i> Добавить
      </button>
    </div>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxxl-4 g-4">
      @forelse ($turtles as $turtle)
        <div class="col">
          <div class="card">
            <span class="content-type">{{ $turtle->type }}</span>
            <img src="{{ $turtle->image_url }}" class="img-fluid" alt="{{ $turtle->title }}">
            <div class="card-body">
              <h5 class="content-title">{{ $turtle->title }}</h5>
              <p class="content-description">{{ $turtle->description }}</p>
              <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary js-show"
                  data-url="{{ route('turtles.show', $turtle) }}">Подробнее</button>
                <button type="button" class="btn btn-primary js-form ms-auto" data-url="{{ route('turtles.edit', $turtle) }}"
                  aria-label="Изменить"><i class="fa-solid fa-pen"></i></button>
                <form method="POST" action="{{ route('turtles.destroy', $turtle) }}"
                  onsubmit="return confirm('Удалить черепаху?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" aria-label="Удалить"><i
                      class="fa-solid fa-trash"></i></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @empty
        <p>Черепах пока нет. Нажмите «Добавить».</p>
      @endforelse
    </div>
  </div>

  <div class="modal fade" id="turtleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content"></div>
    </div>
  </div>

  <div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content"></div>
    </div>
  </div>
@endsection
