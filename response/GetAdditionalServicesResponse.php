<?php

namespace allekurier\api_v1\response;

use allekurier\api_v1\response\AbstractResponse;
use allekurier\api_v1\model\AdditionalService;

/**
 * @author it@allekurier.pl
 */
class GetAdditionalServicesResponse extends AbstractResponse
{
	/**
	 * @var array
	 */
	private $services = [];

	/**
	 * {@inheritdoc}
	 */
	protected function readApiResponse(array $response)
	{
		foreach ($response as $code => $service) {
			$this->services[] = new AdditionalService(
				$code,
				$service['name'],
				$service['price']
			);
		}
	}

	/**
	 * @return array
	 */
	public function services()
	{
		return $this->services;
	}
}
