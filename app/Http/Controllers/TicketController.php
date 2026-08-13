<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    public function index(): View
    {
        return view('tickets.index');
    }

    public function closed(): View
    {
        return view('tickets.closed');
    }

    public function create(): View
    {
        return view('tickets.create');
    }

    public function show(Ticket $ticket): View
    {
        Gate::authorize('view', $ticket);

        return view('tickets.show', ['ticket' => $ticket]);
    }
}
