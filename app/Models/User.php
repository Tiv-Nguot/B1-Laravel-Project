<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image_profile',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
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

    public function sentFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'requester_id');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id1', 'user_id2');
    }

    public function friendsOf()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id2', 'user_id1');
    }


    
    public static function register($request, $id = null)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'email_verified_at',
            'remember_token',
        ]);

        $data['password'] = bcrypt($request->password);
        $data['email_verified_at'] = now();
        $data['remember_token'] = Str::random(20);

        return self::updateOrCreate(['id' => $id], $data);
    }

    
}
