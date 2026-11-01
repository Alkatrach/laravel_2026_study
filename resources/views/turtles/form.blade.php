@php($isEdit = $turtle->exists)

<form method="POST" action="{{ $isEdit ? route('turtles.update', $turtle) : route('turtles.store') }}"
  enctype="multipart/form-data" class="js-turtle-form" novalidate>
  @csrf
  @if ($isEdit)
    @method('PUT')
  @endif

  <div class="modal-header">
    <h5 class="modal-title">{{ $isEdit ? 'Редактирование' : 'Новая черепаха' }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body">
    <div class="mb-3">
      <label for="f-title" class="form-label">Название</label>
      <input type="text" id="f-title" name="title" class="form-control" maxlength="255" required
        value="{{ $turtle->title }}">
      <div class="invalid-feedback">Заполните название</div>
    </div>

    <div class="mb-3">
      <label for="f-type" class="form-label">Семейство</label>
      <input type="text" id="f-type" name="type" class="form-control" maxlength="255" required
        value="{{ $turtle->type }}">
      <div class="invalid-feedback">Заполните семейство</div>
    </div>

    <div class="mb-3">
      <label for="f-description" class="form-label">Описание для карточки</label>
      <textarea id="f-description" name="description" class="form-control" rows="3" required>{{ $turtle->description }}</textarea>
      <div class="invalid-feedback">Заполните описание</div>
    </div>

    <div class="mb-3">
      <label for="f-details" class="form-label">Подробности для окна</label>
      <textarea id="f-details" name="details" class="form-control" rows="4">{{ $turtle->details }}</textarea>
      <div class="form-text">Каждый абзац с новой строки. Подсказка при наведении: {{ '{{слово|пояснение}}' }}</div>
      <div class="invalid-feedback"></div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="f-publication" class="form-label">Дата публикации</label>
        <input type="date" id="f-publication" name="publication_date" class="form-control"
          value="{{ $turtle->publication_date?->format('Y-m-d') }}">
        <div class="invalid-feedback"></div>
      </div>
      <div class="col-md-6 mb-3">
        <label for="f-image" class="form-label">Изображение</label>
        <input type="file" id="f-image" name="image" class="form-control" accept="image/*">
        <div class="invalid-feedback"></div>
      </div>
    </div>

    @if ($isEdit && $turtle->image)
      <img src="{{ $turtle->image_url }}" class="img-thumbnail" style="max-width: 200px" alt="{{ $turtle->title }}">
    @endif
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
    <button type="submit" class="btn btn-primary">Сохранить</button>
  </div>
</form>
