<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemLog; // Verifique se este é o namespace correto para o seu modelo de log
use App\Visitors\LogVisitor;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = SystemLog::latest()->get(); // Obtém os logs mais recentes

        $visitor = new LogVisitor();
        foreach ($logs as $log) {
            $log->accept($visitor); // Aplica o Visitor a cada log
        }

        return view('logs.index', compact('logs'));
    }

    // Outros métodos do controller conforme necessário...
}
