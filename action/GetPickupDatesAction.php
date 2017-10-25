<?php

namespace allekurier\api_v1\action;

use allekurier\api_v1\response\GetPickupDatesResponse;
use allekurier\api_v1\action\ActionInterface;

/**
 * @author it@allekurier.pl
 */
class GetPickupDatesAction implements ActionInterface
{
	/**
	 * @var string
	 */
	private $carrier;

	/**
	 * @var string
	 */
	private $postalCode;

	/**
	 * @var string
	 */
	private $country;

	public function __construct($carrier, $postalCode, $country)
	{
		$this->postalCode = $postalCode;
		$this->carrier	  = $carrier;
		$this->country	  = $country;
	}

	/**
	 * {@inheritdoc}
	 */
	public function apiEndPoint()
	{
		return 'pickup_dates';
	}

	/**
	 * {@inheritdoc}
	 */
	public function httpMethod()
	{
		return ActionInterface::HTTP_METHOD_POST;
	}

	/**
	 * {@inheritdoc}
	 */
	public function request()
	{
		return [
			'postal_code' => $this->postalCode,
			'carrier'     => $this->carrier,
			'country'     => $this->country
		];
	}

	/**
	 * @return GetPickupDatesResponse
	 */
	public function response(array $response)
	{
		return new GetPickupDatesResponse($response);
	}
}
