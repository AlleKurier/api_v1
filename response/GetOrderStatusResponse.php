<?php

namespace allekurier\api_v1\response;

use allekurier\api_v1\model\Event;

/**
 * @author it@allekurier.pl
 */
class GetOrderStatusResponse extends AbstractResponse
{
	/**
	 * @var Event
	 */
	private $event;

	/**
	 * @return string
	 */
	public function date()
	{
		return $this->event->date();
	}

	/**
	 * @return string
	 */
	public function name()
	{
		return $this->event->name();
	}

	/**
	 * @return string
	 */
	public function status()
	{
		return $this->event->status();
	}

	/**
	 * {@inheritdoc}
	 */
	protected function readApiResponse(array $response)
	{
		$this->event = new Event(
			$response['Event']['name'],
			$response['Event']['date'],
			$response['Event']['status']
		);
	}
}
