<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketOpened;
use App\Notifications\TicketRespondedOrClosed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller {

	public function __construct() {
		$this->middleware('admin')->only(['closeTicket']);
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index() {

		if (auth()->user()->isAdmin == 1) {
			$tickets = Ticket::with('appliedBy')->paginate(10);
		} else {
			$tickets = Ticket::where('user_id', auth()->user()->id)->with('appliedBy')->paginate(10);
		}

		return view('tickets.index', compact('tickets'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		return view('tickets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request) {
		$request->validate([
			'title'       => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/', 'max:255'],
			'description' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
		]);

		$data['title']       = $request->title;
		$data['description'] = $request->description;
		$data['user_id']     = auth()->user()->id;
		$data['is_closed']   = 0;

		$admins = User::where('isAdmin', 1)->get();

		DB::transaction(function () use ($data, $admins) {
			$ticket = Ticket::create($data);

			foreach ($admins as $admin) {
				$admin->notify(new TicketOpened($ticket));
			}
		});

		return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
	}

	public function closeTicket(string $id) {
		$ticket = Ticket::find($id);
		$user   = auth()->user();

		if (Gate::denies('close-ticket', $user)) {
			return redirect()->route('tickets.index')->with('error', 'You are not allowed to close this ticket!');
		}

		$ticket->is_closed = 1;
		$ticket->save();
		$ticket->appliedBy->notify(new TicketRespondedOrClosed($ticket, 'closed'));
		return redirect()->route('tickets.index')->with('success', 'Ticket closed successfully!');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id) {
		abort(403, 'Unauthorized action.');
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id) {
		abort(403, 'Unauthorized action.');
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id) {
		abort(403, 'Unauthorized action.');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id) {
		abort(403, 'Unauthorized action.');
	}

}
