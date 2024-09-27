<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketRespondedOrClosed;
use Illuminate\Http\Request;

class ResponseController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		$responses = Response::with( 'ticket', 'appliedBy' )->paginate( 10 );
		return view( 'responses.index', compact( 'responses' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create( Ticket $ticket ) {
		$response = Response::where( 'ticket_id', $ticket->id )->first()->response ?? '';
		return view( 'responses.create', compact( 'ticket', 'response' ) );
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store( Request $request ) {
		$request->validate( [
			'response' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'],
		] );

		$data['ticket_id'] = $request->ticket_id;
		$data['response'] = $request->response;
		$data['user_id'] = auth()->user()->id;

		Response::create( $data );
		Ticket::where( 'id', $request->ticket_id )->update( ['is_responded' => 1] );

		$ticket = Ticket::find( $request->ticket_id );
		$ticket->appliedBy->notify( new TicketRespondedOrClosed( $ticket, 'response' ) );
		return redirect()->route( 'responses.index' )->with( 'success', 'Response created successfully!' );
	}

	/**
	 * Display the specified resource.
	 */
	public function show( string $id ) {
		abort( 403, 'Unauthorized action.' );
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit( string $id ) {
		abort( 403, 'Unauthorized action.' );
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update( Request $request, string $id ) {
		abort( 403, 'Unauthorized action.' );
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy( string $id ) {
		abort( 403, 'Unauthorized action.' );
	}
}
