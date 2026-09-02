<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    protected $guarded = [];
public function kelas() { return $this->belongsTo(Kelas::class, 'kelas_id'); }
}
