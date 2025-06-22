<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class, 'id_supplier', 'id');
    }
}
