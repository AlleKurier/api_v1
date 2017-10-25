<?php

namespace allekurier\api_v1\model;

/**
 * @author it@allekurier.pl
 */
class Service
{
	/**
	 * @var string
	 */
	private $carrierCode;

	/**
	 * @var string
	 */
	private $carrierName;

	/**
	 * @var string
	 */
	private $code;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var float
	 */
	private $net;

	/**
	 * @var float
	 */
	private $gross;

	public function __construct($carrierCode, $carrierName, $serviceCode, $serviceName, $net, $gross)
	{
		$this->carrierCode = $carrierCode;
		$this->carrierName = $carrierName;
		$this->code	       = $serviceCode;
		$this->name		   = $serviceName;
		$this->net		   = $net;
		$this->gross	   = $gross;
	}

	/**
	 * @return string
	 */
	public function carrierCode()
	{
		return $this->carrierCode;
	}

	/**
	 * @return string
	 */
	public function carrierName()
	{
		return $this->carrierName;
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
	 * @return float
	 */
	public function net()
	{
		return $this->net;
	}

	/**
	 * @return float
	 */
	public function gross()
	{
		return $this->gross;
	}
}
