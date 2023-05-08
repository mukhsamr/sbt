<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangTahfidz extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];
    protected $touches = ['santri'];

    public function plpTahfidz()
    {
        return $this->belongsTo(PlpTahfidz::class);
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }


    // Scope
    public function scopeWithPlp($query)
    {
        $query->addSelect([
            'plp' => PlpTahfidz::select('plp')
                ->whereColumn('id', $this->getTable() . '.plp_tahfidz_id')
                ->take(1)
        ]);
    }
}
