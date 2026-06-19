<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\User;

class HolidayController extends Controller
{
    
    public function index()
    {

        $user = auth()->user();
        $divisi = \App\Models\Divisi::with('ketua')->find($user->divisi_id);

        // Ambil data karyawan (untuk dropdown pilihan ketua oleh Admin)
        $semuaKaryawan = \App\Models\User::all();

        // Ambil data libur (untuk kalender)
        $holidays = Holiday::orderBy('tanggal', 'asc')->get();

        return view('pages.jadwal', compact('divisi', 'semuaKaryawan', 'holidays'));
    }

    // Menyimpan tanggal libur baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
        ]);

        Holiday::create($request->all());

        return redirect()->back()->with('success', 'Hari libur berhasil ditambahkan ke kalender!');
    }

    // Menghapus hari libur
    public function destroy($id)
    {
        Holiday::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Hari libur berhasil dihapus.');
    }

    public function getHolidays()
    {
        // Ambil semua libur
        $holidays = Holiday::all(); 

        // Pastikan kita mengembalikan array yang benar untuk FullCalendar
        $events = [];
        foreach ($holidays as $holiday) {
            $events[] = [
                'title' => $holiday->keterangan,
                'start' => $holiday->tanggal,
                'allDay' => true,
                'backgroundColor' => '#ef4444',
                'borderColor' => '#ef4444'
            ];
        }

        return response()->json($events);
    }
}