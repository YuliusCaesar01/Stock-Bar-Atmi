<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Create Barang') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @include('barangs.partials.form', [
                        'action' => route('barangs.store'),
                        'buttonText' => 'Create'
                    ])
            </div>
        </div>
     </div>
    </div>    

    <footer class="bg-white rounded-lg shadow m-4 dark:bg-gray-100">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-900 sm:text-center dark:text-gray-900">© 2024 <a href="http://atmi.co.id" class="hover:underline">PT. ATMI SOLO</a>. All Rights Reserved.</span>
            @include('clock')
        </div>
    </footer>
</x-app-layout>
