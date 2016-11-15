<?php

namespace App\Repositories;

use App\Entities\ContactList;

class ContactListRepository extends AbstractRepository
{
    /**
     * @return mixed
     */
    protected function model()
    {
        return ContactList::class;
    }

}
