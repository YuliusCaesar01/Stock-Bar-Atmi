<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Setup Nama Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="barangTable" class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-dark-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-700 dark:text-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nomor Item</th>
                                <th scope="col" class="px-6 py-3">Kode Log</th>
                                <th scope="col" class="px-6 py-3">Kode Akun</th>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Nama Barang</th>
                                <th scope="col" class="px-6 py-3">Harga</th>
                                <th scope="col" class="px-6 py-3">Satuan</th>
                                <th scope="col" class="px-6 py-3">Stock Minimal</th>
                                <th scope="col" class="px-6 py-3">Stock Maksimal</th>
                                <th scope="col" class="px-6 py-3">Rak</th>
                                <th scope="col" class="px-6 py-3">No Katalog</th>
                                <th scope="col" class="px-6 py-3">Merk/Vendor</th>
                                <th scope="col" class="px-6 py-3">No Refferensi</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nama as $barang)
                                <tr>
                                    <td class="px-6 py-4">{{ $barang->no_item }}</td>
                                    <td class="px-6 py-4">{{ $barang->kode_log }}</td>
                                    <td class="px-6 py-4">{{ $barang->kd_akun }}</td>
                                    <td class="px-6 py-4">{{ $barang->no }}</td>
                                    <td class="px-6 py-4">{{ $barang->nama_barang }}</td>
                                    <td>{{ 'Rp. ' . number_format($barang->harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">{{ $barang->satuan }}</td>
                                    <td class="px-6 py-4">{{ $barang->jumlah_minimal }}</td>
                                    <td class="px-6 py-4">{{ $barang->jumlah_maksimal }}</td>
                                    <td class="px-6 py-4">{{ $barang->rak }}</td>
                                    <td class="px-6 py-4">{{ $barang->no_katalog }}</td>
                                    <td class="px-6 py-4">{{ $barang->merk }}</td>
                                    <td class="px-6 py-4">{{ $barang->no_reff }}</td>
                                    <td class="px-6 py-4">
                                        <!-- Edit Button -->
                                        <button type="button" class="text-blue-600 hover:text-blue-900" data-modal-target="#editBarangModal-{{ $barang->id }}">
                                            Edit
                                        </button>
                                        <!-- Delete Button -->
                                        <form action="{{ route('nama-barang.destroy', $barang->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this item?');">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex items-center mb-4 border-b pb-4 mt-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" data-modal-target="#addBarangModal">
                        Tambah Nama Barang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addBarangModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex items-center justify-center h-screen">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-400 border-4 border-gray-800">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="py-6 px-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-dark">Tambah Nama Barang</h3>
                    <form class="space-y-6" action="{{ route('nama-barang.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="no_item" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nomor Item</label>
                            <input type="text" name="no_item" id="no_item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" readonly>
                        </div>
                        <div>
                            <label for="no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">No</label>
                            <input type="text" name="no" id="no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" readonly>
                        </div>
                        <div>
                            <label for="kode_log" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Kode Log/Gudang</label>
                            <select name="kode_log" id="kode_log" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                                @foreach($logs as $s)
                                    <option value="{{ $s->kd_log }}">{{ $s->kd_log }}- {{ $s->nama_log }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="kd_akun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Kode Akun</label>
                            <select name="kd_akun" id="kd_akun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                                @foreach($masterakuns as $s)
                                    <option value="{{ $s->kd_akun }}">{{ $s->kd_akun }} - {{ $s->nama_akun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                        </div>
                        <div>
                            <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Harga</label>
                            <input type="text" name="harga" id="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                        </div>
                        <div>
                            <label for="satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Satuan</label>
                            <select name="satuan" id="satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                                @foreach($satuan as $s)
                                    <option value="{{ $s->kd_satuan }}">{{ $s->kd_satuan }}- {{ $s->nama_satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="jumlah_minimal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Stock Minimal</label>
                            <input type="text" name="jumlah_minimal" id="jumlah_minimal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                        </div>
                        <div>
                            <label for="jumlah_maksimal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Stock Maksimal</label>
                            <input type="text" name="jumlah_maksimal" id="jumlah_maksimal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                        </div>
                        <div>
                            <label for="rak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Rak</label>
                            <input type="text" name="rak" id="rak" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                        </div>
                        <div>
                            <label for="no_katalog" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">No Katalog</label>
                            <input type="text" name="no_katalog" id="no_katalog" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                        </div>
                        <div>
                            <label for="merk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Merk/Vendor</label>
                            <input type="text" name="merk" id="merk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                        </div>
                        <div>
                            <label for="no_reff" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">No Refferensi</label>
                            <input type="text" name="no_reff" id="no_reff" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    @foreach ($nama as $barang)
        <!-- Edit Modal -->
        <div id="editBarangModal-{{ $barang->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="py-6 px-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Nama Barang</h3>
                        <form class="space-y-6" action="{{ route('nama-barang.update', $barang->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="no_item" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Item</label>
                                <input type="text" name="no_item" id="no_item" value="{{ $barang->no_item }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div>
                                <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" value="{{ $barang->nama_barang }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div>
                                <label for="kode_log" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Log</label>
                                <input type="text" name="kode_log" id="kode_log" value="{{ $barang->kode_log }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div>
                                <label for="satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                                <input type="text" name="satuan" id="satuan" value="{{ $barang->satuan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-target');
                const modalElement = document.querySelector(modalId);
                if (modalElement) {
                    modalElement.classList.remove('hidden');
                    modalElement.classList.add('block');
                } else {
                    console.error(`Modal with id ${modalId} does not exist.`);
                }
            });
        });

        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', () => {
                const modalElement = button.closest('[id^="editBarangModal-"], [id="addBarangModal"]');
                if (modalElement) {
                    modalElement.classList.add('hidden');
                    modalElement.classList.remove('block');
                } else {
                    console.error(`Modal with id ${modalId} does not exist.`);
                }
            });
        });
    });
    </script>
</x-app-layout>
