<?php
namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\Models\User\User;
use App\Models\User\UserDetails;
use App\Models\Country\Country;

class UserControllerTest extends TestCase
{
	use RefreshDatabase;
	
	protected function setUp(): void
	{
		parent::setUp();
		$this->withHeaders([
			'Accept' => 'application/json'
		]);
	}
	/**
	 * delete user without any details
	 *
	 * @return void
	 */
	public function testDeleteUserWithoutDetails()
	{
		$userId	= 12;
		User::factory()->create([
			'id'	=> $userId,
			'email' => 'test@test.com'
		]);
		
		$this->delete(route('user.delete', ['user' => $userId]))
			->assertStatus(Response::HTTP_OK)
			;
		
		$this->assertDatabaseMissing(with(new User())->getTable(), [
			'id'	=> $userId,
		]);
	}

	/**
	 * delete user with details
	 *
	 * @return void
	 */
	public function testDeleteUserWithDetails()
	{
		$userId		= 12;
		$countryId	= 5;
		
		User::factory()->create([
			'id'	=> $userId,
			'email' => 'test@test.com'
		]);
		
		Country::factory()->create([
			'id'	=> $countryId,
		]);	
		
		UserDetails::factory()->create([
			'user_id'					=> $userId,
			'citizenship_country_id'	=> $countryId
		]);
		
		
		$this->delete(route('user.delete', ['user' => $userId]))
			->assertStatus(Response::HTTP_FORBIDDEN)
			;
		
		$this->assertDatabaseHas(with(new User())->getTable(), [
			'id'	=> $userId,
		]);
		
		$this->assertDatabaseHas(with(new UserDetails())->getTable(), [
			'user_id'					=> $userId,
			'citizenship_country_id'	=> $countryId
		]);
	}
	
	/**
	 * delete with invalid user id
	 *
	 * @return void
	 */
	public function testWithInvalidUserId()
	{
		$this->delete(route('user.delete', ['user' => 20]))
			->assertStatus(Response::HTTP_NOT_FOUND)
			;
	}
}
