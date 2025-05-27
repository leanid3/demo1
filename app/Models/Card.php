<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Card extends Model
{
    /** @use HasFactory<\Database\Factories\CardFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['author', 'title', 'type', 'status', 'user_id', 'rejection_reason'];
    protected $casts = ['type' => 'string'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
