<?php

namespace allekurier\api_v1\action;

use allekurier\api_v1\response\GetOrderStatusResponse;

/**
 * @author it@allekurier.pl
 */
class GetOrderStatusAction implements ActionInterface
{
	/**
	 * @var string
	 */
	private $hid;

	public function __construct($hid)
	{
		$this->hid = $hid;
	}

	/**
	 * {@inheritdoc}
	 */
	public function apiEndPoint()
	{
		return 'order_status';
	}

	/**
	 * {@inheritdoc}
	 */
	public function httpMethod()
	{
		return self::HTTP_METHOD_POST;
	}

	/**
	 * {@inheritdoc}
	 */
	public function request()
	{
		return [
			'hid' => $this->hid
		];
	}

    /**
     * @param array $response
     *
     * @return GetOrderStatusResponse
     */
	public function response(array $response)
	{
		return new GetOrderStatusResponse($response);
	}
}
