<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = [];
public function murids() { return $this->hasMany(Murid::class, 'kelas_id'); }
}
