<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class TicketController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.dashboard');
    }

    public function index(): View
    {
        return view('admin.tickets.index');
    }
}
