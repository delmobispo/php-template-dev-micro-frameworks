<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{

    protected $table = 'categorias';
    protected $primaryKey = 'cod';
    protected $fillable = ['nome'];
    protected $guarded = ['cod'];
    public $timestamps = false;

}