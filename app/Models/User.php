<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UploadImageTrait;

class User extends Authenticatable
{
    use HasFactory, Notifiable,UploadImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','name', 'email', 'description','profile_image','phone',
    ];
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public static function createUser(array $data,$file = null)
    {
        $user = new self($data);
        if ($file) {
            $user->setProfileImage($file);
        }
        $user->save();
        return $user;
    }

    public function setProfileImage($file)
    {
        $this->profile_image = $this->uploadImage($file);
    }
}
