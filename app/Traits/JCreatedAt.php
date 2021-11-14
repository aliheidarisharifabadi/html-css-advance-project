<?php

namespace App\Traits;

use Hekmatinasser\Verta\Verta;

/**
 * Trait JCreatedAt
 *
 * @package App\Traits
 *
 * @property Verta $j_created_at
 */
trait JCreatedAt
{
    public function getJCreatedAtAttribute()
    {
        return Verta::instance($this->created_at)->format('h:m Y-m-d');
    }

}
