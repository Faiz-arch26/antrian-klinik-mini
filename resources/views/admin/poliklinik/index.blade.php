<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Poliklinik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.polikliniks.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <x-input-label for="name" value="Nama Poliklinik" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="Contoh: Poli Mata" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-[#FF6A00] hover:bg-[#e65f00] text-white font-bold py-2 px-6 rounded shadow transition">
                            Simpan Poliklinik
                        </button>
                        <a href="{{ route('admin.polikliniks.index') }}" class="text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>