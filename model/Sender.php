<?php

namespace allekurier\api_v1\model;

use allekurier\api_v1\model\AbstractIdentity;

/**
 * @author it@allekurier.pl
 */
class Sender extends AbstractIdentity
{
	/**
	 * @var string
	 */
	private $bankAccount;

	public function __construct(
		$name = null,
		$contact = null,
		$postalCode = null,
		$address = null,
		$city = null,
		$phone = null,
		$email = null,
		$country = null,
		$dropoffPoint = null,
		$bankAccount = null
	) {
		$this->dropoffPoint	= $dropoffPoint;
		$this->bankAccount  = $bankAccount;
		$this->postalCode	= $postalCode;
		$this->contact		= $contact;
		$this->address		= $address;
		$this->country		= $country;
		$this->phone		= $phone;
		$this->email		= $email;
		$this->name			= $name;
		$this->city			= $city;
	}

	/**
	 * @return string
	 */
	public function bankAccount()
	{
		return $this->bankAccount;
	}
}
