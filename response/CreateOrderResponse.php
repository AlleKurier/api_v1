<?php

namespace allekurier\api_v1\response;

use allekurier\api_v1\response\AbstractResponse;

/**
 * @author it@allekurier.pl
 */
class CreateOrderResponse extends AbstractResponse
{
	/**
	 * @var string
	 */
	private $hid;

	/**
	 * @var string
	 */
	private $number;

	/**
	 * @var float
	 */
	private $cost;

	/**
	 * @var status
	 */
	private $status;

	/**
	 * @return string
	 */
	public function hid()
	{
		return $this->hid;
	}

	/**
	 * @return string
	 */
	public function number()
	{
		return $this->number;
	}

	/**
	 * @return float
	 */
	public function cost()
	{
		return $this->cost;
	}

	/**
	 * @return string
	 */
	public function status()
	{
		return $this->status;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function readApiResponse(array $response)
	{
		$this->hid    = $response['hid'];
		$this->number = $response['number'];
		$this->cost   = $response['cost'];
		$this->status = $response['status'];
	}
}
