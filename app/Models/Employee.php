<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 * 
 * @property int $manv
 * @property string $tennv
 * @property string $gioitinh
 * @property Carbon $ngaysinh
 * @property string $diachi
 * @property string|null $sdt
 * @property string $trinhdo
 * @property string $quoctich
 * @property string $dantoc
 * @property string|null $tongiao
 * @property string $cccd
 * @property Carbon $ngaycap
 * @property string $noicap
 * @property Carbon $ngayvaolam
 * @property string|null $ngoaingu
 * @property string $tinhoc
 * @property string $diachithuongtru
 * @property string $mabacluong
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Discipline[] $disciplines
 * @property Relationship $relationship
 *
 * @package App\Models
 */
class Employee extends Model
{
	protected $table = 'employees';
	protected $primaryKey = 'manv';

	protected $casts = [
		'ngaysinh' => 'datetime',
		'ngaycap' => 'datetime',
		'ngayvaolam' => 'datetime'
	];

	protected $fillable = [
		'tennv',
		'gioitinh',
		'ngaysinh',
		'diachi',
		'sdt',
		'trinhdo',
		'quoctich',
		'dantoc',
		'tongiao',
		'cccd',
		'ngaycap',
		'noicap',
		'ngayvaolam',
		'ngoaingu',
		'tinhoc',
		'diachithuongtru',
		'mabacluong',
		'maklnv'
	];

	public function disciplines()
	{
		return $this->belongsToMany(Discipline::class, 'employeedisciplines', 'manv', 'makyluat')
			->withPivot('maklnv', 'lydo', 'ngaykyluat')
			->withTimestamps();
	}

	public function relationship()
	{
		return $this->hasOne(Relationship::class, 'manv');
	}
}
