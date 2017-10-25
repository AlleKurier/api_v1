<?php

namespace allekurier\api_v1\model;

/**
 * @author it@allekurier.pl
 */
class PickupDate
{
	/**
	 * @var string
	 */
	private $date;

	/**
	 * @var string
	 */
	private $description;

	/**
	 * @var array
	 */
	private $from;

	/**
	 * @var array
	 */
	private $to;

	public function __construct($date, $description, $from, $to)
	{
		$this->date		   = $date;
		$this->description = $description;
		$this->from		   = $from;
		$this->to		   = $to;
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
	public function description()
	{
		return $this->description;
	}

	/**
	 * @return array
	 */
	public function from()
	{
		return $this->from;
	}

	/**
	 * @return array
	 */
	public function to()
	{
		return $this->to;
	}
}
