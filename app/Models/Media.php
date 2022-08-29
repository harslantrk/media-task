<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category_id',
        'description',
        'source',
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
      return $this->belongsTo('App\Models\Category');
    }
}
