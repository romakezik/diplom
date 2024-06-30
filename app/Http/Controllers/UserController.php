<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Flight;
use App\Models\Ticket;
use App\Models\User;
use Ramsey\Uuid\Type\Decimal;

class UserController extends Controller
{
    public function tickets()
    {
        if (User::get("id") == null) return view('user.tickets');
        else {
        $tickets = auth()->user()->tickets()->with('flight.car', 'flight.driver', 'flight.route', 'entrance_stop', 'exit_stop')->get();
        return view('user.tickets', compact('tickets'));}
    }

    public function cancelTicket($id)
    {
        $ticket = Ticket::find($id);
        $flight = $ticket->flight;
        $flight->increment('available_seats');
        $ticket->delete();

        return redirect()->back()->with('success', 'Ticket cancelled successfully');
    }

}
