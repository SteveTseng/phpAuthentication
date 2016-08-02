<?php

namespace phpAuth\Validation;

use Violin\Violin;
use phpAuth\User\User;

class Validator extends Violin
{
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
		
		$this->addFieldMessages([
			'email' => [
				'uniqueEmail' => 'That email is already in use.'
			]
		]);
	}

	public function validate_uniqueEmail($value, $input, $args)
	{
		$user = $this->user->where('email', $value);

		return ! (bool) $user->count();
	}
}
