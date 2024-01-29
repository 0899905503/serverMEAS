<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Salaryscale
 * 
 * @property int $id
 * @property int $mangach
 * @property float $bacluong
 * @property float $hesoluong
 * @property int $manv
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Rank $rank
 * @property Employee $employee
 *
 * @package App\Models
 */
class Salaryscale extends Model
{
	protected $table = 'salaryscales';

	protected $casts = [
		'mangach' => 'int',
		'bacluong' => 'float',
		'hesoluong' => 'float',
		'manv' => 'int'
	];

	protected $fillable = [
		'mangach',
		'bacluong',
		'hesoluong',
		'manv'
	];

	public function rank()
	{
		return $this->belongsTo(Rank::class, 'mangach');
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'manv');
	}
}
