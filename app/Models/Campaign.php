<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'subject', 'message', 'contact_list_id', 'start_date', 'end_date'
    ];

    public function list()
    {
        return $this->belongsTo(ContactList::class, 'contact_list_id');
    }
}