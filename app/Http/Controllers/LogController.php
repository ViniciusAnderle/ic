<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemLog; // Verifique se este é o namespace correto para o seu modelo de log

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

        return view('logs.index', compact('logs'));
    }

    // Outros métodos do controller conforme necessário...
}
