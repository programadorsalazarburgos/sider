<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class TblGenSaludRegiman
 * 
 * @property int $tbl_regimen_salud
 * @property string $descripcion
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_dv_fichas
 *
 * @package App\Models
 */
class TblGenSaludRegiman extends Model
{
	protected $primaryKey = 'tbl_regimen_salud';
	public $timestamps = false;

	protected $fillable = [
		'descripcion'
	];

	public function tbl_dv_fichas()
	{
		return $this->hasMany(\App\Models\TblDvFicha::class, 'id_salud_regimen');
	}
}
