<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\MailResetPasswordToken;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function retiros()
    {
        return $this->hasMany(Retiro::class);
    }
    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    public function publish (Item $item)
    {
        $item->retiro_id = 1;
        $item->tag_id = 1;
        $item->laboratorio_id = 1;

        $this->items()->save($item);
    }
}
