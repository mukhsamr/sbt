<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public static function active()
    {
        return self::firstWhere('is_active', 1)?->value('id');
    }

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }
}
