<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wardrobe extends Model
{
    protected $table = 'wardrobe';
    protected $primaryKey = 'id';

    use HasFactory;
    public function shootings()
    {
        return $this->belongsToMany(Shooting::class, 'shooting_wardrobe', 'wardrobe_id', 'shooting_id')->withPivot('deskripsi');
    }

    public function serialNumber()
    {
        return $this->hasMany(SerialNumber::class, 'foreign_id', 'id');
    }
}
