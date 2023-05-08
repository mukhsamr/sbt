<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlpKarakter extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];

    public function santris()
    {
        return $this->belongsToMany(Santri::class, (new BidangKarakter)->getTable());
    }
}
