<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight ">
            {{ __('Daftar Barang') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-8xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white :bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="barangTable"
                        class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-dark-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-700 dark:text-dark-400">
                            <tr>
                                {{-- <th scope="col" class="px-6 py-3">QR Code</th> --}}
                                {{-- <th scope="col" class="px-6 py-3">Status</th> --}}
                                <th scope="col" class="px-6 py-3">No Item</th>
                                <th scope="col" class="px-6 py-3">Nama Barang</th>
                                <th scope="col" class="px-6 py-3">Kode Akun</th>
                                <th scope="col" class="px-6 py-3">Kode Log</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
                                <th scope="col" class="px-6 py-3">Satuan</th>
                                {{-- <th scope="col" class="px-6 py-3">Harga</th>
                                <th scope="col" class="px-6 py-3">Total</th> --}}
                                <th scope="col" class="px-6 py-3">Rak</th>
                                <th scope="col" class="px-6 py-3">Tanggal</th>
                                <th scope="col" class="px-6 py-3">Jumlah Minimal</th>
                                <th scope="col" class="px-6 py-3">Jumlah Maksimal</th>
                                <th scope="col" class="px-6 py-3">No Katalog</th>
                                <th scope="col" class="px-6 py-3">Merk</th>
                                <th scope="col" class="px-6 py-3">No Akun</th>
                                <th scope="col" class="px-6 py-3">No Refferensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $daftar=App\Models\barang::get();
                            @endphp
                            @foreach ($daftar as $barang)
                                {{-- @php
                                    // Calculate the status
                                    $minPlus10Percent = $barang->jumlah_minimal + $barang->jumlah_minimal * 0.1;
                                    if (
                                        $barang->jumlah < $barang->jumlah_minimal ||
                                        $barang->jumlah > $barang->jumlah_maksimal
                                    ) {
                                        $status = 'Danger';
                                        $statusColor = 'text-red-600'; // Red color for Danger
                                    } elseif (
                                        $barang->jumlah >= $barang->jumlah_minimal &&
                                        $barang->jumlah <= $minPlus10Percent
                                    ) {
                                        $status = 'Warning';
                                        $statusColor = 'text-yellow-400'; // Yellow color for Warning
                                    } else {
                                        $status = 'Safe';
                                        $statusColor = 'text-green-600'; // Green color for Safe
                                    }
                                @endphp --}}

                                <tr class="bg-white border-b">
                                    {{-- <td class="px-6 py-4">
                                        <img src="data:image/svg+xml;base64,{{ $barang->qr_code }}" alt="QR Code">
                                    </td> --}}
                                    {{-- <td class="font-extrabold px-6 py-4 {{ $statusColor }}">{{ $status }}</td> --}}
                                    <td class="px-6 py-4">{{ $barang->no_item }}</td>
                                    <td class="px-6 py-4">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4">{{ $barang->kd_akun }}</td>
                                    <td class="px-6 py-4">{{ $barang->kode_log }}</td>
                                    <td class="px-6 py-4">{{ $barang->jumlah }}</td>
                                    <td class="px-6 py-4">{{ $barang->satuan }}</td>
                                    {{-- <td class="whitespace-nowrap">
                                        {{ 'Rp. ' . number_format($barang->harga, 0, ',', '.') }}</td>
                                    <td class="whitespace-nowrap">
                                        {{ 'Rp. ' . number_format($barang->total, 0, ',', '.') }}</td> --}}
                                    <td class="px-6 py-4">{{ $barang->rak }}</td>
                                    <td class="px-6 py-4">{{ $barang->tanggal }}</td>
                                    <td class="px-6 py-4">{{ $barang->jumlah_minimal }}</td>
                                    <td class="px-6 py-4">{{ $barang->jumlah_maksimal }}</td>
                                    <td class="px-6 py-4">{{ $barang->no_katalog }}</td>
                                    <td class="px-6 py-4">{{ $barang->merk }}</td>
                                    <td class="px-6 py-4">{{ $barang->no_akun }}</td>
                                    <td class="px-6 py-4">{{ $barang->no_reff }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-white rounded-lg shadow m-4 dark:bg-dark-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-700 sm:text-center dark:text-gray-700">© 2024 <a href="http://atmi.co.id"
                    class="hover:underline">PT. ATMI SOLO</a>. All Rights Reserved.
            </span>
            @include('clock')
        </div>
    </footer>
</x-app-layout>
