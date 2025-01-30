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
                    })
                },
                newData() {
                    $refs.formPasienCheckupId.value = '';
                },
            }">
                <x-acc-header createRoute="{{ route('web.apoteker') }}" />
                <div class="table-responsive">
                    <x-acc-table>
                        <thead>
                            <tr>
                                <th>Pasien</th>
                                <th>Checkup At</th>
                                <th>Total</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($get as $d)
                                <tr>
                                    <td>{{ $d->pasienCheckup->pasien }}</td>
                                    <td>{{ $d->pasienCheckup->checkup_at->format('d F Y') }}</td>
                                    <td>{{ number_format($d->total_price, 0, ',', '.') }}</td>
                                    <x-acc-update-delete :id="$d->id" updateRoute="{{ route('web.apoteker.update', [
                                        'id' => $d->id,
                                    ]) }}" deleteRoute="{{ route('web.apoteker.delete', [
                                        'id' => $d->id,
                                    ]) }}" :edit="false">
                                        <x-slot:slotOutside>
                                            <a href="{{ route('web.apoteker.pdf', [
                                                'id' => $d->id,
                                            ]) }}" class="btn btn-danger btn-sm" target="_blank">
                                                <i class="fas fa-file"></i>
                                                Export PDF
                                            </a>
                                        </x-slot:slotOutside>
                                    </x-acc-update-delete>
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
                        <label class="form-label">Pasien</label>
                        <x-acc-input type="select" model="pasien_checkup_id" x-ref="formPasienCheckupId">
                            <option value="">--Select Pasien--</option>
                            @foreach($pasienCheckup as $d)
                                <option value="{{ $d->id }}">{{ $d->pasien }} - {{ $d->checkup_at }}</option>
                            @endforeach
                        </x-acc-input>
                    </div>
                </div>
            </x-acc-form>
        </x-acc-modal>
    </x-acc-with-alert>
</x-layouts.app>
