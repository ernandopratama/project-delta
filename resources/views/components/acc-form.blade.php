@props(['submit', 'reset' => 'resetAll', 'method' => 'post'])

<div {{ $attributes->merge(['class' => 'container mt-2']) }}>
    <form action="{{ $submit }}" method="{{ $method }}" x-ref="form" enctype="multipart/form-data">
        <input type="hidden" name="_method" x-ref="formMethod">
        @csrf
        <div class="container">
            <div class="row">
                {{ $slot }}
            </div>
        </div>

        @if (isset($actions))
            <div class="row">
                {{ $actions }}
            </div>
        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="float-end">
                        <button
                            class="btn btn-warning"
                            type="reset">
                            <i class="fa fa-redo"></i>
                            Reset
                        </button>
                        <button
                            class="btn btn-success"
                            type="submit">
                            <i class="fa fa-save"></i>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
