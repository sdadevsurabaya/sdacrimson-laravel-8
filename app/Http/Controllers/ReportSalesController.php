<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Jarak;
use App\Models\LaporanSales;
use App\Models\LocationTime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportSalesController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start;
        $endDate   = $request->end;

        // $users = User::pluck('name', 'id');
        $users = User::select('id', 'name', 'cabang_id')->get();
        // dump($users);
        $user = auth()->user();

        $jadwalsQuery = Jadwal::orderBy('created_at', 'desc')
            ->withTrashed()
            ->whereNull('deleted_at');

        if ($user->hasRole('Sales')) {
            // Sales hanya lihat data sendiri
            $jadwalsQuery->where('user_id', $user->id);
        } elseif ($user->hasRole('Toko')) {
            // Toko hanya lihat data user_id tertentu
            $allowedUserIds = [39, 40, 41, 42];
            $jadwalsQuery->whereIn('user_id', $allowedUserIds);
        } elseif ($user->hasRole('Manager Sales')) {
            // dump($user->cabang_id);
            $allowedUserIds = $users->where('cabang_id', $user->cabang_id)->pluck('id');
            $jadwalsQuery->whereIn('user_id', $allowedUserIds);
        }
        // Role lain bisa lihat semua data

        // Tambahkan filter tanggal jika tersedia
        if ($startDate && $endDate) {
            $jadwalsQuery->whereBetween('date', [$startDate, $endDate]);
        }

        $jadwals = $jadwalsQuery->get();
        // dump($jadwals);
        return view('reportsales.index', compact('users', 'jadwals'));
    }

    public function exportrekapvisit()
    {
        $users = User::pluck('name', 'id');
        return view('reportsales.rekapvisit', compact('users'));
    }

    public function previewrekapvisit($id)
    {

        $laporan = LaporanSales::with(['general', 'user', 'detailJadwal'])
            ->where('jadwal_id', $id)
            ->get();

        $userJadwal = Jadwal::with(['user'])->find($id);

        foreach ($laporan as $laporanItem) {
            $filteredDetailJadwal = $laporanItem->detailJadwal->where('jadwal_id', $laporanItem->jadwal_id)
                ->where('general_id', $laporanItem->general_id)
                ->first();

            $laporanItem->filteredDetailJadwal = $filteredDetailJadwal;
        }

        // dd($laporan);

        return view('reportsales.rekapPreview', compact('laporan', 'userJadwal'));
    }

    public function previewrekapAbsen($id)
    {
        $laporan = LaporanSales::with(['general', 'user', 'detailJadwal', 'jarak', 'attendance' => function ($query) use ($id) {
            $query->orderBy('id', 'asc');
            $query->where('jadwal_id', $id);
        }])
            ->where('jadwal_id', $id)
            ->get()
            ->sortBy(function ($laporan) {
                $attendance = $laporan->attendance->first();
                return $attendance ? $attendance->id : null;
            });

        $userJadwal = Jadwal::with(['user'])->find($id);

        $user_id = $laporan[0]->user_id ?? 0;

        $getJarak = Jarak::where('user_id', $user_id)->where('jadwal_id', $id)->orderBy('id', 'desc')->first();

        // dd($laporan[0]->created_at);

        $createdAt = $laporan[0]->created_at ?? now();

        $start = LocationTime::where('user_id', $user_id)
            ->whereDate('created_at', $createdAt)
            ->where('type', 'start')
            ->orderBy('id', 'desc')
            ->first();

        $stop = LocationTime::where('user_id', $user_id)
            ->whereDate('created_at', $createdAt)
            ->where('type', 'stop')
            ->orderBy('id', 'desc')
            ->first();

        // dd($stop);

        if ($stop) {
            $newLaporan = new LaporanSales([
                'jadwal_id'  => $id,
                'user_id'    => Auth::id(),
                'created_at' => $laporan[0]->created_at,
                'general_id' => $getJarak->general_id,

            ]);

            if ($getJarak) {
                $newLaporan->setRelation('jarak', collect([$getJarak]));
            }

            $laporan->push($newLaporan);

            //  dd($laporan);

        }

        return view('reportsales.rekapAbsen', compact('laporan', 'userJadwal', 'start', 'stop'));
    }
}
