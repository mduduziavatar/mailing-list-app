<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    
    protected $fillable = ['full_name', 'email'];

    public function lists()
    {
        return $this->belongsToMany(\App\Models\ContactList::class);
    }
}

