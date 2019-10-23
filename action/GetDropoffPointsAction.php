<?php

namespace allekurier\api_v1\action;

use allekurier\api_v1\response\GetDropoffPointsResponse;

/**
 * @author ita@allekurier.pl
 */
class GetDropoffPointsAction implements ActionInterface
{
	/**
	 * @var string
	 */
	private $carrier;

	/**
	 * @var string
	 */
	private $postalCode;

	public function __construct($carrier, $postalCode)
	{
		$this->postalCode = $postalCode;
		$this->carrier	  = $carrier;
	}

	/**
	 * {@inheritdoc}
	 */
	public function apiEndPoint()
	{
		return 'access_points';
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
			'carrier'	  => $this->carrier,
			'postal_code' => $this->postalCode
		];
	}

    /**
     * @param array $response
     *
     * @return GetDropoffPointsResponse
     */
	public function response(array $response)
	{
		return new GetDropoffPointsResponse($response);
	}
}
