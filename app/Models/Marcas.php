<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    use HasFactory;
    protected $guarded = ['id_marca'];
    protected $primaryKey = 'id_marca';
    protected $table = 'marca';
    public $timestamps = false;

}
