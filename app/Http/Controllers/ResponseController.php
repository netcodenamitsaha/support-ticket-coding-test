<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\TicketRespondedOrClosed;

class ResponseController extends Controller {

	public function __construct() {
		$this->middleware('admin')->only(['index', 'store']);
	}
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		$responses = Response::with('ticket', 'appliedBy')->paginate(10);
		return view('responses.index', compact('responses'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Ticket $ticket) {
		$response = Response::where('ticket_id', $ticket->id)->first()->response ?? '';
		return view('responses.create', compact('ticket', 'response'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request) {
		$request->validate([
			'response' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
		]);
		
		$ticket = Ticket::find($request->ticket_id);

		if ($ticket->is_closed || $ticket->is_responded) {
			return redirect()->route('tickets.index')->with('error', 'Ticket is already responded or closed.');
		}		

		$data['ticket_id'] = $request->ticket_id;
		$data['response'] = $request->response;
		$data['user_id'] = auth()->user()->id;

		DB::transaction(function () use($data, $ticket) {
			$response = Response::create($data);
			$ticket->is_responsed = 1;
			$ticket->save();
			$response->appliedBy->notify(new TicketRespondedOrClosed($ticket, 'responded'));
		});
		DB::commit();
		return redirect()->route('responses.index')->with('success', 'Response created successfully!');
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
