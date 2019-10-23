<?php

namespace allekurier\api_v1\action;

use allekurier\api_v1\response\GetAdditionalServicesResponse;

/**
 * @author it@allekurier.pl
 */
class GetAdditionalServicesAction implements ActionInterface
{
	/**
	 * @var string
	 */
	private $service;

	/**
	 * @var string
	 */
	private $package;

	public function __construct($service, $package)
	{
		$this->service = $service;
		$this->package = $package;
	}

	/**
	 * {@inheritdoc}
	 */
	public function apiEndPoint()
	{
		return 'additional_services';
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
			'service' => $this->service,
			'package' => $this->package
		];
	}

    /**
     * @param array $response
     *
     * @return GetAdditionalServicesResponse
     */
	public function response(array $response)
	{
		return new GetAdditionalServicesResponse($response);
	}
}
