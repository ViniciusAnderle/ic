<?php

namespace App\Visitors;

interface Visitor
{
    public function visitLog(\App\Models\SystemLog $log);
}

// app/Visitors/Visitable.php
namespace App\Visitors;

interface Visitable
{
    public function accept(Visitor $visitor);
}
