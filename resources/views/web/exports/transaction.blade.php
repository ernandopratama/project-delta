<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="wrapper">
    <div class="main">
        <main class="content">
            <h3>
                Atas Nama : {{ $get->pasienCheckup->pasien }}
                <br>
                Check Up Tanggal : {{ $get->pasienCheckup->checkup_at->format('d F Y') }}
                <br>
                Total Pembayaran : Rp. {{ number_format($get->total_price, 0, ',', '.') }}
            </h3>
            <x-acc-table>
                <thead>
                    <tr>
                        <th>Obat</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($get->details as $detail)
                        <td>{{ $detail->pasienCheckupResep->obat }}</td>
                        <td>{{ $detail->pasienCheckupResep->qty }}</td>
                        <td>Rp. {{ number_format($detail->price, 0, ',', '.') }}</td>
                    @endforeach
                </tbody>
            </x-acc-table>
        </main>
    </div>
    <script>
        setTimeout(() => {
            window.print();
        }, 1000);
    </script>
</div>
