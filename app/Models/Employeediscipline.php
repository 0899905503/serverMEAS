<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employeediscipline extends Model
{
	protected $table = 'employeedisciplines';

	protected $casts = [
		'manv' => 'int',
		'makyluat' => 'int',
		'ngaykyluat' => 'datetime',
		'tienphat' => 'float' // Thêm dòng này
	];

	protected $fillable = [
		'manv',
		'makyluat',
		'lydo',
		'ngaykyluat',
		'tienphat' // Thêm dòng này
	];

	public function discipline()
	{
		return $this->belongsTo(Discipline::class, 'makyluat');
	}

	public function employee()
	{
		return $this->belongsTo(User::class, 'manv');
	}
}
