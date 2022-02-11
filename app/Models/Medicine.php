<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode', 'nama', 'satuan', 'harga', 'tgl_masuk', 'tgl_edit', 'stok', 'produsen', 'distributor', 'categories_id', 'users_id'
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'categories_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
