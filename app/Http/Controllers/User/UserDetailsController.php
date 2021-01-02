<?php
namespace App\Http\Controllers\User;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateDetailsRequest;
use App\Models\User\UserDetails;

class UserDetailsController extends Controller
{
	/**
	 * update user details
	 *
	 * @param UpdateDetailsRequest $request
	 * @param UserDetails $userDetail bind UserDetails based on the user id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
	 */
	public function update(UpdateDetailsRequest $request, UserDetails $userDetail)
	{
		try {
			$userDetail->update($request->validated());
			return response('', Response::HTTP_OK);
		} catch (Exception $ex) {
			return response('', Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}
}
