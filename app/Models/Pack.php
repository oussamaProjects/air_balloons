<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Pack extends Model
{
   
    use AsSource;
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'commercial_name',
        'description',
        'price',
        'color',
        'active'
    ];
}
