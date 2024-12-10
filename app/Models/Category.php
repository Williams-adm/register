<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'status'
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucwords($value),
            set: fn(string $value) => strtolower($value),
        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d-m-Y H:i:s'),
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d-m-Y H:i:s'),
        );
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
