<?php

namespace allekurier\api_v1\action;

use allekurier\api_v1\response\GetOrderLabelResponse;

/**
 * @author it@allekurier.pl
 */
class GetOrderLabelAction implements ActionInterface
{
	/**
	 * @var string
	 */
	private $number;

    /**
     * @var bool
     */
    private $getSmallLabel;

	public function __construct($number, $getSmallLabel = false)
	{
		$this->number = $number;
        $this->getSmallLabel = $getSmallLabel;
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
			'number'        => $this->number,
            'getSmallLabel' => $this->getSmallLabel
		];
	}

    /**
     * @param array $response
     *
     * @return GetOrderLabelResponse
     */
	public function response(array $response)
	{
		return new GetOrderLabelResponse($response);
	}
}
