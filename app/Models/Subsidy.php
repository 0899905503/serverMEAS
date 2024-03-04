<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subsidy
 * 
 * @property int $id
 * @property int $manv
 * @property string $tenphucap
 * @property Carbon $thang
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employee $employee
 *
 * @package App\Models
 */
class Subsidy extends Model
{
	protected $table = 'subsidies';

	protected $casts = [
		'manv' => 'int',
		'thang' => 'datetime'
	];

	protected $fillable = [
		'manv',
		'tenphucap',
		'thang'
	];

	public function employee()
	{
		return $this->belongsTo(User::class, 'manv');
	}
}
