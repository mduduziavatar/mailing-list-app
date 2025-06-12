<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactList extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function contacts()
    {
        return $this->belongsToMany(\App\Models\Contact::class);
    }
    public function campaigns()
{
    return $this->hasMany(Campaign::class);
}
}
