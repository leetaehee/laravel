<div class="form-group">
    <label for="title">제목</label>
    <input type="text"
           name="title"
           id="title"
           value="{{ old('title', $article->title) }}"
           class="form-control">
    {!! $errors->first('title', '<span class="form-error">:message</span>') !!}
</div>

<div class="form-group">
    <label for="content">본문</label>
    <textarea name="content"
              id="content"
              rows="10"
              class="form-control">{{ old('content', $article->content) }}</textarea>
    {!! $errors->first('content', '<span class="form-error">:message</span>') !!}
</div>