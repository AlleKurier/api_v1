<?php

namespace allekurier\api_v1\model;

/**
 * @author it@allekurier.pl
 */
class Event
{
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $date;

	/**
	 * @var string
	 */
	private $status;

	public function __construct($name, $date, $status)
	{
		$this->status = $status;
		$this->name	  = $name;
		$this->date	  = $date;
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
	public function date()
	{
		return $this->date;
	}

	/**
	 * @return string
	 */
	public function status()
	{
		return $this->status;
	}
}
