<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
   use HasFactory;
    protected $fillable = ['amount', 'campaign_id', 'user_id', 'status', 'transaction_id','payment_method', 'reference', 'proof_path', 'proof_original_name', 'verified_at', 'verified_by',];

    public function campaign() { return $this->belongsTo(Campaign::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
