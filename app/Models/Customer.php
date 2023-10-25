<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    // rest of your model code

    // ...

    public function getAuthPassword()
    {
        return $this->password;
    }
}
