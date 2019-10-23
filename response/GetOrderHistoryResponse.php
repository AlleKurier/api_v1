<?php

namespace allekurier\api_v1\response;

use allekurier\api_v1\model\Event;

/**
 * @author it@allekurier.pl
 */
class GetOrderHistoryResponse extends AbstractResponse
{
	/**
	 * @var array
	 */
	private $events = [];

	/**
	 * @return array
	 */
	public function history()
	{
		return $this->events;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function readApiResponse(array $response)
	{
		foreach ($response['Event'] as $event) {
			$this->events[] = new Event(
				$event['name'],
				$event['date'],
				$event['status']
			);
		}
	}
}
