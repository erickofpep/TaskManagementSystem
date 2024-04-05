<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    
    /**
     * Get the User who owns Tasks.
     */
    public function user()
    {
        return $this->belongsTo('App\User');

    }

}
