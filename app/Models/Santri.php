<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function catatans()
    {
        return $this->hasMany(Catatan::class);
    }

    public function bidangTahfidz()
    {
        return $this->hasOne(BidangTahfidz::class);
    }

    public function bidangIt()
    {
        return $this->hasOne(BidangIt::class);
    }

    public function bidangBahasa()
    {
        return $this->hasOne(BidangBahasa::class);
    }

    public function bidangKarakter()
    {
        return $this->hasOne(BidangKarakter::class);
    }

    // 
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function kelasPayung()
    {
        return $this->belongsTo(KelasPayung::class);
    }

    public function kelasPondok()
    {
        return $this->belongsTo(KelasPondok::class);
    }



    // Scope
    public function scopeIsActive($query)
    {
        $query->addSelect('semester_id')->where('semester_id', Semester::active());
    }

    // public function scopeWithKelasPayung($query)
    // {
    //     $query->addSelect([
    //         'kelas_payung' => KelasPayung::select('kelas')
    //             ->whereColumn('id', 'kelas_payung_id')
    //             ->take(1)
    //     ]);
    // }

    // public function scopeWithKelasPondok($query)
    // {
    //     $query->addSelect([
    //         'kelas_pondok' => KelasPondok::select('kelas')
    //             ->whereColumn('id', 'kelas_pondok_id')
    //             ->take(1)
    //     ]);
    // }
}
