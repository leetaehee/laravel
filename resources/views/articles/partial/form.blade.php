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

<div class="form-group">
    <label for="tags">태그</label>
    <select id="tags"
            name="tags[]"
            class="form-control"
            multiple>
        @foreach ($allTags as $tag)
            <option value="{{ $tag->id }}"
                    {{ $article->tags->contains($tag->id) ? 'selected="selected"' : '' }}>
                {{ $tag->name }}
            </option>
        @endforeach
    </select>
    {!! $errors->first('tags', '<span class="form-error">:message</span>') !!}
</div>