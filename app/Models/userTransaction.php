<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userTransaction extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'transfer_user',
        'balance',
    ];

    /*
     *
     * Return Detail of transaction
     */

    public function getDetailAttribute(){

        if(!is_null($this->transfer_user)){
            $detail[] = "Transfer";

            $detail[] = ($this->type == 'credit') ? "from" : "to";

            $detail[] = User::find($this->transfer_user)->email;

        }else{
            $detail[] = ($this->type == 'credit') ? "Deposit" : "Withdraw";
        }

        return implode(" ", $detail);
    }
}
