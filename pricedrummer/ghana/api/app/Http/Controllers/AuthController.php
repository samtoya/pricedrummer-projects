<?php

namespace App\Http\Controllers;

use App\User;
use App\Utilities\RandomString;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AuthController extends Controller
{
	public function store(Request $request)
	{
		$this->validate( $request, [
			'username' => 'required',
			'password' => 'required',
		] );

		$username = $request->input( 'username' );
		$password = $request->input( 'password' );

		$user                  = new User();
		$user->username        = $username;
		$user->password        = bcrypt( $password );
		$user->user_type       = 'API';
		$user->activation_code = RandomString::random_str( 50 );
		$user->status          = 'A';

		if ( $user->save() ) {
			$response = [
				'message' => 'User was created successfully.',
				'user'    => $user,
			];
			return response()->json( $response, 201 );
		}
		$response = [
			'message' => 'An error occured.',
		];
		return response()->json( $response, 404 );
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function authenticate(Request $request)
	{
		$this->validate( $request, [
			'username' => 'required',
			'password' => 'required',
		] );

		// grab email & password from the request.
		$credentials = $request->only( 'username', 'password' );

		try {
			// attempt to verify the credentials and create a token for the user.
			if ( ! $token = JWTAuth::attempt( $credentials ) ) {
				return response()->json( [
					'message' => 'Invalid credentials',
				], 401 );
			}
		} catch ( JWTException $e ) {
			// something went wrong whilst attempting to encode the token.
			return response()->json( [ 'error' => 'Could not create token' ], 500 );
		}
		// all good so return the token.
		return response()->json( [
			'message' => 'User signed in successfully!',
			'token'   => $token,
		], 200 );
	}

	public function login()
	{
		return view('auth.login');
	}

	public function register()
	{
		return view( 'auth.register' );
	}
}
