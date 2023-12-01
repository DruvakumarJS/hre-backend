<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'role',
        'password',
        'device_id',
        'isloggedin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function roles()
          {
             return $this->belongsTo(Roles::class,'role_id','id');

          } 

    public function employees(){
            return $this->hasMany(Employee::class,'id', 'user_id');
        }

     public function attendance(){
            return $this->hasMany(Attendance::class,'id', 'user_id');
        }
             
     public function intends(){
            return $this->hasMany(Intend::class,'id', 'user_id');
        }  

    
     public function tickets(){
            return $this->hasMany(Ticket::class,'id', 'owner');
        }

     public function sender(){
            return $this->hasMany(TicketConversation::class,'id', 'sender');
        }  

      public function recipient(){
            return $this->hasMany(TicketConversation::class,'id', 'recipient');
        } 

      public function departments(){
            return $this->hasMany(TicketDepartment::class,'role_id', 'id');
        } 

      public function histogram(){
            return $this->hasMany(Histogram_billing_details::class,'id', 'user_id');
        }

    
           



}
