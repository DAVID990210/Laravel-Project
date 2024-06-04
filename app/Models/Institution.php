<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'address'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
