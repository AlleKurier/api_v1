<?php

namespace allekurier\api_v1\response;

use allekurier\api_v1\response\AbstractResponse;
use allekurier\api_v1\model\Service;

/**
 * @author it@allekurier.pl
 */
class GetServicesResponse extends AbstractResponse
{
	/**
	 * @var array
	 */
	private $services = [];

	/**
	 * @return array
	 */
	public function services()
	{
		return $this->services;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function readApiResponse(array $response)
	{
		foreach ($response as $service) {
			$this->services[] = new Service(
				$service['Carrier']['code'],
				$service['Carrier']['name'],
				$service['Service']['code'],
				$service['Service']['name'],
				$service['Order']['net'],
				$service['Order']['gross']
			);
		}
	}
}
