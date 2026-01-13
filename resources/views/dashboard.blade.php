<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <div class="w-2 h-6 bg-sky-500 rounded-full"></div>
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ Auth::user()->role === 'admin' ? __('Monitoring Panel Admin') : __('Layanan Pasien') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2.5rem] border border-slate-100 p-8 md:p-12">
                
                {{-- Welcome Section --}}
                <div class="mb-10 text-center md:text-left">
                    <h3 class="text-3xl font-black text-slate-900">
                        Selamat Datang, <span class="text-sky-500">{{ Auth::user()->name }}</span>!
                    </h3>
                    <p class="text-slate-500 mt-2 text-lg font-medium italic">
                        {{ Auth::user()->role === 'admin' 
                            ? 'Anda masuk sebagai Admin. Kelola data operasional klinik melalui panel di bawah.' 
                            : 'Anda masuk sebagai Pasien. Silakan daftar antrian untuk mendapatkan layanan pemeriksaan.' }}
                    </p>
                </div>

                {{-- Dashboard Khusus Admin --}}
                @if(Auth::user()->role === 'admin')
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Kelola Poliklinik --}}
                        <a href="{{ route('admin.polikliniks.index') }}" class="group p-8 bg-white border-2 border-slate-50 rounded-3xl shadow-sm hover:border-sky-500 hover:shadow-xl hover:shadow-sky-100 transition-all duration-300">
                            <div class="w-12 h-12 bg-sky-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-sky-100 group-hover:scale-110 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-black text-slate-800">{{ __('Kelola Poliklinik') }}</h4>
                            <p class="text-slate-500 text-sm mt-2">Update unit poliklinik aktif untuk pendaftaran dokter.</p>
                            <span class="mt-6 inline-block text-sky-500 font-bold text-xs uppercase tracking-widest">Buka Menu →</span>
                        </a>

                        {{-- Kelola Dokter --}}
                        <a href="{{ route('admin.doctors.index') }}" class="group p-8 bg-white border-2 border-slate-50 rounded-3xl shadow-sm hover:border-sky-500 hover:shadow-xl hover:shadow-sky-100 transition-all duration-300">
                            <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-emerald-100 group-hover:scale-110 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-black text-slate-800">{{ __('Kelola Dokter') }}</h4>
                            <p class="text-slate-500 text-sm mt-2">Atur data tenaga medis dan jadwal praktek spesialis.</p>
                            <span class="mt-6 inline-block text-emerald-500 font-bold text-xs uppercase tracking-widest">Buka Menu →</span>
                        </a>

                        {{-- Semua Antrian --}}
                        <a href="{{ route('admin.queues.index') }}" class="group p-8 bg-slate-900 rounded-3xl shadow-xl hover:shadow-slate-200 transition-all duration-300">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mb-6 text-white group-hover:scale-110 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-black text-white">{{ __('Semua Antrian') }}</h4>
                            <p class="text-slate-400 text-sm mt-2">Monitor seluruh status antrian pasien hari ini secara real-time.</p>
                            <span class="mt-6 inline-block text-sky-400 font-bold text-xs uppercase tracking-widest">Buka Menu →</span>
                        </a>
                    </div>

                {{-- Dashboard Khusus User (Pasien) --}}
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Ambil Antrian --}}
                        <a href="{{ route('user.queues.create') }}" class="group p-10 bg-white border-2 border-slate-50 rounded-[2.5rem] shadow-sm hover:border-sky-500 hover:shadow-2xl hover:shadow-sky-100 transition-all duration-500">
                            <div class="w-16 h-16 bg-sky-500 rounded-2xl flex items-center justify-center mb-8 shadow-xl shadow-sky-200 group-hover:scale-110 transition duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <h4 class="text-2xl font-black text-slate-800">{{ __('Ambil Nomor Antrian') }}</h4>
                            <p class="text-slate-500 mt-3 leading-relaxed">Pilih dokter dan poliklinik tujuan untuk mendapatkan nomor pemeriksaan hari ini.</p>
                            <div class="mt-8 flex items-center text-sky-500 font-black text-sm uppercase tracking-[0.2em]">
                                <span>Mulai Daftar</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 group-hover:translate-x-2 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </a>

                        {{-- Riwayat Antrian --}}
                        <a href="{{ route('user.queues.index') }}" class="group p-10 bg-white border-2 border-slate-50 rounded-[2.5rem] shadow-sm hover:border-slate-800 hover:shadow-2xl hover:shadow-slate-100 transition-all duration-500">
                            <div class="w-16 h-16 bg-slate-800 rounded-2xl flex items-center justify-center mb-8 shadow-xl shadow-slate-200 group-hover:scale-110 transition duration-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                                </svg>
                            </div>
                            <h4 class="text-2xl font-black text-slate-800">{{ __('Riwayat Antrian') }}</h4>
                            <p class="text-slate-500 mt-3 leading-relaxed">Cek estimasi waktu panggil dan lihat riwayat kunjungan medis Anda sebelumnya.</p>
                            <div class="mt-8 flex items-center text-slate-400 group-hover:text-slate-800 font-black text-sm uppercase tracking-[0.2em] transition">
                                <span>Lihat Riwayat</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 group-hover:translate-x-2 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </a>
                    </div>
                @endif
            </div>

            {{-- Footer Info --}}
            <div class="mt-12 text-center">
                <p class="text-slate-400 text-xs font-bold tracking-[0.3em] uppercase italic">
                    &copy; {{ date('Y') }} Klinik Mini Pro — Sistem Antrian Terintegrasi
                </p>
            </div>
        </div>
    </div>
</x-app-layout>