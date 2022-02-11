<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode', 'nama', 'jumlah', 'total', 'jk', 'medicines_id', 'users_id'
    ];

    public function medicine()
    {
        return $this->hasOne(Medicine::class, 'id', 'medicines_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
