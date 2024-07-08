<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href='logopt.png' rel="shortcut icon">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    @media (max-width: 768px) {
      /* Adjust styles for smaller screens */
      .dataTables_wrapper {
        display: block;
      }
      .dataTables_length,
      .dataTables_filter {
        margin-top: 10px;
      }
    }

    
  </style>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 ">
        @include('layouts.sidebar')
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-200 overflow-x-auto">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
                
            </div>
        </div>
        
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script>
        $(document).ready(function() {
            // Initialize DataTable with scrollX
            var table = $('#barangTable').DataTable({
                scrollX: true,
                responsive: false,
                dom: 'Bfrtip', // Include buttons in the DOM
                buttons: [
                    {
                        extend: 'csv',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'excel',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'pdf',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'print',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800',
                        customize: function(win) {
                            $(win.document.body)
                                .css('font-size', '10pt')
                                .prepend(
                                    '<div style="display:flex; text-align: center; justify-content: space-between; align-items: center; margin-bottom: 20px;">' +
                                    '<img src="logopt1.png" style="width: 200px;">' +
                                    '</div>'
                                );

                            $(win.document.body).find('table')
                                .addClass('display')
                                .css('width', '100%')
                                .css('font-size', 'inherit');
                        }
                    }
                ]
                
            });

            var table = $('#tahunTable').DataTable({
                scrollX: false,
                responsive: false,
                dom: 'Bfrtip', // Include buttons in the DOM
                buttons: [
                    {
                        extend: 'csv',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'excel',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'pdf',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'print',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800',
                        customize: function(win) {
                            $(win.document.body)
                                .css('font-size', '10pt')
                                .prepend(
                                    '<div style="display:flex; text-align: center; justify-content: space-between; align-items: center; margin-bottom: 20px;">' +
                                    '<img src="logopt1.png" style="width: 200px;">' +
                                    '</div>'
                                );

                            $(win.document.body).find('table')
                                .addClass('display')
                                .css('width', '100%')
                                .css('font-size', 'inherit');
                        }
                    }
                ]
            });
            

            // Append buttons container to the DataTable wrapper
            table.buttons().container().appendTo('#barangTable_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        function setFormAction(action, type) {
            const form = document.getElementById('quantity-form');
            const quantityInput = document.getElementById('quantity-input');
            const modalTitle = document.getElementById('modal-title');
            const modalSubmit = document.getElementById('modal-submit');

            form.action = action;

            switch (type) {
                case 'Tambah':
                    modalTitle.innerText = 'Enter Quantity to Add';
                    quantityInput.classList.remove('hidden');
                    break;
                case 'Ambil':
                    modalTitle.innerText = 'Enter Quantity to Remove';
                    quantityInput.classList.remove('hidden');
                    break;
                case 'Detail':
                    modalTitle.innerText = 'Product Details';
                    quantityInput.classList.add('hidden');
                    modalSubmit.classList.add('hidden');
                    break;
                case 'Edit':
                    modalTitle.innerText = 'Edit Product';
                    quantityInput.classList.add('hidden');
                    modalSubmit.innerText = 'Edit';
                    modalSubmit.classList.remove('hidden');
                    break;
                case 'Remove':
                    modalTitle.innerText = 'Are you sure you want to delete this product?';
                    quantityInput.classList.add('hidden');
                    modalSubmit.innerText = 'Yes, I\'m sure';
                    modalSubmit.classList.remove('hidden');
                    break;
            }

            document.getElementById('popup-modal').classList.remove('hidden');
        }

        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('popup-modal').classList.add('hidden');
            });
        });

        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('popup-modal').classList.toggle('hidden');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>

</body>


  

</html>
