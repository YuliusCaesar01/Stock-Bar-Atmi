<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight ">
            {{ __('Report Kondisi Stock Barang') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            @php
                // Function to determine the status and color
                function getStatusAndColor($barang)
                {
                    $minPlus10Percent = $barang->jumlah_minimal + $barang->jumlah_minimal * 0.1;
                    if ($barang->jumlah < $barang->jumlah_minimal || $barang->jumlah > $barang->jumlah_maksimal) {
                        return ['Danger', 'text-red-600'];
                    } elseif ($barang->jumlah >= $barang->jumlah_minimal && $barang->jumlah <= $minPlus10Percent) {
                        return ['Warning', 'text-yellow-400'];
                    } else {
                        return ['Safe', 'text-green-600'];
                    }
                }
            @endphp

            <div class="flex">
                <div class="flex items-center me-4">
                    <input type="checkbox" id="toggleSafe" checked class="form-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="Safe" class="ms-2 text-sm font-medium text-gray-900 ">Safe</label>
                </div>
                <div class="flex items-center me-4">
                    <input type="checkbox" id="toggleWarning" checked class="form-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="Warning" class="ms-2 text-sm font-medium text-gray-900 ">Warning</label>
                </div>
                <div class="flex items-center me-4">
                    <input type="checkbox" id="toggleDanger" checked class="form-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    <label for="Danger" class="ms-2 text-sm font-medium text-gray-900 ">Danger</label>
                </div>
            </div>

            @foreach (['Safe', 'Warning', 'Danger'] as $status)
                @php
                    // Filter the $barangs collection based on the status
                    $filteredBarangs = $barangs->filter(function ($barang) use ($status) {
                        [$itemStatus, $color] = getStatusAndColor($barang);
                        return $itemStatus === $status;
                    });

                    // Get the count of filtered items
                    $statusCount = $filteredBarangs->count();
                @endphp

                @if ($statusCount > 0)
                    <div class="status-section" id="{{ strtolower($status) }}Section">
                        <h3 class="font-semibold text-lg text-gray-800 dark:text-dark-100 leading-tight mt-6">
                            {{ __($status . ' Stock Items') }} ({{ $statusCount }})
                        </h3>

                        <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg mt-4">
                            <table id="{{ strtolower($status) }}Table"
                                class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-dark-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-700 dark:text-dark-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">QR Code</th>
                                        <th scope="col" class="px-6 py-3">Status</th>
                                        <th scope="col" class="px-6 py-3">No Item</th>
                                        <th scope="col" class="whitespace-nowrap px-6 py-3">Nama Barang</th>
                                        <th scope="col" class="px-6 py-3">Jumlah</th>
                                        <th scope="col" class="px-6 py-3">Satuan</th>
                                        <th scope="col" class="px-6 py-3">Harga</th>
                                        <th scope="col" class="px-6 py-3">Total</th>
                                        <th scope="col" class="px-6 py-3">Jumlah Minimal</th>
                                        <th scope="col" class="px-6 py-3">Jumlah Maksimal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($filteredBarangs as $barang)
                                        @php
                                            [$itemStatus, $statusColor] = getStatusAndColor($barang);
                                        @endphp
                                        <tr
                                            class="bg-white border-b whitespace=nowrap">
                                            <td class="px-6 py-4">
                                                <img src="data:image/svg+xml;base64,{{ $barang->qr_code }}"
                                                    alt="QR Code">
                                            </td>
                                            <td class="px-6 py-4 {{ $statusColor }}">{{ $itemStatus }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $barang->no_item }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $barang->nama_barang }}</td>
                                            <td class="px-6 py-4">{{ $barang->jumlah }}</td>
                                            <td class="px-6 py-4">{{ $barang->satuan }}</td>
                                            <td class="whitespace-nowrap">
                                                {{ 'Rp. ' . number_format($barang->harga, 0, ',', '.') }}</td>
                                            <td class="whitespace-nowrap">
                                                {{ 'Rp. ' . number_format($barang->total, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4">{{ $barang->jumlah_minimal }}</td>
                                            <td class="px-6 py-4">{{ $barang->jumlah_maksimal }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <script>
        document.getElementById('toggleSafe').addEventListener('change', function() {
            document.getElementById('safeSection').style.display = this.checked ? 'block' : 'none';
        });
        document.getElementById('toggleWarning').addEventListener('change', function() {
            document.getElementById('warningSection').style.display = this.checked ? 'block' : 'none';
        });
        document.getElementById('toggleDanger').addEventListener('change', function() {
            document.getElementById('dangerSection').style.display = this.checked ? 'block' : 'none';
        });
    </script>
</x-app-layout>
