<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisWardrobe extends Model
{
    use HasFactory;
    protected $table = "jenis";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function wardrobes()
    {
        return $this->hasMany(Wardrobe::class, 'jenis_id', 'id');
    }
 
}
