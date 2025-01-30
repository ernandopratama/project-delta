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
                        $refs.formPasien.value = data.pasien;
                        $refs.formCheckupAt.value = new Date(data.checkup_at).toISOString().split('T')[0];
                        $refs.formTinggiBadan.value = data.tinggi_badan;
                        $refs.formBeratBadan.value = data.berat_badan;
                        $refs.formSystole.value = data.systole;
                        $refs.formDiastole.value = data.diastole;
                        $refs.formHeartRate.value = data.heart_rate;
                        $refs.formRespirationRate.value = data.respiration_rate;
                        $refs.formTemperature.value = data.temperature;
                        $refs.formResult.value = data.result;
                    })
                },
                newData() {
                    $refs.formPasien.value = '';
                    $refs.formCheckupAt.value = '';
                    $refs.formTinggiBadan.value = '';
                    $refs.formBeratBadan.value = '';
                    $refs.formSystole.value = '';
                    $refs.formDiastole.value = '';
                    $refs.formHeartRate.value = '';
                    $refs.formRespirationRate.value = '';
                    $refs.formTemperature.value = '';
                    $refs.formResult.value = '';
                    $refs.formFile.value = '';
                },
            }">
                <x-acc-header createRoute="{{ route('web.dokter-checkup') }}" />
                <div class="table-responsive">
                    <x-acc-table>
                        <thead>
                            <tr>
                                <th>Pasien</th>
                                <th>Checkup At</th>
                                <th>Tinggi Badan</th>
                                <th>Berat Badan</th>
                                <th>Systole</th>
                                <th>Diastole</th>
                                <th>Heart Rate</th>
                                <th>Respiration Rate</th>
                                <th>Temperature</th>
                                <th>Result</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($get as $d)
                                <tr>
                                    <td>{{ $d->pasien }}</td>
                                    <td>{{ $d->checkup_at->format('d F Y') }}</td>
                                    <td>{{ $d->tinggi_badan }}</td>
                                    <td>{{ $d->berat_badan }}</td>
                                    <td>{{ $d->systole }}</td>
                                    <td>{{ $d->diastole }}</td>
                                    <td>{{ $d->heart_rate }}</td>
                                    <td>{{ $d->respiration_rate }}</td>
                                    <td>{{ $d->temperature }}</td>
                                    <td>{{ $d->result }}</td>
                                    <td>
                                        {{ $d?->getFirstMediaUrl('file') }}
                                    </td>
                                    <td>
                                        {!! $d->status ?
                                            '<span class="badge bg-success">Sudah Diproses</span>' :
                                            '<span class="badge bg-warning">Belum Diproses</span>'
                                        !!}
                                    </td>
                                    <x-acc-update-delete :id="$d->id" updateRoute="{{ route('web.dokter-checkup.update', [
                                        'id' => $d->id,
                                    ]) }}" deleteRoute="{{ route('web.dokter-checkup.delete', [
                                        'id' => $d->id,
                                    ]) }}">
                                        <x-slot:slotOutside>
                                            @if($d->status == 0)
                                                <a href="{{ route('web.dokter-resep', [
                                                    'checkupId' => $d->id,
                                                ]) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                    Resep
                                                </a>
                                            @endif
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
                        <x-acc-input model="pasien" placeholder="Pasien" x-ref="formPasien" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Checkup At</label>
                        <x-acc-input type="date" model="checkup_at" x-ref="formCheckupAt" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tinggi Badan</label>
                        <x-acc-input model="tinggi_badan" placeholder="Tinggi Badan" x-ref="formTinggiBadan" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Berat Badan</label>
                        <x-acc-input model="berat_badan" placeholder="Berat Badan" x-ref="formBeratBadan" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Systole</label>
                        <x-acc-input model="systole" placeholder="Systole" x-ref="formSystole" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Diastole</label>
                        <x-acc-input model="diastole" placeholder="Diastole" x-ref="formDiastole" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heart Rate</label>
                        <x-acc-input model="heart_rate" placeholder="Heart Rate" x-ref="formHeartRate" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Respiration Rate</label>
                        <x-acc-input model="respiration_rate" placeholder="Respiration Rate" x-ref="formRespirationRate" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Temperature</label>
                        <x-acc-input model="temperature" placeholder="Temperature" x-ref="formTemperature" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File</label>
                        <x-acc-input type="file" model="file" x-ref="formFile" accept="application/pdf" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Result</label>
                        <x-acc-input type="textarea" model="result" placeholder="Result" x-ref="formResult" />
                    </div>
                </div>
            </x-acc-form>
        </x-acc-modal>
    </x-acc-with-alert>
</x-layouts.app>
