<div class="modal-header">
  <h5 class="modal-title">{{ $turtle->title }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  <img src="{{ $turtle->image_url }}" class="modal-img img-fluid mb-3" alt="{{ $turtle->title }}">
  {!! $turtle->details_html !!}
  <p class="mb-0 small">Автор: {{ $turtle->user?->name ?? '—' }}</p>
  @if ($turtle->publication_date)
    <p class="mb-0 small">Опубликовано: {{ $turtle->publication_date->format('d.m.Y') }}</p>
  @endif

  <hr>

  <h6>Комментарии ({{ $comments->count() }})</h6>

  @forelse ($comments as $comment)
    @php($fromFriend = $friendIds->contains($comment->user_id))
    <div class="mb-2 p-2 rounded {{ $fromFriend ? 'border border-warning border-2' : '' }}">
      <div class="small">
        @if ($fromFriend)
          <i class="fa-solid fa-user-group" title="Друг"></i>
        @endif
        <strong>{{ $comment->user->name }}</strong>
        {{ $comment->created_at->format('d.m.Y H:i') }}
      </div>
      <div>{{ $comment->body }}</div>
    </div>
  @empty
    <p class="small">Комментариев пока нет.</p>
  @endforelse

  <form method="POST" action="{{ route('comments.store', $turtle, false) }}" class="js-comment-form mt-3"
    data-reload="{{ route('turtles.show', $turtle, false) }}">
    @csrf
    <textarea name="body" class="form-control mb-1" rows="2" maxlength="1000" required
      placeholder="Ваш комментарий"></textarea>
    <div class="invalid-feedback mb-2"></div>
    <button type="submit" class="btn btn-primary mt-1">Отправить</button>
  </form>
</div>
