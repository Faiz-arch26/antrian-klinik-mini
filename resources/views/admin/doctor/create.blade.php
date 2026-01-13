<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Dokter Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.doctors.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" value="Nama Dokter" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="poliklinik_id" value="Poliklinik" />
                            <select name="poliklinik_id" id="poliklinik_id" class="mt-1 block w-full border-gray-300 focus:border-[#FF6A00] focus:ring-[#FF6A00] rounded-md shadow-sm">
                                @foreach($polikliniks as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="schedule_day" value="Hari Praktik" />
                            <x-text-input id="schedule_day" name="schedule_day" type="text" placeholder="Senin - Jumat" class="mt-1 block w-full" required />
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <x-input-label for="start_time" value="Jam Mulai" />
                                <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full" required />
                            </div>
                            <div>
                                <x-input-label for="end_time" value="Jam Selesai" />
                                <x-text-input id="end_time" name="end_time" type="time" class="mt-1 block w-full" required />
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-4">
                        <a href="{{ route('admin.doctors.index') }}" class="py-2 px-4 text-gray-600 underline">Batal</a>
                        <button type="submit" class="bg-[#FF6A00] hover:bg-[#e65f00] text-white font-bold py-2 px-8 rounded shadow-lg transition">
                            Simpan Dokter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>