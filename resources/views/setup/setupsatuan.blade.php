<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Setup Satuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="satuanTable" class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-dark-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-700 dark:text-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Kode Satuan</th>
                                <th scope="col" class="px-6 py-3">Nama Satuan</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($satuan as $s)
                                <tr>
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $s->kd_satuan }}</td>
                                    <td class="px-6 py-4">{{ $s->nama_satuan }}</td>
                                    <td class="px-6 py-4">
                                        <!-- Edit Button -->
                                        <button type="button" class="text-blue-600 hover:text-blue-900" data-modal-target="#editSatuanModal-{{ $s->id }}">
                                            Edit
                                        </button>
                                        <!-- Delete Button -->
                                        <form id="delete-form-{{ $s->id }}" action="{{ route('setupsatuan.destroy', $s->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="text-red-600 hover:text-red-900" onclick="confirmDelete({{ $s->id }})">
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
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" data-modal-target="#addSatuanModal">
                        Tambah Satuan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addSatuanModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex items-center justify-center h-screen">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-400 border-4 border-gray-800">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="py-6 px-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-dark">Tambah Nama Satuan</h3>
                    <form class="space-y-6" action="{{ route('setupsatuan.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="kd_satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Kode Satuan</label>
                            <input type="text" name="kd_satuan" id="kd_satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                        </div>
                        <div>
                            <label for="nama_satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nama Satuan</label>
                            <input type="text" name="nama_satuan" id="nama_satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($satuan as $s)
        <!-- Edit Modal -->
        <div id="editSatuanModal-{{ $s->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex items-center justify-center h-screen">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-400 border-4 border-gray-800">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="py-6 px-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-dark">Edit Nama Satuan</h3>
                        <form class="space-y-6" action="{{ route('setupsatuan.update', $s->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="kd_satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Kode Satuan</label>
                                <input type="text" name="kd_satuan" id="kd_satuan" value="{{ $s->kd_satuan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                            </div>
                            <div>
                                <label for="nama_satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nama Satuan</label>
                                <input type="text" name="nama_satuan" id="nama_satuan" value="{{ $s->nama_satuan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-500 dark:placeholder-gray-400 dark:text-dark" required>
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(satuanId) {
            Swal.fire({
                title: 'Hapus Satuan Ini?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + satuanId).submit();
                }
            })
        }
    </script>

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
                const modalElement = button.closest('[id^="editSatuanModal-"], [id="addSatuanModal"]');
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
