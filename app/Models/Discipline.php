<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Discipline
 * 
 * @property int $MaKyLuat
 * @property string $Hinh Thuc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class Discipline extends Model
{
	protected $table = 'disciplines';
	protected $primaryKey = 'MaKyLuat';

	protected $fillable = [
		'hinhthuc'
	];

	public function employees()
	{
		return $this->belongsToMany(Employee::class, 'employeedisciplines', 'makyluat', 'manv')
			->withPivot('maklnv', 'lydo', 'ngaykyluat')
			->withTimestamps();
	}
}
