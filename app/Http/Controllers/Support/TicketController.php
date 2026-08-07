<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class TicketController extends Controller
{
    public function dashboard(): View
    {
        return view('support.dashboard');
    }

    public function index(): View
    {
        return view('support.tickets.index');
    }
}
