<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Antrian Saya</h2>
            <a href="{{ route('user.queues.create') }}" class="bg-[#FF6A00] text-white px-4 py-2 rounded-lg text-sm font-bold shadow">+ Daftar</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($queues as $q)
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-8 border-[#FF6A00]">
                        <div class="flex justify-between items-start">
                            <span class="text-4xl font-black text-[#FF6A00]">#{{ $q->queue_number }}</span>
                            <span class="text-xs font-bold px-2 py-1 bg-gray-100 rounded uppercase">{{ $q->status }}</span>
                        </div>
                        <div class="mt-4">
                            <p class="font-bold text-gray-800">{{ $q->doctor->name }}</p>
                            <p class="text-sm text-orange-600 font-medium">{{ $q->doctor->poliklinik->name }}</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $q->visit_date }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center col-span-3 text-gray-500 py-10 bg-white rounded shadow-sm">Belum ada riwayat antrian.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>