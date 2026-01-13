<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QueueController extends Controller
{
    /**
     * SISI USER: Menampilkan riwayat antrian pasien
     */
    public function index()
    {
        $queues = Queue::with('doctor.poliklinik')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
            
        return view('user.queue.index', compact('queues'));
    }

    /**
     * SISI USER: Menampilkan form pendaftaran antrian
     */
    public function create()
    {
        $doctors = Doctor::with('poliklinik')->get();
        return view('user.queue.create', compact('doctors'));
    }

    /**
     * SISI USER: Proses pendaftaran
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'visit_date' => 'required|date|after_or_equal:today',
            'complaint' => 'required|min:10', 
        ]);

        $userId = Auth::id();
        $doctorId = $request->doctor_id;
        $date = $request->visit_date;

        // Cek Duplikat
        $existingQueue = Queue::where('user_id', $userId)
            ->where('doctor_id', $doctorId)
            ->where('visit_date', $date)
            ->first();

        if ($existingQueue) {
            return redirect()->back()->withErrors(['doctor_id' => 'Anda sudah terdaftar di dokter ini pada tanggal tersebut.']);
        }

        // Cek Kuota (Maksimal 20)
        $currentQueueCount = Queue::where('doctor_id', $doctorId)
            ->where('visit_date', $date)
            ->count();

        if ($currentQueueCount >= 20) {
            return redirect()->back()->withErrors(['doctor_id' => 'Kuota antrian penuh. Silakan pilih hari lain.']);
        }

        $nextQueueNumber = $currentQueueCount + 1;

        Queue::create([
            'user_id' => $userId,
            'doctor_id' => $doctorId,
            'visit_date' => $date,
            'complaint' => $request->complaint,
            'queue_number' => $nextQueueNumber,
            'status' => 'WAITING', 
        ]);

        return redirect()->route('user.queues.index')->with('success', 'Pendaftaran berhasil! Nomor antrian Anda: ' . $nextQueueNumber);
    }

    /**
     * SISI ADMIN: Menampilkan semua antrian (Perbaikan Utama)
     */
    public function indexAdmin()
    {
        // KUNCI PERBAIKAN: Hapus filter 'whereDate' agar semua data dari database ditarik
        $queues = Queue::with(['user', 'doctor.poliklinik'])
            ->orderBy('visit_date', 'asc') // Urutkan dari tanggal terdekat
            ->orderBy('queue_number', 'asc')
            ->get();

        return view('admin.queue.index', compact('queues'));
    }

    /**
     * SISI ADMIN: Mengubah status antrian
     */
    public function updateStatus(Request $request, Queue $queue)
    {
        $request->validate([
            'status' => 'required|in:WAITING,CALLED,DONE,CANCELED'
        ]);

        $queue->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pasien ' . $queue->user->name . ' diperbarui.');
    }

    /**
     * SISI USER: Membatalkan antrian
     */
    public function cancel(Queue $queue)
    {
        if ($queue->user_id !== Auth::id()) {
            abort(403);
        }

        if ($queue->status !== 'WAITING') {
            return redirect()->back()->with('error', 'Antrian sudah diproses.');
        }

        $queue->update(['status' => 'CANCELED']);
        return redirect()->back()->with('success', 'Antrian berhasil dibatalkan.');
    }
}