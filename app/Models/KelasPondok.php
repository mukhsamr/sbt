<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasPondok extends Model
{
    public $timstamps = false;
    protected $guarded = ['id'];

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }
}
