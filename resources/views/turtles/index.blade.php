@extends('layouts.app')

@section('content')
  <div id="content" class="container">
    <h1 id="title">
      @if ($owner->is(auth()->user()))
        Мои черепахи
      @else
        Черепахи: {{ $owner->name }}
      @endif
    </h1>
    <p><a href="{{ route('users.index') }}">Все пользователи</a></p>

    @unless ($owner->is(auth()->user()))
      @php($isFriend = auth()->user()->isFriendWith($owner))
      <form method="POST" action="{{ route($isFriend ? 'friends.destroy' : 'friends.store', $owner, false) }}"
        class="mb-3">
        @csrf
        @if ($isFriend)
          @method('DELETE')
        @endif
        <button type="submit" class="btn btn-primary">
          {{ $isFriend ? 'Удалить из друзей' : 'Добавить в друзья' }}
        </button>
      </form>
    @endunless

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxxl-4 g-4">
      @forelse ($turtles as $turtle)
        <div class="col">
          <div class="card {{ $turtle->trashed() ? 'opacity-50' : '' }}">
            <span class="content-type">{{ $turtle->type }}</span>
            <img src="{{ $turtle->image_url }}" class="img-fluid" alt="{{ $turtle->title }}">
            <div class="card-body">
              <h5 class="content-title">
                {{ $turtle->title }}
                @if ($turtle->trashed())
                  <span class="badge text-bg-danger">удалена</span>
                @endif
              </h5>
              <p class="content-description">{{ $turtle->description }}</p>
              <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary js-show"
                  data-url="{{ route('turtles.show', $turtle, false) }}">Подробнее</button>
                <div class="ms-auto d-flex gap-2">
                  @if ($turtle->trashed())
                    @can('is-admin')
                      <form method="POST" action="{{ route('turtles.restore', ['id' => $turtle->id], false) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary" aria-label="Восстановить"><i
                            class="fa-solid fa-rotate-left"></i></button>
                      </form>
                      <form method="POST" action="{{ route('turtles.force-delete', ['id' => $turtle->id], false) }}"
                        onsubmit="return confirm('Удалить навсегда?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" aria-label="Удалить навсегда"><i
                            class="fa-solid fa-ban"></i></button>
                      </form>
                    @endcan
                  @else
                    @can('update-turtle', $turtle)
                      <button type="button" class="btn btn-primary js-form"
                        data-url="{{ route('turtles.edit', $turtle, false) }}" aria-label="Изменить"><i
                          class="fa-solid fa-pen"></i></button>
                    @endcan
                    @can('delete-turtle', $turtle)
                      <form method="POST" action="{{ route('turtles.destroy', $turtle, false) }}"
                        onsubmit="return confirm('Удалить черепаху?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" aria-label="Удалить"><i
                            class="fa-solid fa-trash"></i></button>
                      </form>
                    @endcan
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      @empty
        <p>Черепах пока нет.</p>
      @endforelse
    </div>
  </div>
@endsection
