<?php

namespace allekurier\api_v1\model;

/**
 * @author ita@allekurier.pl
 */
class Pickup
{
	/**
	 * @var string
	 */
	private $date;

	/**
	 * @var string
	 */
	private $from;

	/**
	 * @var string
	 */
	private $to;

	public function __construct($date, $from, $to)
	{
		$this->date	 = $date;
		$this->from	 = $from;
		$this->to	 = $to;
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
	public function from()
	{
		return $this->from;
	}

	/**
	 * @return string
	 */
	public function to()
	{
		return $this->to;
	}
}
