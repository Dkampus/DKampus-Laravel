<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>


            </div>

            <div class="bg-white dark:bg-gray-800 h-[400px] overflow-y-auto hidden-scrol shadow-sm sm:rounded-lg mt-4">
            <table class="border-collapse table-auto w-full text-sm  relative">
                <thead class="sticky top-0 bg-slate-950/70 backdrop-blur-sm">
                  <tr>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-white text-left">Nama UMKM</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-3 pb-3 text-slate-400 dark:text-white text-left">Aksi</th>
                  </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800">
                  <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 flex flex-col">
                        <a class="py-1 text-center font-semibold text-sm bg-green-400 text-white rounded-full shadow-sm mb-2">View</a>
                        <a class="py-1 text-center font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm mb-2">Edit</a>
                        <a class="py-1 text-center font-semibold text-sm bg-red-400 text-white rounded-full shadow-sm mb-2">Delete</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 flex flex-col">
                        <a class="py-1 text-center font-semibold text-sm bg-green-400 text-white rounded-full shadow-sm mb-2">View</a>
                        <a class="py-1 text-center font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm mb-2">Edit</a>
                        <a class="py-1 text-center font-semibold text-sm bg-red-400 text-white rounded-full shadow-sm mb-2">Delete</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 flex flex-col">
                        <a class="py-1 text-center font-semibold text-sm bg-green-400 text-white rounded-full shadow-sm mb-2">View</a>
                        <a class="py-1 text-center font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm mb-2">Edit</a>
                        <a class="py-1 text-center font-semibold text-sm bg-red-400 text-white rounded-full shadow-sm mb-2">Delete</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 flex flex-col">
                        <a class="py-1 text-center font-semibold text-sm bg-green-400 text-white rounded-full shadow-sm mb-2">View</a>
                        <a class="py-1 text-center font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm mb-2">Edit</a>
                        <a class="py-1 text-center font-semibold text-sm bg-red-400 text-white rounded-full shadow-sm mb-2">Delete</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 flex flex-col">
                        <a class="py-1 text-center font-semibold text-sm bg-green-400 text-white rounded-full shadow-sm mb-2">View</a>
                        <a class="py-1 text-center font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm mb-2">Edit</a>
                        <a class="py-1 text-center font-semibold text-sm bg-red-400 text-white rounded-full shadow-sm mb-2">Delete</a>
                    </td>
                  </tr>
                  <tr>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400 flex flex-col">
                        <a class="py-1 text-center font-semibold text-sm bg-green-400 text-white rounded-full shadow-sm mb-2">View</a>
                        <a class="py-1 text-center font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm mb-2">Edit</a>
                        <a class="py-1 text-center font-semibold text-sm bg-red-400 text-white rounded-full shadow-sm mb-2">Delete</a>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>

        </div>
    </div>
</x-app-layout>
