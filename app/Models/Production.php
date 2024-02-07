<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function production_user()
    {
        return $this->hasMany(Production_users::class);
    }

    public function production_tool()
    {
        return $this->hasMany(Production_tools::class);
    }
}
