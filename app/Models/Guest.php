<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['barbecue_id', 'name', 'email', 'paid_value'];

    public function barbecue()
    {
        return $this->belongsTo(Barbecue::class);
    }
}
