<?php

namespace allekurier\api_v1\model;

/**
 * @author it@allekurier.pl
 */
class DropoffPoint
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $latitude;

	/**
	 * @var string
	 */
	private $longitude;

	/**
	 * @var string
	 */
	private $code;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $address;

	/**
	 * @var string
	 */
	private $postalCode;

	/**
	 * @var string
	 */
	private $city;

	/**
	 * @var string
	 */
	private $image;

	/**
	 * @var string
	 */
	private $openHours;

	/**
	 * @var bool
	 */
	private $isSupportCod;

	public function __construct(
		$id,
		$latitude,
		$longitude,
		$code,
		$name,
		$address,
		$postalCode,
		$city,
		$image,
		$openHours,
		$isSupportCod
	) {
		$this->id			= (int) $id;
		$this->latitude		= $latitude;
		$this->longitude	= $longitude;
		$this->code			= $code;
		$this->name			= $name;
		$this->address		= $address;
		$this->postalCode	= $postalCode;
		$this->city			= $city;
		$this->image		= $image;
		$this->openHours	= $openHours;
		$this->isSupportCod	= (bool) $isSupportCod;
	}

	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function latitude()
	{
		return $this->latitude;
	}

	/**
	 * @return string
	 */
	public function longitude()
	{
		return $this->longitude;
	}

	/**
	 * @return string
	 */
	public function code()
	{
		return $this->code;
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
	public function address()
	{
		return $this->address;
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
	public function city()
	{
		return $this->city;
	}

	/**
	 * @return string
	 */
	public function image()
	{
		return $this->image;
	}

	/**
	 * @return string
	 */
	public function openHours()
	{
		return $this->openHours;
	}

	/**
	 * @return bool
	 */
	public function isSupportCod()
	{
		return $this->isSupportCod;
	}
}
