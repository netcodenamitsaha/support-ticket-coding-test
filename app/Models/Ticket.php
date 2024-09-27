<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'is_closed',
        'is_responded',
    ];

    public function appliedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
