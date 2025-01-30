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
                        $refs.formPasienCheckupId.value = data.pasien_checkup_id;
                        $refs.formObatId.value = data.obat_id + '|' + data.obat;
                        $refs.formQty.value = data.qty;
                    })
                },
                newData() {
                    $refs.formPasienCheckupId.value = '{{ $checkupId }}';
                    $refs.formObatId.value = '';
                    $refs.formQty.value = '';
                },
            }">
                <x-acc-header createRoute="{{ route('web.dokter-resep.store') }}" />
                <div class="table-responsive">
                    <x-acc-table>
                        <thead>
                            <tr>
                                <th>Obat Id</th>
                                <th>Obat</th>
                                <th>Qty</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($get as $d)
                                <tr>
                                    <td>{{ $d->obat_id }}</td>
                                    <td>{{ $d->obat }}</td>
                                    <td>{{ $d->qty }}</td>
                                    <x-acc-update-delete :id="$d->id" updateRoute="{{ route('web.dokter-resep.update', [
                                        'id' => $d->id,
                                    ]) }}" deleteRoute="{{ route('web.dokter-resep.delete', [
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
                <input type="hidden" name="pasien_checkup_id" x-ref="formPasienCheckupId" />
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Obat</label>
                        <x-acc-input type="select" model="obat_id" x-ref="formObatId">
                            <option value="">--Select Obat--</option>
                            @foreach($medicines as $d)
                                <option value="{{ $d['id'] }}|{{ $d['name'] }}">{{ $d['name'] }}</option>
                            @endforeach
                        </x-acc-input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Qty</label>
                        <x-acc-input type="number" model="qty" placeholder="Qty" x-ref="formQty" />
                    </div>
                </div>
            </x-acc-form>
        </x-acc-modal>
    </x-acc-with-alert>
</x-layouts.app>
