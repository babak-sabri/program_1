<?php
namespace App\Http\Controllers\User;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Models\User\User;

class UserController extends Controller
{
    /**
     *
     * get active Austrian citizenship
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
	public function index()
	{
		try {
			return response([
				'data' => User::active()
							->country('AT')
							->get()
			], Response::HTTP_OK);
		} catch (Exception $ex) {
			return response('', Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}

	/**
	 * destroy user if do not have details record
	 * It is being checked by CheckUserDetails middleware
	 *
	 * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		try {
			$user->delete();
			return response('', Response::HTTP_OK);
		} catch (Exception $ex) {
			return response('', Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}
}
