<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Grafik Stok Inventory (Chart 1) --}}
                <div class="w-full bg-white rounded-lg shadow p-4 md:p-6 mb-4 flex flex-col justify-between h-full">
                    <div>
                        <h5 class="leading-none text-xl font-bold text-gray-900 pb-2">Grafik Stok Inventory</h5>
                        <div class="flex mb-4">
                            <div class="flex items-center me-4">
                                <input type="checkbox" value="all" checked
                                    class="filter-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="all" class="ms-2 text-sm font-medium text-gray-900">All</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input type="checkbox" value="WF"
                                    class="filter-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="WF" class="ms-2 text-sm font-medium text-gray-900">WF</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input type="checkbox" value="MDC"
                                    class="filter-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="MDC" class="ms-2 text-sm font-medium text-gray-900">MDC</label>
                            </div>
                            {{-- <label for="start-date" class="me-2 text-sm text-gray-900">Start Date:</label>
                            <input type="date" id="start-date" class="border-gray-300 rounded focus:ring-blue-500 text-gray-900">
                            <label for="end-date" class="ms-4 me-2 text-sm text-gray-900">End Date:</label>
                            <input type="date" id="end-date" class="border-gray-300 rounded focus:ring-blue-500  text-gray-900"> --}}
                        </div>
                        <div id="data-series-chart" class="mt-4"></div>
                    </div>
                    <div class="border-t border-gray-200 pt-5">
                        <a href="{{ route('jumlahstock') }}"
                            class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 hover:bg-gray-100 px-3 py-2">
                            Detail
                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Grafik Total Perbandingan Stok Inventory (Chart 2) --}}
                <div class="w-full bg-white rounded-lg shadow p-4 md:p-6 flex flex-col justify-between h-full">
                    <div>
                        <h5 class="text-xl font-bold leading-none text-gray-900 mb-2">Grafik Kondisi Stok</h5>
                        <div id="pie-chart" class="py-6"></div>
                    </div>
                    <div class="border-t border-gray-200 pt-5">
                        <a href="{{ route('kondisistock') }}"
                            class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 hover:bg-gray-100 px-3 py-2">
                            Detail
                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-white rounded-lg shadow m-4 dark:bg-dark-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-700 sm:text-center dark:text-gray-700">© 2024
                <a href="http://atmi.co.id" class="hover:underline">PT. ATMI SOLO</a>. All Rights Reserved.
            </span>
            @include('clock')
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- Chart 1 JScript --}}
    <script>
        // Initial chart rendering
        let originalChartData = @json($chartData);
        const maxValue = Math.max(...@json($chartData).map(series => Math.max(...series.data)));
        const adjustedMaxValue = maxValue * 2;

        function renderChart(filteredData) {
            const options = {
                series: filteredData,
                chart: {
                    height: 350,
                    type: "area",
                    fontFamily: "Inter, sans-serif",
                    dropShadow: {
                        enabled: true,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: true,
                    },
                },
                legend: {
                    show: true,
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: "#1C64F2",
                        gradientToColors: ["#1C64F2"],
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 3,
                    curve: 'smooth',
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: 0,
                    },
                },
                xaxis: {
                    categories: @json($labels),
                    labels: {
                        show: false,
                    },
                    axisBorder: {
                        show: true,
                    },
                    axisTicks: {
                        show: true,
                    },
                },
                yaxis: {
                    show: true,
                    max: adjustedMaxValue,
                    labels: {
                        formatter: function(value) {
                            return value;
                        },
                    },
                },
            };

            const chartContainer = document.getElementById("data-series-chart");
            if (chartContainer && typeof ApexCharts !== 'undefined') {
                chartContainer.innerHTML = ''; // Clear any existing charts
                const chart = new ApexCharts(chartContainer, options);
                chart.render();
            }
        }

        // Function to filter data based on date range
        function filterDataByDateRange(data, startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);

            return data.map(series => {
                return {
                    name: series.name,
                    data: series.data.filter((_, index) => {
                        const date = new Date(@json($labels)[index]);
                        return date >= start && date <= end;
                    }),
                };
            });
        }

        // Initial render with all data
        renderChart(originalChartData);

        // Filter logic for checkboxes
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const selectedValues = Array.from(document.querySelectorAll('.filter-checkbox:checked'))
                    .map(cb => cb.value);

                let filteredData = originalChartData;

                if (!selectedValues.includes('all')) {
                    filteredData = originalChartData.filter(series =>
                        selectedValues.includes(series.name)
                    );
                }

                // Apply date range filter
                const startDate = document.getElementById('start-date').value;
                const endDate = document.getElementById('end-date').value;

                if (startDate && endDate) {
                    filteredData = filterDataByDateRange(filteredData, startDate, endDate);
                }

                renderChart(filteredData);
            });
        });

        // Filter logic for date range
        document.querySelectorAll('#start-date, #end-date').forEach(dateInput => {
            dateInput.addEventListener('change', function() {
                let filteredData = originalChartData;

                // Apply checkbox filters
                const selectedValues = Array.from(document.querySelectorAll('.filter-checkbox:checked'))
                    .map(cb => cb.value);

                if (!selectedValues.includes('all')) {
                    filteredData = originalChartData.filter(series =>
                        selectedValues.includes(series.name)
                    );
                }

                // Apply date range filter
                const startDate = document.getElementById('start-date').value;
                const endDate = document.getElementById('end-date').value;

                if (startDate && endDate) {
                    filteredData = filterDataByDateRange(filteredData, startDate, endDate);
                }

                renderChart(filteredData);
            });
        });
    </script>




    {{-- Chart 2 JScript --}}
    <script>
        const stockCategories = @json($stockCategories);

        const getPieChartOptions = () => {
            return {
                series: [stockCategories.Safe, stockCategories.Warning, stockCategories.Danger],
                colors: ["#33FFA6", "#FFA633", "#FF5733"],
                chart: {
                    height: 350,
                    type: "pie",
                },
                labels: ["Safe", "Warning", "Danger"],
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                }
            };
        }

        if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("pie-chart"), getPieChartOptions());
            chart.render();
        }
    </script>

</x-app-layout>
