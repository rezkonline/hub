<?php

namespace App\Models;

use Parental\HasParent;
use App\Models\Relations\SupervisorRelations;

class Supervisor extends User
{
    use SupervisorRelations,
        HasParent;

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {
        return User::class;
    }

    /**
     * Get the default foreign key name for the model.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return 'user_id';
    }
}
