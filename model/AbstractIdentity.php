<?php

namespace allekurier\api_v1\model;

/**
 * @author it@allekurier.pl
 */
abstract class AbstractIdentity
{
	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $contact;

	/**
	 * @var string
	 */
	protected $postalCode;

	/**
	 * @var string
	 */
	protected $address;

	/**
	 * @var string
	 */
	protected $city;

	/**
	 * @var string
	 */
	protected $phone;

	/**
	 * @var string
	 */
	protected $email;

	/**
	 * @var string
	 */
	protected $country;

	/**
	 * @var string
	 */
	protected $dropoffPoint;

	public function __construct(
		$name = null,
		$contact = null,
		$postalCode = null,
		$address = null,
		$city = null,
		$phone = null,
		$email = null,
		$country = null,
		$dropoffPoint = null
	) {
		$this->dropoffPoint	= $dropoffPoint;
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
     * @param string $country
     * @param string $postalCode
     *
     * @return AbstractIdentity
     */
	public static function createForPricing($country, $postalCode = null)
	{
		return new static(null, null, $postalCode, null, null, null, null, $country);
	}

	/**
	 * @return string
	 */
	public function name()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function contact()
	{
		return $this->contact;
	}

	/**
	 * @return string
	 */
	public function postalCode()
	{
		return $this->postalCode;
	}

	/**
	 * @return string
	 */
	public function address()
	{
		return $this->address;
	}

	/**
	 * @return string
	 */
	public function city()
	{
		return $this->city;
	}

	/**
	 * @return string
	 */
	public function phone()
	{
		return $this->phone;
	}

	/**
	 * @return string
	 */
	public function email()
	{
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function country()
	{
		return $this->country;
	}

	/**
	 * @return string
	 */
	public function dropoffPoint()
	{
		return $this->dropoffPoint;
	}
}
