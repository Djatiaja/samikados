<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "parent_id",
        "description",
        "icon",
        "banner",
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}