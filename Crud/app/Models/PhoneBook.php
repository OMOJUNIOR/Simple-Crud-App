<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Illuminate\Http\Request;

class PhoneBook extends Model implements CanVisit
{
    use HasFactory, HasVisits;
    
    protected $fillable = [
        'name',
        'phone_number',
        'relationship',
        'country',
        'email',
        'job',
        'image',
    ];

    public static function validate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'relationship' => 'required',
            'country' => 'required',
            'email' => 'required',
            'job',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The accessors to append to the model's array form.
     * starts here
     */
    public function setUserId($userId)
    {
        $this->attributes['user_id'] = $userId;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setJob($job)
    {
        $this->attributes['job'] = $job;
    }

    public function getJob()
    {
        return $this->attributes['job'];
    }

    public function setImage($imageName)
    {
        $this->attributes['image'] = $imageName;
    }

    public function getImage()
    {
        return $this->attributes['image'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setEmail($email)
    {
        $this->attributes['email'] = $email;
    }

    public function getEmail()
    {
        return $this->attributes['email'];
    }

       public function setTelNumber($tel_number)
       {
           $this->attributes['phone_number'] = $tel_number;
       }

       public function getTelNumber()
       {
           return $this->attributes['phone_number'];
       }

     public function setRelationship($relationship)
     {
         $this->attributes['relationship'] = $relationship;
     }

        public function getRelationship()
        {
            return $this->attributes['relationship'];
        }

    public function setCountry($country)
    {
        $this->attributes['country'] = $country;
    }

    public function getCountry()
    {
        return $this->attributes['country'];
    }
}
