<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('logopt.png') }}" type="image/x-icon">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
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
        <div class="p-4">
            <div class="p-2 overflow-x-auto mt-10">
                <!-- Page Heading -->
                @if (isset($header))
                    {{-- <header class="bg-white bg-gray-800 shadow rounded-lg mt-5">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-4">
                            {{ $header }}
                        </div>
                    </header> --}}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
     <script>
        if (document.getElementById("export-table") && typeof simpleDatatables.DataTable !== 'undefined') {

            const exportCustomCSV = function(dataTable, userOptions = {}) {
                // A modified CSV export that includes a row of minuses at the start and end.
                const clonedUserOptions = {
                    ...userOptions
                }
                clonedUserOptions.download = false
                const csv = simpleDatatables.exportCSV(dataTable, clonedUserOptions)
                // If CSV didn't work, exit.
                if (!csv) {
                    return false
                }
                const defaults = {
                    download: true,
                    lineDelimiter: "\n",
                    columnDelimiter: ";"
                }
                const options = {
                    ...defaults,
                    ...clonedUserOptions
                }
                const separatorRow = Array(dataTable.data.headings.filter((_heading, index) => !dataTable.columns
                        .settings[index]?.hidden).length)
                    .fill("+")
                    .join("+"); // Use "+" as the delimiter

                const str = separatorRow + options.lineDelimiter + csv + options.lineDelimiter + separatorRow;

                if (userOptions.download) {
                    // Create a link to trigger the download
                    const link = document.createElement("a");
                    link.href = encodeURI("data:text/csv;charset=utf-8," + str);
                    link.download = (options.filename || "datatable_export") + ".txt";
                    // Append the link
                    document.body.appendChild(link);
                    // Trigger the download
                    link.click();
                    // Remove the link
                    document.body.removeChild(link);
                }

                return str
            }
            const table = new simpleDatatables.DataTable("#export-table", {
                paging: false,
                perPage: 20,
                template: (options, dom) => "<div class='" + options.classes.top + "'>" +
                    "<div class='flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-3 rtl:space-x-reverse w-full sm:w-auto'>" +
                    (options.paging && options.perPageSelect ?
                        "<div class='" + options.classes.dropdown + "'>" +
                        "<label>" +
                        "<select class='" + options.classes.selector + "'></select> " + options.labels.perPage +
                        "</label>" +
                        "</div>" : ""
                    ) +
                    "<button id='exportDropdownButton' type='button' class='flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 sm:w-auto'>" +
                    "Export as" +
                    "<svg class='-me-0.5 ms-1.5 h-4 w-4' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='none' viewBox='0 0 24 24'>" +
                    "<path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m19 9-7 7-7-7' />" +
                    "</svg>" +
                    "</button>" +
                    "<div id='exportDropdown' class='z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow' data-popper-placement='bottom'>" +
                    "<ul class='p-2 text-left text-sm font-medium text-gray-500' aria-labelledby='exportDropdownButton'>" +
                    "<li>" +
                    "<button id='export-csv' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 '>" +
                    "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 ' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
                    "<path fill-rule='evenodd' d='M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm1.018 8.828a2.34 2.34 0 0 0-2.373 2.13v.008a2.32 2.32 0 0 0 2.06 2.497l.535.059a.993.993 0 0 0 .136.006.272.272 0 0 1 .263.367l-.008.02a.377.377 0 0 1-.018.044.49.49 0 0 1-.078.02 1.689 1.689 0 0 1-.297.021h-1.13a1 1 0 1 0 0 2h1.13c.417 0 .892-.05 1.324-.279.47-.248.78-.648.953-1.134a2.272 2.272 0 0 0-2.115-3.06l-.478-.052a.32.32 0 0 1-.285-.341.34.34 0 0 1 .344-.306l.94.02a1 1 0 1 0 .043-2l-.943-.02h-.003Zm7.933 1.482a1 1 0 1 0-1.902-.62l-.57 1.747-.522-1.726a1 1 0 0 0-1.914.578l1.443 4.773a1 1 0 0 0 1.908.021l1.557-4.773Zm-13.762.88a.647.647 0 0 1 .458-.19h1.018a1 1 0 1 0 0-2H6.647A2.647 2.647 0 0 0 4 13.647v1.706A2.647 2.647 0 0 0 6.647 18h1.018a1 1 0 1 0 0-2H6.647A.647.647 0 0 1 6 15.353v-1.706c0-.172.068-.336.19-.457Z' clip-rule='evenodd'/>" +
                    "</svg>" +
                    "<span>Export CSV</span>" +
                    "</button>" +
                    "</li>" +
                    "<li>" +
                    "<button id='export-json' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 '>" +
                    "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 ' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
                    "<path fill-rule='evenodd' d='M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm-.293 9.293a1 1 0 0 1 0 1.414L9.414 14l1.293 1.293a1 1 0 0 1-1.414 1.414l-2-2a1 1 0 0 1 0-1.414l2-2a1 1 0 0 1 1.414 0Zm2.586 1.414a1 1 0 0 1 1.414-1.414l2 2a1 1 0 0 1 0 1.414l-2 2a1 1 0 0 1-1.414-1.414L14.586 14l-1.293-1.293Z' clip-rule='evenodd'/>" +
                    "</svg>" +
                    "<span>Export JSON</span>" +
                    "</button>" +
                    "</li>" +
                    "<li>" +
                    "<button id='export-txt' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 '>" +
                    "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 ' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
                    "<path fill-rule='evenodd' d='M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z' clip-rule='evenodd'/>" +
                    "</svg>" +
                    "<span>Export TXT</span>" +
                    "</button>" +
                    "</li>" +
                    "<li>" +
                    "<button id='export-sql' class='group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 '>" +
                    "<svg class='me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 ' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' viewBox='0 0 24 24'>" +
                    "<path d='M12 7.205c4.418 0 8-1.165 8-2.602C20 3.165 16.418 2 12 2S4 3.165 4 4.603c0 1.437 3.582 2.602 8 2.602ZM12 22c4.963 0 8-1.686 8-2.603v-4.404c-.052.032-.112.06-.165.09a7.75 7.75 0 0 1-.745.387c-.193.088-.394.173-.6.253-.063.024-.124.05-.189.073a18.934 18.934 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.073a10.143 10.143 0 0 1-.852-.373 7.75 7.75 0 0 1-.493-.267c-.053-.03-.113-.058-.165-.09v4.404C4 20.315 7.037 22 12 22Zm7.09-13.928a9.91 9.91 0 0 1-.6.253c-.063.025-.124.05-.189.074a18.935 18.935 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.074a10.163 10.163 0 0 1-.852-.372 7.816 7.816 0 0 1-.493-.268c-.055-.03-.115-.058-.167-.09V12c0 .917 3.037 2.603 8 2.603s8-1.686 8-2.603V7.596c-.052.031-.112.059-.165.09a7.816 7.816 0 0 1-.745.386Z'/>" +
                    "</svg>" +
                    "<span>Export SQL</span>" +
                    "</button>" +
                    "</li>" +
                    "</ul>" +
                    "</div>" + "</div>" +
                    (options.searchable ?
                        "<div class='" + options.classes.search + "'>" +
                        "<input class='" + options.classes.input + "' placeholder='" + options.labels.placeholder +
                        "' type='search' title='" + options.labels.searchTitle + "'" + (dom.id ?
                            " aria-controls='" + dom.id + "'" : "") + ">" +
                        "</div>" : ""
                    ) +
                    "</div>" +
                    "<div class='" + options.classes.container + "'" + (options.scrollY.length ?
                        " style='height: " + options.scrollY + "; overflow-Y: auto;'" : "") + "></div>" +
                    "<div class='" + options.classes.bottom + "'>" +
                    (options.paging ?
                        "<div class='" + options.classes.info + "'></div>" : ""
                    ) +
                    "<nav class='" + options.classes.pagination + "'></nav>" +
                    "</div>"
            })
            const $exportButton = document.getElementById("exportDropdownButton");
            const $exportDropdownEl = document.getElementById("exportDropdown");
            const dropdown = new Dropdown($exportDropdownEl, $exportButton);
            console.log(dropdown)

            document.getElementById("export-csv").addEventListener("click", () => {
                simpleDatatables.exportCSV(table, {
                    download: true,
                    lineDelimiter: "\n",
                    columnDelimiter: ";"
                })
            })
            document.getElementById("export-sql").addEventListener("click", () => {
                simpleDatatables.exportSQL(table, {
                    download: true,
                    tableName: "export_table"
                })
            })
            document.getElementById("export-txt").addEventListener("click", () => {
                simpleDatatables.exportTXT(table, {
                    download: true
                })
            })
            document.getElementById("export-json").addEventListener("click", () => {
                simpleDatatables.exportJSON(table, {
                    download: true,
                    space: 3
                })
            })
        }
    </script>


    <script>
    $(document).ready(function() {
    // Initialize DataTables for multiple tables
    var tables = {
        barangTable: $('#barangTable').DataTable({
            scrollX: true,
            responsive: false,
            dom: 'Bfrtip',
            buttons: [
                { extend: 'csv', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                { extend: 'excel', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                { extend: 'pdf', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                {
                    extend: 'print',
                    className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800',
                    customize: function(win) {
                        $(win.document.body).css('font-size', '10pt').prepend(
                            '<div style="display:flex; text-align: center; justify-content: space-between; align-items: center; margin-bottom: 20px;">' +
                            '<img src="logopt1.png" style="width: 200px;">' +
                            '</div>'
                        );
                        $(win.document.body).find('table').addClass('display').css('width', '100%').css('font-size', 'inherit');
                    }
                }
            ]
        }),

        tahunTable: $('#tahunTable').DataTable({
            scrollX: true,
            responsive: false,
            columnDefs: [
                { width: '10%', targets: 0 },
                { width: '30%', targets: 1 },
                { width: '15%', targets: 2 },
                { width: '15%', targets: 3 },
                { width: '30%', targets: 4 }
            ],
            dom: 'Bfrtip',
            buttons: [
                { extend: 'csv', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                { extend: 'excel', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                { extend: 'pdf', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                {
                    extend: 'print',
                    className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800',
                    customize: function(win) {
                        $(win.document.body).css('font-size', '10pt').prepend(
                            '<div style="display:flex; text-align: center; justify-content: space-between; align-items: center; margin-bottom: 20px;">' +
                            '<img src="logopt1.png" style="width: 200px;">' +
                            '</div>'
                        );
                        $(win.document.body).find('table').addClass('display').css('width', '100%').css('font-size', 'inherit');
                    }
                }
            ]
        }),
        reportTable: $('#reportTable').DataTable({
            scrollY: '900px',
            scrollX: true,
            scrollCollapse: true,
            responsive: false,
            paging: false,
            dom: 'Bfrtip',
            buttons: [
                { extend: 'csv', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                { extend: 'excel', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                { extend: 'pdf', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                {
                    extend: 'print',
                    className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800',
                    customize: function(win) {
                        $(win.document.body).css('font-size', '10pt').prepend(
                            '<div style="display:flex; text-align: center; justify-content: space-between; align-items: center; margin-bottom: 20px;">' +
                            '<img src="logopt1.png" style="width: 200px;">' +
                            '</div>'
                        );
                        $(win.document.body).find('table').addClass('display').css('width', '100%').css('font-size', 'inherit');
                    }
                },
                { extend: 'colvis', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800', text: 'Toggle Columns' }

            ]


        }),


        satuanTable: $('#satuanTable').DataTable({
            scrollX: false,
            responsive: false,
            dom: 'Bfrtip',
            buttons: [
                { extend: 'csv', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                { extend: 'excel', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                { extend: 'pdf', className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800' },
                {
                    extend: 'print',
                    className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800',
                    customize: function(win) {
                        $(win.document.body).css('font-size', '10pt').prepend(
                            '<div style="display:flex; text-align: center; justify-content: space-between; align-items: center; margin-bottom: 20px;">' +
                            '<img src="logopt1.png" style="width: 200px;">' +
                            '</div>'
                        );
                        $(win.document.body).find('table').addClass('display').css('width', '100%').css('font-size', 'inherit');
                    }
                }
            ]
        })
        };

        // Append buttons container to respective DataTable wrappers
        $.each(tables, function(key, table) {
            table.buttons().container().appendTo('#' + key + '_wrapper .col-md-6:eq(0)');
        });
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
