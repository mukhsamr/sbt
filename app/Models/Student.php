<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    // A & M
    public function lahir(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->tanggal_lahir)->translatedFormat('d F Y')
        );
    }

    public function usia(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->tanggal_lahir)->age
        );
    }

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    public function parents()
    {
        return $this->belongsTo(Parents::class);
    }

    public function bidangTahfidzs()
    {
        return $this->hasManyThrough(BidangTahfidz::class, Santri::class);
    }

    public function bidangIts()
    {
        return $this->hasManyThrough(BidangIt::class, Santri::class);
    }

    public function bidangBahasas()
    {
        return $this->hasManyThrough(BidangBahasa::class, Santri::class);
    }

    public function bidangKarakters()
    {
        return $this->hasManyThrough(BidangKarakter::class, Santri::class);
    }


    // Scope
    public function scopeWithAyah($query)
    {
        $query->addSelect([
            'ayah' => Parents::select('nama_ayah')
                ->whereColumn('id', 'parents_id')
                ->take(1)
        ]);
    }
}
