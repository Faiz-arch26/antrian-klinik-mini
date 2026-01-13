<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <div class="w-2 h-6 bg-sky-500 rounded-full"></div>
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ __('Pendaftaran Antrian Pasien') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Form Card dengan Desain Medis Modern --}}
            <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden">
                {{-- Dekorasi Latar Belakang --}}
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-sky-50 rounded-full opacity-50"></div>
                
                <div class="relative">
                    <div class="mb-8">
                        <h3 class="text-2xl font-black text-slate-800">Formulir Pemeriksaan</h3>
                        <p class="text-slate-500 text-sm mt-1 italic">Silakan lengkapi data di bawah untuk mendapatkan nomor antrian.</p>
                    </div>

                    <form action="{{ route('user.queues.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            {{-- Pilihan Dokter --}}
                            <div>
                                <x-input-label for="doctor_id" value="Pilih Dokter & Poliklinik" class="font-bold text-slate-700 ml-1" />
                                <select name="doctor_id" id="doctor_id" 
                                    class="mt-2 w-full border-slate-200 focus:border-sky-500 focus:ring-sky-500 rounded-2xl px-5 py-4 shadow-sm transition" 
                                    required>
                                    <option value="" disabled selected>-- Pilih Dokter Spesialis --</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">
                                            {{ $doctor->name }} ({{ $doctor->poliklinik->name }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" />
                            </div>

                            {{-- Tanggal Kunjungan --}}
                            <div>
                                <x-input-label for="visit_date" value="Tanggal Rencana Kunjungan" class="font-bold text-slate-700 ml-1" />
                                <x-text-input type="date" name="visit_date" id="visit_date" 
                                    class="mt-2 w-full rounded-2xl border-slate-200 focus:border-sky-500 focus:ring-sky-500 px-5 py-4 shadow-sm" 
                                    min="{{ date('Y-m-d') }}" 
                                    required />
                                <x-input-error :messages="$errors->get('visit_date')" class="mt-2" />
                            </div>

                            {{-- Keluhan --}}
                            <div>
                                <x-input-label for="complaint" value="Keluhan Utama" class="font-bold text-slate-700 ml-1" />
                                <textarea name="complaint" rows="4" 
                                    class="mt-2 w-full border-slate-200 focus:border-sky-500 focus:ring-sky-500 rounded-2xl px-5 py-4 shadow-sm" 
                                    placeholder="Jelaskan kondisi Anda secara singkat (Minimal 10 karakter)..." 
                                    required></textarea>
                                <div class="flex justify-between items-center mt-2 px-1">
                                    <x-input-error :messages="$errors->get('complaint')" />
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest italic">* Syarat Keluhan: Min. 10 Karakter</span>
                                </div>
                            </div>

                            {{-- Tombol Submit --}}
                            <div class="pt-4">
                                <button type="submit" 
                                    class="w-full bg-sky-500 text-white font-black py-5 rounded-2xl shadow-xl shadow-sky-100 hover:bg-sky-600 active:scale-[0.98] transition duration-300 uppercase tracking-[0.2em] text-xs">
                                    Kirim & Ambil Nomor Antrian
                                </button>
                                <a href="{{ route('dashboard') }}" class="block text-center mt-6 text-sm font-bold text-slate-400 hover:text-slate-600 transition">
                                    Batal & Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info Tambahan --}}
            <div class="mt-8 flex items-center justify-center gap-4 text-slate-400">
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-widest">Layanan Cepat</span>
                </div>
                <div class="w-1 h-1 bg-slate-300 rounded-full"></div>
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-widest">Terverifikasi</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>