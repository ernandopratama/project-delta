<x-layouts.app>
    <x-slot:title>
        {{ $title ?? '' }}
    </x-slot:title>
    <x-acc-with-alert>
        <h1 class="h3 mb-3">
            {{ $title ?? '' }}
        </h1>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $title ?? '' }} Data</h5>
            </div>
            <div class="card-body" x-data="{
                getData(url) {
                    fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        $refs.formName.value = data.name;
                        $refs.formDescription.value = data.description;
                    })
                },
                newData() {
                    $refs.formName.value = '';
                    $refs.formDescription.value = '';
                },
            }">
                <x-acc-header createRoute="{{ route('web.role') }}" />
                <div class="table-responsive">
                    <x-acc-table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($get as $d)
                                <tr>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->description }}</td>
                                    <x-acc-update-delete :id="$d->id" updateRoute="{{ route('web.role.update', [
                                        'id' => $d->id,
                                    ]) }}" deleteRoute="{{ route('web.role.delete', [
                                        'id' => $d->id,
                                    ]) }}" />
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100" class="text-center">
                                        No Data Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </x-acc-table>
                </div>
                <div class="float-end">
                    {{ $get->links() }}
                </div>
            </div>
        </div>

        {{-- Create / Update Modal --}}
        <x-acc-modal title="Role">
            <x-acc-form submit="save">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <x-acc-input model="name" placeholder="Name" x-ref="formName" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <x-acc-input type="textarea" model="description" placeholder="Description" x-ref="formDescription" />
                    </div>
                </div>
            </x-acc-form>
        </x-acc-modal>
    </x-acc-with-alert>
</x-layouts.app>
