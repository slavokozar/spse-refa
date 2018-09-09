<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $table = 'ticket_status';

    protected $fillable = ['ticket_id','user_id','status','level','description'];

    public function ticket(){
        return $this->belongsTo('App\Ticket');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }


    public function getCreatedAtAttribute($value){
        setlocale(LC_TIME, 'Slovak');
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i d. m. Y');
    }

    public function name(){
        switch($this->status){
            case 1 :    return 'Nová';
                        break;

            case 2 :    return 'Riešená';
                        break;

            case 3 :    return 'Presunutá';
                        break;

            case 4 :    return 'Vyriešená';
                        break;
        }
    }

    public function cssClass(){
        switch($this->status){
            case 1 :    return 'pending';
                        break;

            case 2 :    return 'processing';
                        break;

            case 3 :    return 'transfered';
                        break;

            case 4 :    return 'done';
                        break;
        }
    }
}
