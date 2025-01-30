@props([
    'id' => 0,
    'modal' => 'acc-modal',
    'edit' => true,
    'delete' => true,
    'updateRoute',
    'deleteRoute',
])

<td>
    {{ $slotOutside ?? '' }}
    <form action="{{ $deleteRoute }}" method="post" x-ref="formDelete{{ $id }}">
        @method('delete')
        @csrf
    </form>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="update-delete-dropdown-{{ $id }}" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="update-delete-dropdown-{{ $id }}">
            @if($edit)
                <li>
                    <button class="dropdown-item" x-on:click="
                        new bootstrap.Modal(document.getElementById('{{ $modal }}')).show();
                        $refs.form.setAttribute('action', '{{ $updateRoute }}');
                        $refs.form.setAttribute('method', 'post');
                        $refs.formMethod.value = 'put';
                        getData('{{ $updateRoute }}');
                    ">
                        <i class="fa fa-pencil"></i> Edit
                    </button>
                </li>
            @endif
            @if($delete)
                <li>
                    <button class="dropdown-item" x-on:click="Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this data!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, keep it',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $refs.formDelete{{ $id }}.submit();
                        }
                    })">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </li>
            @endif
            {{ $slot ?? '' }}
        </ul>
    </div>
</td>
