<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;
    protected $fillable = ['name', 'description'];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
