<?php
namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetails extends Model
{
	use HasFactory;
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'user_details';

	/**
	 * The primary key associated with the table.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'citizenship_country_id',
		'first_name',
		'last_name',
		'phone_number'
	];
	
	public $timestamps	= false;
	
	/**
     * Retrieve the model for a bound value based on user id.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
	public function resolveRouteBinding($value, $field = null)
	{
		parent::resolveRouteBinding($value);
		return $this->where('user_id', $value)->firstOrFail();
	}
}