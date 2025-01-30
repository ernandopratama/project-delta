@props([
    'id' => 'acc-modal',
    'title' => 'Title',
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}-label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                @if (isset($actions))
                    <div class="text-center">
                        {{ $actions }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
