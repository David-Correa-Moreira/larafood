<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'price',
        'description'
    ];

    public function search($search = null) {
        $results = $this->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description','LIKE',"%{$search}%")
                        ->paginate(2);
        return $results;
    }

}
