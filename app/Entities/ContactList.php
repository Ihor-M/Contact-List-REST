<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
    /**
     * @var string
     */
    protected $table = 'contacts_list';

    /**
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'birthday_date',
        'basic_info',
    ];
}
