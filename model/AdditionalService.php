<?php

namespace allekurier\api_v1\model;

/**
 * @author it@allekurier.pl
 */
class AdditionalService
{
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

	public function __construct($code, $name, $net)
	{
		$this->code	= $code;
		$this->name	= $name;
		$this->net	= $net;
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
}
