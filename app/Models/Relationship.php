<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Relationship
 * 
 * @property int $manv
 * @property int $matn
 * @property string $loaiquanhe
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employee $employee
 * @property Relative $relative
 *
 * @package App\Models
 */
class Relationship extends Model
{
	protected $table = 'relationships';
	public $incrementing = false;

	protected $casts = [
		'manv' => 'int',
		'matn' => 'int'
	];

	protected $fillable = [
		'manv',
		'matn',
		'loaiquanhe'
	];

	public function employee()
	{
		return $this->belongsTo(User::class, 'manv');
	}

	public function relative()
	{
		return $this->belongsTo(Relative::class, 'matn');
	}
}
