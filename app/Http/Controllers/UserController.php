<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function __construct() {
		$this->middleware('admin')->only(['index', 'update']);
	}
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		$users = User::all();
		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		abort(403, 'Unauthorized action.');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request) {
		abort(403, 'Unauthorized action.');
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
	public function update(string $id, int $status) {
		$user = User::findOrFail($id);

		if ($status == 0) {
			$user->isAdmin = 1;
		} else {
			$user->isAdmin = 0;
		}

		$user->update();

		return redirect()->back()->with('success', 'Action done successfully!');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id) {
		abort(403, 'Unauthorized action.');
	}

}
