<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employeediscipline
 * 
 * @property int $maklnv
 * @property int $manv
 * @property int $makyluat
 * @property string $lydo
 * @property Carbon $ngaykyluat
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Discipline $discipline
 * @property Employee $employee
 *
 * @package App\Models
 */
class Employeediscipline extends Model
{
	protected $table = 'employeedisciplines';
	protected $primaryKey = 'maklnv';

	protected $casts = [
		'manv' => 'int',
		'makyluat' => 'int',
		'ngaykyluat' => 'datetime'
	];

	protected $fillable = [
		'manv',
		'makyluat',
		'lydo',
		'ngaykyluat'
	];

	public function discipline()
	{
		return $this->belongsTo(Discipline::class, 'makyluat');
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'manv');
	}
}
