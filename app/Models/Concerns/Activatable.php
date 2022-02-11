<?php

namespace App\Models\Concerns;

use App\Models\Scopes\HasActivatedAtScope;
use App\Models\Helpers\HasActivatedAtHelpers;

trait Activatable
{
    use HasActivatedAtHelpers,
        HasActivatedAtScope;
}
