<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Barbecue extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'address',
        'participants',
        'date',
        'format',
        'total_cost',
        'payment_link_sent'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Uuid::uuid4();
        });
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}
