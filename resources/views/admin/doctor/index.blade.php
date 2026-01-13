<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Dokter') }}
            </h2>
            <a href="{{ route('admin.doctors.create') }}" class="bg-[#FF6A00] hover:bg-[#e65f00] text-white font-bold py-2 px-4 rounded transition">
                + Tambah Dokter
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100 text-[#FF6A00]">
                            <th class="py-3 px-2">Nama Dokter</th>
                            <th class="py-3 px-2">Spesialis (Poli)</th>
                            <th class="py-3 px-2">Jadwal</th>
                            <th class="py-3 px-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctors as $doctor)
                        <tr class="border-b border-gray-50 hover:bg-gray-50">
                            <td class="py-4 px-2 font-medium">{{ $doctor->name }}</td>
                            <td class="py-4 px-2 text-gray-600">{{ $doctor->poliklinik->name }}</td>
                            <td class="py-4 px-2 text-sm">
                                <span class="block font-bold">{{ $doctor->schedule_day }}</span>
                                <span class="text-gray-500">{{ $doctor->start_time }} - {{ $doctor->end_time }}</span>
                            </td>
                            <td class="py-4 px-2 text-center">
                                <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:underline text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-gray-500">Belum ada data dokter.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>