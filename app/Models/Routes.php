<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    use HasFactory;
    protected $table = 'routes';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'origin', 'destination','depart_time', 'duration'];
    
    public $timestamps = true;
}
