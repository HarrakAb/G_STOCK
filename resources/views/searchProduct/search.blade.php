<select style="overflow:scroll !important;" id="description" name="description[]" class="form-control form-control-lg description" required>
    <option value="" selected disabled>إختر المنتوج</option>
    @foreach ($articles as $article)
        <option value="{{ $article->description }}">
            {{ $article->description }}</option>
    @endforeach
</select>