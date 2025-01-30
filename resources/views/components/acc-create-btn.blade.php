@props([
    'modal' => 'acc-modal',
    'createRoute',
])
<div>
    <div class="float-end">
        <button class="btn btn-success" x-on:click="
            new bootstrap.Modal(document.getElementById('{{ $modal }}')).show();
            $refs.form.setAttribute('action', '{{ $createRoute }}');
            $refs.form.setAttribute('method', 'post');
            $refs.formMethod.value = 'post';
            newData();
        ">
            <i class="fa fa-plus-circle"></i>
            Create
        </button>
    </div>
</div>
