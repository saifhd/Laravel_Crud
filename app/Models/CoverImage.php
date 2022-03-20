<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'company_id'
    ];
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
