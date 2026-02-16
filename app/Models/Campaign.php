<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'goal', 'current_amount', 'user_id', 'status', 'main_image'];

    public function user() { return $this->belongsTo(User::class); }
    public function donations() { return $this->hasMany(Donation::class); }
    public function updates() { return $this->hasMany(Update::class); }

    public function progress() { return ($this->current_amount / $this->goal) * 100; }
}
