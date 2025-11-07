<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke tabel user (boleh tetap)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel general_informations
    public function generalInformation()
    {
        return $this->belongsTo(General_model::class, 'general_id', 'id');
    }

    protected static function booted()
    {
        static::created(function ($attendance) {
            // hanya update general_informations saat check in
            if ($attendance->status === 'check in') {
                $general = \App\Models\General_model::find($attendance->general_id);

                // pastikan data general_id ada
                if ($general) {
                    // hanya update jika latitude & longitude masih kosong
                    if (empty($general->latitude) && empty($general->longitude)) {
                        $general->update([
                            'latitude' => $attendance->latitude,
                            'longitude' => $attendance->longitude,
                            'update_date' => now()->toDateString(),
                            'update_time' => now()->toTimeString(),
                        ]);
                    }
                }
            }
        });
    }
}
