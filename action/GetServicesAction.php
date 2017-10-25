<?php

namespace allekurier\api_v1\action;

use allekurier\api_v1\response\GetServicesResponse;
use allekurier\api_v1\action\ActionInterface;
use allekurier\api_v1\model\Packages;
use allekurier\api_v1\model\Sender;
use allekurier\api_v1\model\Recipient;
use allekurier\api_v1\model\Order;

/**
 * @author it@allekurier.pl
 */
class GetServicesAction implements ActionInterface
{
	/**
	 * @var Packages
	 */
	private $packages;

	/**
	 * @var Sender
	 */
	private $sender;

	/**
	 * @var Recipient
	 */
	private $recipient;

	/**
	 * @var Order
	 */
	private $order;

	public function __construct(
		Order $order,
		Sender $sender,
		Recipient $recipient,
		Packages $packages
	) {
		$this->packages	 = $packages;
		$this->sender	 = $sender;
		$this->recipient = $recipient;
		$this->order	 = $order;
	}

	/**
	 * {@inheritdoc}
	 */
	public function apiEndPoint()
	{
		return 'service_list';
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
			'Order' => [
				'package'   => $this->order->package(),
				'cod'       => $this->order->cod(),
				'insurance' => $this->order->insurance()
			],
			'Sender' => [
				'country'     => $this->sender->country(),
				'postal_code' => $this->sender->postalCode()
			],
			'Recipient' => [
				'country'     => $this->recipient->country(),
				'postal_code' => $this->recipient->postalCode()
			],
			'Packages'  => $this->packages->toArray()
		];
	}

	/**
	 * @return GetServicesResponse
	 */
	public function response(array $response)
	{
		return new GetServicesResponse($response);
	}
}
