<?php

namespace allekurier\api_v1\action;

use allekurier\api_v1\response\GetOrderLabelResponse;
use allekurier\api_v1\action\ActionInterface;

/**
 * @author it@allekurier.pl
 */
class GetOrderLabelAction implements ActionInterface
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
		return 'order_label';
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
	 * @return GetOrderLabelResponse
	 */
	public function response(array $response)
	{
		return new GetOrderLabelResponse($response);
	}
}
