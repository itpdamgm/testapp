<div>
    @if (!$uploaded)
        <div class="custom-file">
            <input type="file" class="form-control @error('{{$name}}') is-invalid @enderror" name="{{$name}}" id="{{$name}}"
                   wire:model="file" accept="{{$acceptExtension}}">
            <label class="custom-file-label " for="{{$name}}">Choose file
                <div class="kt-spinner kt-spinner--sm kt-spinner--success pull" wire:loading wire:target="file"></div>
            </label>
        </div>
    @else

        <div class="input-group">
            <input type="text" class="form-control " readonly value="{{ $filename }}">
            <div class="input-group-append">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opsi</button>
                <div class="dropdown-menu" style="">
                    <a href="{{ asset('storage/'.$folder.'/'.(isset($key)? $key.'/' : '').$filename) }}" class="dropdown-item" target="_blank">Show</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a href="javascript:;" class="dropdown-item" wire:click.prevent="delete()">Delete</a>
                </div>
            </div>
        </div>

    @endif
    <input type="hidden" name="{{$name}}" wire:model="filename" value="{{old($name,$filename??'')}}"
           @if($required) required @endif />

</div>
