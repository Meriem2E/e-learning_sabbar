<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecon extends Model
{
    //
    /*use HasFactory;
    protected $fillable=[
        'id',
        'titre',
        'description',
        'file',
        ''
    ];*/
      protected $table = 'lecons';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
