<div class="form-group row ">
    <div class="col-md col-sm ">
        <select style="overflow:scroll !important;" id="description" name="descriptionn[]" class="form-control form-control-lg description" required>
            <option value="" selected disabled>إختر المنتوج</option>
            @foreach ($articles as $article)
                <option value="{{ $article->id }}">
                    {{ $article->description }}</option>
            @endforeach
        </select>
        <div style="position:relative">
            <input wire:model.debounce.500ms="search" class="form-control relative" type="text"
                placeholder="search..."wire:keydown.escape="reset" wire:keydown.tab="reset" />
        </div>
        <div style="position:absolute; z-index:100">
            @if (strlen($search) > 0)
                @if (count($articles) > 0)
                @else
                    <li class="list-group-item">لا توجد نتائج ...</li>
                @endif
            @endif
        </div>
    </div>
</div>