<?php

namespace allekurier\api_v1\response;

use allekurier\api_v1\response\AbstractResponse;
use  allekurier\api_v1\model\PickupDate;

/**
 * @author it@allekurier.pl
 */
class GetPickupDatesResponse extends AbstractResponse
{
	/**
	 * @var array
	 */
	private $dates = [];

	/**
	 * @return array
	 */
	public function dates()
	{
		return $this->dates;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function readApiResponse(array $response)
	{
		foreach ($response as $date) {
			$this->dates[] = new PickupDate(
				$date['date'],
				$date['description'],
				$date['from'],
				$date['to']
			);
		}
	}
}
