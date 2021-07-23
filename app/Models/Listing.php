<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'prop_type',
        'prop_category',
        'location',
        'value',
        'description',
        'acquired_on',
        'user_id'
    ];

    public function container() {
        return $this->belongsTo('App\Models\Listing', 'prop_type', 'id');
    }
}
