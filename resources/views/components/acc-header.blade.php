@props([
    'isCreate' => true,
    'modal' => 'acc-modal',
    'createRoute',
])

<div x-data="{
    perPage: {{ request()->get('perPage', 10) }},
    search: '{{ request()->get('search', '') }}',
    init() {
        $watch('search', value => {
            window.location = `{{ url()->current() }}?search=${value}&perPage=${this.perPage}`;
        });
        $watch('perPage', value => {
            window.location = `{{ url()->current() }}?search=${this.search}&perPage=${value}`;
        });
    }
}">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="float-start">
                @if($isCreate)
                    <x-acc-create-btn :$modal :$createRoute />
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <select class="form-control" x-model="perPage">
                <option value="10">10 Records Per Page</option>
                <option value="25">25 Records Per Page</option>
                <option value="50">50 Records Per Page</option>
                <option value="100">100 Records Per Page</option>
            </select>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text" id="search-icon">
                    <i class="fa fa-search"></i>
                </span>
                <input type="text" class="form-control" aria-label="Search" aria-describedby="search-icon" placeholder="Search..." x-model.debounce="search">
            </div>
        </div>
        {{ $slot->isEmpty() ? '' : $slot }}
    </div>
</div>
