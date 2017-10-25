<?php

namespace allekurier\api_v1;

/**
 * @author it@allekurier.pl
 */
class Credentials
{
	/**
	 * @var string
	 */
	private $login;

	/**
	 * @var string
	 */
	private $password;

	public function __construct($login, $password)
	{
		$this->login	= $login;
		$this->password	= $password;
	}

	/**
	 * @return string
	 */
	public function login()
	{
		return $this->login;
	}

	/**
	 * @return string
	 */
	public function password()
	{
		return $this->password;
	}
}
