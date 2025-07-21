<?php
namespace App\Http\Controllers\APi\Timer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimerNotificationController extends Controller
{
    /**
     * Memeriksa detail jadwal terbaru yang sudah check-in tetapi belum checkout.
     * Versi ini dioptimalkan dengan Eloquent Relationships.
     */
    public function checkForNewCheckin()
    {
        $loggedInUserId = Auth::id();
        // JWTAuth::invalidate($request->token);

        if (! $loggedInUserId) {
            return response()->json(null);
        }

        // Ambil data absensi paling terakhir untuk PENGGUNA INI dan HANYA PADA HARI INI
        $latestAttendance = Attendance::with('generalInformation')
            ->where('user_id', $loggedInUserId)
        // [PERUBAHAN] Filter record yang dibuat hanya pada tanggal hari ini
            ->whereDate('created_at', today())
            ->latest() // Urutkan dari yang paling baru (untuk hari ini)
            ->first();
        // dump($latestAttendance);
        // Cek jika data terakhir ada DAN statusnya adalah 'check in'
        if ($latestAttendance && $latestAttendance->status == 'check in') {

            if ($latestAttendance->generalInformation) {
                return response()->json([
                    'id'           => $latestAttendance->id,
                    'jadwal_id'    => $latestAttendance->jadwal_id,
                    'general_id'   => $latestAttendance->general_id,
                    'date'         => $latestAttendance->created_at->toDateString(),
                    'nama_usaha'   => $latestAttendance->generalInformation->nama_usaha,
                    'checkin_time' => $latestAttendance->created_at->toIso8601String(),
                    'message'      => 'Anda sedang dalam status Check-in!',
                ]);
            }
        }

        // Jika tidak ada check-in aktif untuk hari ini, kirim null.
        return response()->json(null);
    }
}
