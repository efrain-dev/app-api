<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $guarded = ['id_producto'];
    protected $primaryKey = 'id_producto';
    protected $table = 'producto';
    public $timestamps = false;
}
