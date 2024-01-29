<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rank
 * 
 * @property int $id
 * @property string $tenngach
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Salaryscale[] $salaryscales
 *
 * @package App\Models
 */
class Rank extends Model
{
	protected $table = 'ranks';

	protected $fillable = [
		'tenngach'
	];

	public function salaryscales()
	{
		return $this->hasMany(Salaryscale::class, 'mangach');
	}
}
