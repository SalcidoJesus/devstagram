<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
		'username'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

	public function posts()
	{
		/*
			este usuario tiene muchos post
			si en la table de post, la llave foranea se llama id_autor
			ps eso se pone como segundo parámetro en las función hasMany
		*/
		return $this->hasMany(Post::class);
	}

	public function likes()
	{
		return $this->hasMany(Like::class);
	}

	// almacena seguidores de un usuario
	public function followers() {
		return $this -> belongsToMany( User::class, 'followers', 'user_id', 'follower_id');
	}

	// comprobar si seguimos a alguien
	public function siguiendo( User $user ) {
		return $this -> followers -> contains( $user -> id );
	}

	// almacena a los que seguimos
	public function followings() {
		return $this -> belongsToMany( User::class, 'followers', 'follower_id', 'user_id');
	}

}
