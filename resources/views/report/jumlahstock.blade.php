<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight ">
            {{ __('Report Jumlah Stock Barang') }}
        </h2>
    </x-slot>

    <div class="py-4">

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
                </div>
                <div class="flex mb-4">
                    <label for="start-date" class="me-2 text-sm font-medium text-gray-900">Start Date:</label>
                    <input type="date" id="start-date" class="border-gray-300 text-gray-900 rounded focus:ring-blue-500">
                    <label for="end-date" class="ms-4 me-2 text-sm font-medium text-gray-900">End Date:</label>
                    <input type="date" id="end-date" class="border-gray-300 rounded text-gray-900 focus:ring-blue-500">
                    <label for="month-filter" class="ms-4 me-2 text-sm font-medium text-gray-900">Month:</label>
                    <select id="month-filter" class="border-gray-300 rounded focus:ring-blue-500 text-gray-900">
                        <option value="">All</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div id="data-series-chart" class="mt-4"></div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            @php
                // Fetch all stock summaries
                $barangs = \App\Models\StockSummary::all();
            @endphp

            <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                <table id="tahunTable">
                    <div class="w-full text-sm text-center text-gray-500 dark:text-dark-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-700 dark:text-dark-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Tanggal</th>
                                <th scope="col" class="px-6 py-3">Unit</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)
                                <tr class="bg-white border-b">
                                    <td class="text-gray-700 text-center px-6 py-4">{{ $barang->date }}</td>
                                    <td class="text-gray-700 text-center px-6 py-4">{{ $barang->kd_prod }}</td>
                                    <td class="text-gray-700 text-center px-6 py-4">{{ $barang->total_stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- Chart 1 JScript --}}
    <script>
        // Initial chart rendering
        let originalChartData = @json($chartData);
        let originalLabels = @json($labels);
        const maxValue = Math.max(...originalChartData.map(series => Math.max(...series.data)));
        const adjustedMaxValue = maxValue * 2;

        function renderChart(filteredData, filteredLabels) {
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
                    categories: filteredLabels,
                    labels: {
                        show: true,
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
        function filterDataByDateRange(data, labels, startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            let filteredLabels = [];
            let filteredData = data.map(series => {
                const filteredSeriesData = [];
                labels.forEach((label, index) => {
                    const date = new Date(label);
                    if (date >= start && date <= end) {
                        filteredSeriesData.push(series.data[index]);
                        filteredLabels.push(label);
                    } else {
                        // Fill with zero if the date is within the range but no data exists
                        filteredSeriesData.push(0);
                    }
                });
                return {
                    name: series.name,
                    data: filteredSeriesData,
                };
            });
            return {
                filteredData,
                filteredLabels,
            };
        }

        // Function to filter data based on selected month
        function filterDataByMonth(data, labels, month) {
            let filteredLabels = [];
            let filteredData = data.map(series => {
                const filteredSeriesData = [];
                labels.forEach((label, index) => {
                    const date = new Date(label);
                    if (date.getMonth() + 1 === parseInt(month)) {
                        filteredSeriesData.push(series.data[index]);
                        filteredLabels.push(label);
                    } else {
                        filteredSeriesData.push(0);
                    }
                });
                return {
                    name: series.name,
                    data: filteredSeriesData,
                };
            });
            return {
                filteredData,
                filteredLabels,
            };
        }

        // Initial render with all data
        renderChart(originalChartData, originalLabels);

        // Filter logic for checkboxes
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                applyFilters();
            });
        });

        // Filter logic for date range
        document.querySelectorAll('#start-date, #end-date').forEach(dateInput => {
            dateInput.addEventListener('change', function() {
                applyFilters();
            });
        });

        // Filter logic for month
        document.getElementById('month-filter').addEventListener('change', function() {
            applyFilters();
        });

        // Function to apply all filters
        function applyFilters() {
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

            let filteredLabels = originalLabels;
            if (startDate && endDate) {
                const filteredResult = filterDataByDateRange(filteredData, originalLabels, startDate, endDate);
                filteredData = filteredResult.filteredData;
                filteredLabels = filteredResult.filteredLabels;
            }

            // Apply month filter
            const selectedMonth = document.getElementById('month-filter').value;
            if (selectedMonth) {
                const filteredResult = filterDataByMonth(filteredData, filteredLabels, selectedMonth);
                filteredData = filteredResult.filteredData;
                filteredLabels = filteredResult.filteredLabels;
            }

            renderChart(filteredData, filteredLabels);
        }
    </script>

</x-app-layout>
