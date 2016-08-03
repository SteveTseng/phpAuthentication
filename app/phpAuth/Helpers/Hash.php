<?php

namespace phpAuth\Helpers;

class Hash
{
	protected $config;
	public function __construct($config)
	{
		$this->config = $config;
	}

	public function password($password)
	{
		return password_hash(
			$password,
			$this->config->get('app.hash.algo'),
			['cost' => $this->config->get('app.hash.cost')]
		);
	}

	public function passwordCheck($password, $hash)
	{
		return password_verify($password, $hash);
	}

	public function hash($input)
	{
		return hash('sha256',$input);
	}

	public function hashCheck($know, $user)
	{

		//this is needed for older version, i have the older version somehow..
		// if(!function_exists('hash_equals'))
		// 	{
		// 	    function hash_equals($know, $user)
		// 	    {
		// 	        if(strlen($know) != strlen($user))
		// 	        {
		// 	            return false;
		// 	        }
		// 	        else
		// 	        {
		// 	            $res = $know ^ $user;
		// 	            $ret = 0;
		// 	            for($i = strlen($res) - 1; $i >= 0; $i--)
		// 	            {
		// 	                $ret |= ord($res[$i]);
		// 	            }
		// 	            return !$ret;
		// 	        }
		// 	    }
		// 	}
		return hash_equals($known, $user);
	}
}