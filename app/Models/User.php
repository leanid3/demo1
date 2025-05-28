<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * атрибуты массового присваивания
     *
     * @var list<string>
     */
    protected $fillable = [
        'login',
        'name',
        'phone',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * атрибуты скрытые при сериализации
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * атрибуты приведения типов
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // связи
    public function cards()
    {
        return $this->hasMany(Card::class, 'user_id', 'id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function courses(){
        return $this->hasMany(Course::class, 'user_id'. 'id');
    }
}
