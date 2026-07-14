<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSparepart extends Model
{
    protected $table = 'detail_spareparts';

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'sparepart_id');
    }
}