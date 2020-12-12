<?php
namespace App\Models\User;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Country\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
	
	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table	= 'users';
	
	/**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey	= 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'email',
		'active',
    ];
			
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	/**
     * Validate the password of the user for the Passport password grant.
     *
     * @param  string  $password
     * @return bool
     */
    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }
	
	/**
	 * select active user
	 * 
	 * @param type $query
	 * @return type
	 */
	public function scopeActive($query)
	{
		$query->where('active', config('user-config.active'));
		return $query;
	}
	
	/**
	 * Select specific users based on their countries
	 * 
	 * @param type $query
	 * @param type $iso2
	 * @return type
	 */
	public function scopeCountry($query, $iso2)
	{
		$query->whereIn('id', function($query) use($iso2) {
			$query->select('user_id')
				->from(with(new UserDetails())->getTable())
				->whereIn('citizenship_country_id', function($query)  use($iso2) {
					$query->select('id')
						->from(with(new Country())->getTable())
						->where('iso2', $iso2)
						;
				})
				;
		});
		return $query;
	}
	
	public function details()
	{
		return $this->hasOne(UserDetails::class, 'user_id', 'id');
	}
}
