<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    use HasFactory;

    public function subscriptions() {
        return $this->hasMany(Subscription::class, 'lead_id');
    }
}
