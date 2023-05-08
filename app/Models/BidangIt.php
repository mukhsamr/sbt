<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangIt extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];

    public function plpIt()
    {
        return $this->belongsTo(PlpIt::class);
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    // Scope
    public function scopeWithPlp($query)
    {
        $query->addSelect([
            'plp' => PlpIt::select('plp')
                ->whereColumn('id', $this->getTable() . '.plp_it_id')
                ->take(1)
        ]);
    }

    public function scopeWithKelasPayung($query)
    {
        $query->addSelect([
            'kelas_payung' => KelasPayung::select('kelas')
                ->whereHas('santris', fn ($query) => $query->whereColumn('id', 'santri_id'))
                ->take(1)
        ]);
    }
}
