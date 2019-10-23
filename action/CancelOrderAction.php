<?php

namespace allekurier\api_v1\action;

use allekurier\api_v1\response\CancelOrderResponse;

/**
 * @author it@allekurier.pl
 */
class CancelOrderAction implements ActionInterface
{
	/**
	 * @var string
	 */
	private $number;

	public function __construct($number)
	{
		$this->number = $number;
	}

	/**
	 * {@inheritdoc}
	 */
	public function apiEndPoint()
	{
		return 'order_cancel';
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
			'number' => $this->number
		];
	}

    /**
     * @param array $response
     *
     * @return CancelOrderResponse
     */
	public function response(array $response)
	{
		return new CancelOrderResponse($response);
	}
}
