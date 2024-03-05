<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'Personal_id',
		'Qualification',
		'name',
		'email',
		'first_name',
		'last_name',
		'email_verified_at',
		'password',
		'remember_token',
		'address',
		'phone_number',
		'gender',
		'birth_date',
		'is_active',
		'Nationality',
		'Ethnicity',
		'Religion',
		'Issue_Date',
		'Issued_By',
		'Start_Date',
		'Language',
		'Computer_Science',
		'Permanent_Address',
		'avatar',
		'Role_id'
	];
	public function role()
	{
		return $this->belongsTo(Role::class, 'Role_id', 'id');
	}
}
