<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production_tools extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function production()
    {
        return $this->belongsTo(Production::class);
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }
}
