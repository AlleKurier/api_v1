<?php

namespace allekurier\api_v1\response;

use allekurier\api_v1\model\Event;

/**
 * @author it@allekurier.pl
 */
class GetOrderStatusResponse extends AbstractResponse
{
    /**
     * @var string
     */
    private $hid;

    /**
     * @var string|null
     */
    private $number;

    /**
     * @var string
     */
    private $created;

    /**
     * @var string|null
     */
    private $sent;

    /**
     * @var string|null
     */
    private $delivered;

	/**
	 * @var Event
	 */
	private $event;

    /**
     * @return string
     */
    public function hid()
    {
        return $this->hid;
    }

    /**
     * @return string|null
     */
    public function number()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function created()
    {
        return $this->created;
    }

    /**
     * @return string|null
     */
    public function sent()
    {
        return $this->sent;
    }

    /**
     * @return string|null
     */
    public function delivered()
    {
        return $this->delivered;
    }

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
        $this->hid = $response['Order']['hid'];
        $this->number = $response['Order']['number'] ? $response['Order']['number'] : null;
        $this->created = $response['Order']['created'];
        $this->sent = $response['Order']['sent'] ? $response['Order']['sent'] : null;
        $this->delivered = $response['Order']['delivered'] ? $response['Order']['delivered'] : null;

		$this->event = new Event(
			$response['Event']['name'],
			$response['Event']['date'],
			$response['Event']['status']
		);
	}
}
