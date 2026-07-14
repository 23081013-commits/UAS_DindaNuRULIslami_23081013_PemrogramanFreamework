<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailServis extends Model
{
    protected $table = 'detail_servis';

    public function detailSpareparts()
    {
        return $this->hasMany(DetailSparepart::class, 'detail_servis_id');
    }
}