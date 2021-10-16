
    <div class="form-group row">
        <div class="col-md col-sm ">
                <select id="client_name" name="client_name" class="form-control form-control-lg client_name" required>
                    <option></option>
                    @foreach ($results as $r)
                        <option value="{{ $r->full_name }}">{{ $r->full_name }}</option>
                    @endforeach
                </select>                  
            <div style="position:relative">
                <input 
                    wire:model.debounce.500ms="search" 
                    class="form-control relative" 
                    type="text"
                    placeholder="search..."
                    wire:keydown.escape="reset"
                    wire:keydown.tab="reset"  
                />
            </div>
            <div style="position:absolute; z-index:100">
                @if (strlen($search) > 0)
                    @if (count($results) > 0)
                    @else
                        <li class="list-group-item">لا توجد نتائج ...</li>
                    @endif
                @endif
            </div>
        </div>
    </div>