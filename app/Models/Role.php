<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $tenchucvu
 * @property int $manv
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employee $employee
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';

	protected $casts = [
		'manv' => 'int'
	];

	protected $fillable = [
		'tenchucvu',
		'manv'
	];

	public function employee()
	{
		return $this->belongsTo(User::class, 'manv');
	}
}
