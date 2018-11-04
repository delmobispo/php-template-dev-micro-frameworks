<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model{

    protected $table = 'usuarios';
    protected $primaryKey = 'cod';
    protected $fillable = ['login'];
    protected $guarded = ['cod', 'senha'];
    protected $hidden = ['senha'];
    public $timestamps = false;

}