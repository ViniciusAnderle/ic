<?php

namespace App\Visitors;

use App\Models\Log;

class SystemLogVisitor
{
    public function logAction($action, $details)
    {
        Log::create([
            'action' => $action,
            'details' => $details,
        ]);
    }
}
