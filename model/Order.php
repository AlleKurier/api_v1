<?php

namespace allekurier\api_v1\model;

/**
 * @author it@allekurier.pl
 */
class Order
{
	/**
	 * @var float
	 */
	private $insurance;

	/**
	 * @var float
	 */
	private $cod;

	/**
	 * @var string
	 */
	private $description;

	/**
	 * @var string
	 */
	private $service;

	/**
	 * @var string
	 */
	private $package;

	/**
	 * @var string
	 */
	private $voucher;

	/**
	 * @var float
	 */
	private $value;

	/**
	 * @var string
	 */
	private $reference;

	/**
	 * @var string
	 */
	private $delivery;

	public function __construct(
		$service = null,
		$package = null,
		$description = null,
		$delivery = null,
		$cod = null,
		$insurance = null,
		$reference = null,
		$value = null,
		$voucher = null
	) {
		$this->description = $description;
		$this->reference   = $reference;
		$this->insurance   = $insurance;
		$this->delivery	   = $delivery;
		$this->service	   = $service;
		$this->package	   = $package;
		$this->voucher	   = $voucher;
		$this->value       = $value;
		$this->cod		   = $cod;
	}

    /**
     * @param string $package
     * @param float  $cod
     * @param float  $insurance
     *
     * @return Order
     */
	public static function createForPricing($package, $cod = null, $insurance = null)
	{
		return new static(null, $package, null, null, $cod, $insurance);
	}

	/**
	 * @return float
	 */
	public function insurance()
	{
		return $this->insurance;
	}

	/**
	 * @return float
	 */
	public function cod()
	{
		return $this->cod;
	}

	/**
	 * @return string
	 */
	public function description()
	{
		return $this->description;
	}

	/**
	 * @return string
	 */
	public function service()
	{
		return $this->service;
	}

	/**
	 * @return string
	 */
	public function package()
	{
		return $this->package;
	}

	/**
	 * @return string
	 */
	public function voucher()
	{
		return $this->voucher;
	}

	/**
	 * @return float
	 */
	public function value()
	{
		return $this->value;
	}

	/**
	 * @return string
	 */
	public function reference()
	{
		return $this->reference;
	}

	/**
	 * @return string
	 */
	public function delivery()
	{
		return $this->delivery;
	}
}
