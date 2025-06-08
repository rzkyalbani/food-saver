<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'partner_id',
        'category_id',
        'title',
        'description',
        'image',
        'start_date',
        'end_date',
        'status',
    ];
        
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
