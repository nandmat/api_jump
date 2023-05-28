<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'vehiclePlate',
        'entryDateTime',
        'exitDateTime',
        'price',
        'userId'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
