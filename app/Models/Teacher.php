<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function catatans()
    {
        return $this->hasMany(Catatan::class);
    }
}
