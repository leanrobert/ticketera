<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class TicketController extends Controller
{
    public function index(): View
    {
        return view('tickets.index');
    }

    public function create(): View
    {
        return view('tickets.create');
    }
}
