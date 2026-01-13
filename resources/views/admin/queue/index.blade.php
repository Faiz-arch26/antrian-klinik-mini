<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <div class="w-2 h-6 bg-sky-500 rounded-full"></div>
            <h2 class="font-bold text-xl text-slate-800 leading-tight">
                {{ __('Monitoring Seluruh Antrian Pasien') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-100 p-8">
                
                {{-- Alert Sukses --}}
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-4 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">No. Antrian</th>
                                <th class="px-4 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">Jadwal & Pasien</th>
                                <th class="px-4 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">Dokter / Poli</th>
                                <th class="px-4 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">Status</th>
                                <th class="px-4 py-5 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($queues as $q)
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                {{-- Nomor Antrian --}}
                                <td class="py-6 px-4">
                                    <span class="text-3xl font-black text-sky-600 italic">#{{ $q->queue_number }}</span>
                                </td>

                                {{-- Tanggal Kunjungan & Informasi Pasien --}}
                                <td class="py-6 px-4">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-black text-sky-500 uppercase tracking-widest mb-1">
                                            {{ \Carbon\Carbon::parse($q->visit_date)->format('d M Y') }}
                                        </span>
                                        <div class="font-bold text-slate-800 text-lg">{{ $q->user->name }}</div>
                                        <div class="text-xs text-slate-400 mt-1 italic leading-tight">Keluhan: {{ $q->complaint }}</div>
                                    </div>
                                </td>

                                {{-- Informasi Dokter --}}
                                <td class="py-6 px-4">
                                    <div class="font-bold text-slate-700">{{ $q->doctor->name }}</div>
                                    <span class="inline-block px-2 py-0.5 bg-sky-50 text-sky-600 text-[10px] font-black rounded uppercase tracking-widest mt-1 border border-sky-100">
                                        {{ $q->doctor->poliklinik->name }}
                                    </span>
                                </td>

                                {{-- Status Badge --}}
                                <td class="py-6 px-4">
                                    <span class="inline-flex px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                                        {{ $q->status == 'WAITING' ? 'bg-amber-100 text-amber-600' : '' }}
                                        {{ $q->status == 'CALLED' ? 'bg-sky-500 text-white shadow-md shadow-sky-100' : '' }}
                                        {{ $q->status == 'DONE' ? 'bg-emerald-100 text-emerald-600' : '' }}
                                        {{ $q->status == 'CANCELED' ? 'bg-slate-100 text-slate-400' : '' }}">
                                        {{ $q->status }}
                                    </span>
                                </td>

                                {{-- Tombol Aksi --}}
                                <td class="py-6 px-4 text-center">
                                    <div class="flex justify-center gap-3">
                                        @if($q->status == 'WAITING')
                                            <form action="{{ route('admin.queues.updateStatus', $q->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="CALLED">
                                                <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white text-[11px] font-black px-4 py-2 rounded-xl transition shadow-lg shadow-sky-100 uppercase tracking-widest">
                                                    Panggil
                                                </button>
                                            </form>
                                        @endif

                                        @if($q->status == 'CALLED')
                                            <form action="{{ route('admin.queues.updateStatus', $q->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="DONE">
                                                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white text-[11px] font-black px-4 py-2 rounded-xl transition shadow-lg shadow-emerald-100 uppercase tracking-widest">
                                                    Selesai
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-slate-100 p-4 rounded-full mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-slate-400 font-bold italic text-sm uppercase tracking-widest">Belum ada antrian terdaftar.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <p class="text-slate-400 text-[10px] font-bold tracking-[0.3em] uppercase">
                    &copy; {{ date('Y') }} Klinik Mini Pro — Dashboard Monitoring
                </p>
            </div>
        </div>
    </div>
</x-app-layout>