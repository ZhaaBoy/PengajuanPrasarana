<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'guru') {
            $pengajuans = Pengajuan::with('user')
                ->where('user_id', $user->id)
                ->get();
        } elseif ($user->role === 'kepala_sekolah') {
            $pengajuans = Pengajuan::with('user')->get();
        } elseif ($user->role === 'administrasi') {
            $pengajuans = Pengajuan::with('user')
                ->where('status_kepsek', 'approved')
                ->get();
        }

        return view('pengajuan.index', compact('pengajuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengajuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'tanggal_diperlukan' => 'required|date|after_or_equal:today',
        ]);

        Pengajuan::create([
            'user_id' => Auth::id(),
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,
            'tanggal_diperlukan' => $request->tanggal_diperlukan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil dikirim');
    }

    public function review($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('pengajuan.review', compact('pengajuan'));
    }

    public function approve($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'kepala_sekolah') {
            $pengajuan->status_kepsek = 'approved';
        } elseif ($user->role === 'administrasi' && $pengajuan->status_kepsek === 'approved') {
            $pengajuan->status_admin = 'approved';
        }

        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan disetujui');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'kepala_sekolah') {
            $pengajuan->status_kepsek = 'rejected';
            $pengajuan->alasan_kepsek = $request->alasan;

            // Otomatis reject juga dari sisi administrasi
            $pengajuan->status_admin = 'rejected';
            $pengajuan->alasan_admin = 'Ditolak oleh kepala sekolah';
        } elseif ($user->role === 'administrasi' && $pengajuan->status_kepsek === 'approved') {
            $pengajuan->status_admin = 'rejected';
            $pengajuan->alasan_admin = $request->alasan;
        }

        $pengajuan->save();

        return redirect()->back()->with('error', 'Pengajuan ditolak');
    }

    public function cetak($id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);

        if ($pengajuan->status_kepsek !== 'approved' || $pengajuan->status_admin !== 'approved') {
            return redirect()->back()->with('error', 'Pengajuan belum disetujui sepenuhnya.');
        }

        $pdf = Pdf::loadView('pengajuan.surat', compact('pengajuan'));
        return $pdf->download('surat-pengajuan-' . $pengajuan->id . '.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
}
