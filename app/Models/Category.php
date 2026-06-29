<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // BARIS INI DITAMBAHKAN
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; // BARIS INI DITAMBAHKAN

    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}