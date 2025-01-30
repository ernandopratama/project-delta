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
                        $refs.formRole.value = data.role_id;
                        $refs.formName.value = data.name;
                        $refs.formEmail.value = data.email;
                    })
                },
                newData() {
                    $refs.formRole.value = '';
                    $refs.formName.value = '';
                    $refs.formEmail.value = '';
                    $refs.formPassword.value = '';
                },
            }">
                <x-acc-header createRoute="{{ route('web.user.store') }}" />
                <div class="table-responsive">
                    <x-acc-table>
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($get as $d)
                                <tr>
                                    <td>{{ $d->role->name }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->email }}</td>
                                    <x-acc-update-delete :id="$d->id" updateRoute="{{ route('web.user.update', [
                                        'id' => $d->id,
                                    ]) }}" deleteRoute="{{ route('web.user.delete', [
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
                        <label class="form-label">Role</label>
                        <x-acc-input type="select" model="role_id" x-ref="formRole">
                            <option value="">--Select Role--</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </x-acc-input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <x-acc-input model="name" placeholder="Name" x-ref="formName" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <x-acc-input type="email" model="email" placeholder="Email" x-ref="formEmail" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <x-acc-input type="password" model="password" placeholder="*****" x-ref="formPassword" />
                    </div>
                </div>
            </x-acc-form>
        </x-acc-modal>
    </x-acc-with-alert>
</x-layouts.app>
