<?php

namespace allekurier\api_v1\response;

use allekurier\api_v1\model\DropoffPoint;

/**
 * @author it@allekurier.pl
 */
class GetDropoffPointsResponse extends AbstractResponse
{
	/**
	 * @var array
	 */
	private $points = [];

	/**
	 * @return array[DropoffPoint]
	 */
	public function points()
	{
		return $this->points;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function readApiResponse(array $response)
	{
		foreach ($response['AccessPoints'] as $point) {
			$point = $point['AccessPoints'];

			$this->points[$point['id']] = new DropoffPoint(
				$point['id'],
				$point['latitude'],
				$point['longitude'],
				$point['code'],
				$point['name'],
				$point['address'],
				$point['postal_code'],
				$point['city'],
				$point['image_url'],
				$point['open_hours'],
				$point['cod']
			);
		}
	}
}
