<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['name','pc'];

    public function tickets(){
        return $this->hasMany('App\Models\Ticket');
    }

    public function managers(){
        return $this->belongsToMany('App\Models\User')->withPivot('level');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('not_global', function (Builder $builder) {
            $builder->where('areas.id', '>', 1);
        });
    }


}
