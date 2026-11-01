<div class="modal-header">
  <h5 class="modal-title">{{ $turtle->title }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  <img src="{{ $turtle->image_url }}" class="modal-img img-fluid mb-3" alt="{{ $turtle->title }}">
  {!! $turtle->details_html !!}
  @if ($turtle->publication_date)
    <p class="mb-0 small">Опубликовано: {{ $turtle->publication_date->format('d.m.Y') }}</p>
  @endif
</div>
