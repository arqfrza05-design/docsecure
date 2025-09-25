<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'filename',
        'original_name',
        'encrypted',
        'encryption_key_hash',
        'description',
        'recovery_key',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
