<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['name','pc'];

    public function tickets(){
        return $this->hasMany('App\Models\Ticket');
    }

    public function solvedTickets(){
        return $this->tickets()->whereHas('status', function($query) {
            return $query->where('status', 4);
        });
    }

    public function managers(){
        return $this->belongsToMany('App\Models\User')->withPivot('level');
    }

    public function getTicketAtAttribute($value){
        if($value == null) return null;

        setlocale(LC_TIME, 'Slovak');
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i d.m.Y');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('not_global', function (Builder $builder) {
            $builder->where('areas.id', '>', 1);
        });
    }


}
