<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    public function index(): View
    {
        Gate::authorize('viewAny', Ticket::class);

        return view('admin.tickets.index');
    }
}
