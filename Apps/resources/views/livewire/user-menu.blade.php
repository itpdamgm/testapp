<div class="form-group row">
    <div class="col-lg-12">
        <input type="hidden" wire:model="selectedMenus" class="form-control" required data-parsley-required="true" name="selectedMenus">

        <label class="form-control-label">Master Menu : </label>
        <div class="row">
        @foreach(config('constants.menu') as $menu)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <span>{!! $menu['icon'] !!}</span>
                <label class="kt-font-bold">
                   {{ $menu['title'] }}
                </label>
                @if(isset($menu["sub_menu"]))
                    <div class="row mt-3">
                    @foreach($menu["sub_menu"] as $sub_menu)
                        <div class="col-12 ml-4">
                            <label class="kt-checkbox">
                                <input type="checkbox" class="form-control" value="{{ $sub_menu['id'] }}" wire:model="selectedMenus">
                                {{ $sub_menu['title'] }}
                                <span></span>
                            </label>
                        </div>
                    @endforeach
                    </div>
                @endif
            </div>
        @endforeach
        </div>
    </div>
</div>
