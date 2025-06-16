<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['full_name', 'email'];

    public function lists()
    {
        return $this->belongsToMany(\App\Models\ContactList::class);
    }
    public function contactLists()
{
    return $this->lists();
}
}

