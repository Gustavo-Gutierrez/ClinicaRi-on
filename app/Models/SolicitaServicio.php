<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SolicitaServicio
 *
 * @property $ServicioID
 * @property $CitaID
 *
 * @property Citum $citum
 * @property Servicio $servicio
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SolicitaServicio extends Model
{
    
    static $rules = [
		'ServicioID' => 'required',
		'CitaID' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ServicioID','CitaID'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function citum()
    {
        return $this->hasOne('App\Models\Citum', 'CitaID', 'CitaID');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function servicio()
    {
        return $this->hasOne('App\Models\Servicio', 'ServicioID', 'ServicioID');
    }
    

}
