<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-sm w-full bg-white rounded-lg shadow p-4 md:p-6">
                <div class="flex justify-between">
                    <div>
                        <h5 class="leading-none text-xl font-bold text-gray-900 pb-2">Grafik Stok Barang WF dan MDC</h5>
                    </div>
                </div>
                <div id="data-series-chart"></div>
            </div>
        </div>
    </div> --}}

    <footer class="bg-white rounded-lg shadow m-4 dark:bg-dark-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-700 sm:text-center dark:text-gray-700">© 2024
                <a href="http://atmi.co.id" class="hover:underline">PT. ATMI SOLO</a>. All Rights Reserved.
            </span>
            @include('clock')
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const options = {
            series: @json($chartData),
            chart: {
                height: "100%",
                maxWidth: "100%",
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
                enabled: true,
            },
            stroke: {
                width: 6,
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
                labels: {
                    formatter: function(value) {
                        return value; // Adjust the formatting as needed
                    },
                },
            },
        };

        if (document.getElementById("data-series-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("data-series-chart"), options);
            chart.render();
        }
    </script>
</x-app-layout>
