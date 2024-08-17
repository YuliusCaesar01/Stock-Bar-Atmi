<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white :bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-dark-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <caption
                                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-dark :bg-gray-800">
                                Detail Barang
                            </caption>
                            @php
                                // Calculate the status
                                $minPlus10Percent = $barang->jumlah_minimal + $barang->jumlah_minimal * 0.1;
                                if (
                                    $barang->jumlah < $barang->jumlah_minimal ||
                                    $barang->jumlah > $barang->jumlah_maksimal
                                ) {
                                    $status = 'Danger';
                                    $statusColor = 'text-red-600';
                                    $statusDescription = 'Jumlah Stock dalam Kondisi kurang atau lebih dari batas yang ditentukan';
                                } elseif (
                                    $barang->jumlah >= $barang->jumlah_minimal &&
                                    $barang->jumlah <= $minPlus10Percent
                                ) {
                                    $status = 'Warning';
                                    $statusColor = 'text-yellow-500';
                                    $statusDescription = 'Jumlah Stock dalam kondisi hampir kurang atau lebih dari batas yang ditentukan';
                                } else {
                                    $status = 'Safe';
                                    $statusColor = 'text-green-600';
                                    $statusDescription = 'Kondisi Stock dalam Kondisi tidak Kurang atau Lebih dari batas yang ditentukan';
                                }
                            @endphp
                            <tbody>
                                <tr class="bg-white border-b :bg-gray-800 dark:border-gray-700">
                                    <td
                                        class="flex justify-center items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        {!! $barang->qr_code !!}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark text-lg">
                                        Jumlah Stock Barang
                                    </th>
                                    <td colspan="2"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark text-lg {{ $statusColor }}">
                                        : {{ $barang->jumlah }} {{ $barang->satuan }}
                                        <span
                                            class="ml-2 px-2 py-1 bg-gray-200 rounded text-xl cursor-pointer {{ $statusColor }}"
                                            data-popover-target="popover-{{ $barang->id }}">
                                            {{ $status }}
                                        </span>

                                        <!-- Popover -->
                                        <div data-popover id="popover-{{ $barang->id }}" role="tooltip"
                                            class="hidden absolute z-10 w-128 p-3 text-sm text-gray-500 bg-white border border-gray-200 rounded shadow-sm">
                                            {{ $statusDescription }}
                                            <div data-popper-arrow></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b :bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Nama Barang
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->nama_barang }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        No Item
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->no_item }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b :bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Kode Akun
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->kd_akun }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Kode Log
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->kode_log }}
                                    </td>
                                </tr>
                                {{-- <tr class="bg-white border-b :bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Jumlah
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->jumlah }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Satuan
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->satuan }}
                                    </td>
                                </tr> --}}
                                <tr class="bg-white border-b :bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Harga
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ 'Rp. ' . number_format($barang->harga, 0, ',', '.') }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Rak
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->rak }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b :bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Total
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ 'Rp. ' . number_format($barang->total, 0, ',', '.') }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Tanggal
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->tanggal }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b :bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Jumlah Minimal
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->jumlah_minimal }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Jumlah Maksimal
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->jumlah_maksimal }}
                                    </td>
                                </tr>
                                <tr class="bg-white border-b :bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        Merk
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->merk }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        No Katalog
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->no_katalog }}
                                    </td>
                                </tr>
                                <tr class="bg-white :bg-gray-800">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        No Akun
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->no_akun }}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        No Refferensi
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                                        : {{ $barang->no_reff }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Action Button --}}
                    <div class="mt-6 flex">
                        <a href="{{ route('barangs.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Back
                        </a>
                        @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                            <div class=" ms-3 inline-flex space-x-2">
                                <a href="{{ route('barangs.edit', $barang) }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>
                                {{-- <form id="delete-form-{{ $barang->id }}"
                                    action="{{ route('barangs.destroy', $barang) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $barang->id }})"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Remove</button>
                                </form> --}}
                                <!-- Detail Button -->
                                <button type="button" data-modal-target="logModal" data-modal-toggle="logModal"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Riwayat Transaksi
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div id="logModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b rounded-t ">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Log Details
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-hide="logModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <form id="bulk-delete-form" action="{{ route('logs.bulkDelete') }}" method="POST">
                        @csrf
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500" id="LogTable">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                            <th scope="col" class="px-6 py-3">
                                                <input type="checkbox" id="select-all" class="form-checkbox h-4 w-4">
                                            </th>
                                        @endif
                                        <th scope="col" class="px-6 py-3">Date</th>
                                        <th scope="col" class="px-6 py-3">Action</th>
                                        <th scope="col" class="px-6 py-3">Quantity</th>
                                        {{-- <th scope="col" class="px-6 py-3">Delete</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr class="bg-white border-b">
                                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                                <td class="px-6 py-4">
                                                    <input type="checkbox" name="log_ids[]"
                                                        value="{{ $log->id }}" class="form-checkbox h-4 w-4">
                                                </td>
                                            @endif
                                            <td class="px-6 py-4">{{ $log->created_at }}</td>
                                            <td class="px-6 py-4">{{ $log->action }}</td>
                                            <td class="px-6 py-4">{{ $log->quantity }}</td>
                                            {{-- <td class="px-6 py-4">
                                                <button type="button"
                                                    onclick="confirmDeleteLog({{ $log->id }})"
                                                    class="text-red-600 hover:text-red-900">Delete</button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                            <button type="button" id="bulk-delete-btn"
                                class="mt-4 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Bulk Delete
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteLog(logId) {
            Swal.fire({
                title: 'Hapus Log Ini?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-log-form-' + logId).submit();
                }
            })
        }

        document.getElementById('select-all').addEventListener('change', function(e) {
            const checkboxes = document.querySelectorAll('#LogTable tbody input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = e.target.checked;
            });
        });

        document.getElementById('bulk-delete-btn').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Log Yang Dipilih?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('bulk-delete-form').submit();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const popoverTrigger = document.querySelector('[data-popover-target="popover-{{ $barang->id }}"]');
            const popover = document.querySelector('#popover-{{ $barang->id }}');

            popoverTrigger.addEventListener('mouseenter', function() {
                popover.classList.remove('hidden');
            });

            popoverTrigger.addEventListener('mouseleave', function() {
                popover.classList.add('hidden');
            });
        });
    </script>
</x-app-layout>
