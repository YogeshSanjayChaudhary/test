<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject {
	use Notifiable;
	use SoftDeletes;
	protected $table = 'user';

	public function getJWTIdentifier() {
		return $this->getKey();
	}

	public function getJWTCustomClaims() {
		return [];
	}

	protected $fillable = [
		'username', 'first_name', 'last_name', 'mobile', 'email', 'password', 'status', 'user_type',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

}
