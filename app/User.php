<?php

namespace App;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }


    public function posts(){
        return $this->hasMany('App\Post','author_id');
    }

    public function friends(){
        return $this->belongsToMany('App\User','friends','user_id', 'friend_id' );
    }

    public function hasFriendWithId($userID){
        return $this->friends->contains($userID);
    }

    public function addFriendById($friendID){
          $this->friends()->attach($friendID);
        $friend = User::find($friendID);
        $friend->friends()->attach($this->id);
    }
    public function removeFriendById($friendID){
          $this->friends()->detach($friendID);
        $friend = User::find($friendID);
        $friend->friends()->detach($this->id);
    }

}
