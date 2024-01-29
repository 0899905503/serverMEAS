<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Relative
 * 
 * @property int $id
 * @property string $hotentn
 * @property Carbon $ngaysinh
 * @property string $diachi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Relationship $relationship
 *
 * @package App\Models
 */
class Relative extends Model
{
	protected $table = 'relatives';

	protected $casts = [
		'ngaysinh' => 'datetime'
	];

	protected $fillable = [
		'hotentn',
		'ngaysinh',
		'diachi'
	];

	public function relationship()
	{
		return $this->hasOne(Relationship::class, 'matn');
	}
}
