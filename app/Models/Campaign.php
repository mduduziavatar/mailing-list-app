<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['subject', 'message', 'contact_list_id'];

    public function list()
    {
        return $this->belongsTo(ContactList::class, 'contact_list_id');
    }
}