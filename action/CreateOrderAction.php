<?php

namespace allekurier\api_v1\action;

use allekurier\api_v1\response\CreateOrderResponse;
use allekurier\api_v1\model\Recipient;
use allekurier\api_v1\model\Packages;
use allekurier\api_v1\model\Sender;
use allekurier\api_v1\model\Pickup;
use allekurier\api_v1\model\Order;

/**
 * @author it@allekurier.pl
 */
class CreateOrderAction implements ActionInterface
{
	/**
	 * @var Order
	 */
	private $order;

	/**
	 * @var Sender
	 */
	private $sender;

	/**
	 * @var Recipient
	 */
	private $recipient;

	/**
	 * @var Packages
	 */
	private $packages;

	/**
	 * @var Pickup
	 */
	private $pickup;

	/**
	 * @var array
	 */
	private $additionalServices = [];

	public function __construct(
		Order $order,
		Sender $sender,
		Recipient $recipient,
		Packages $packages,
		Pickup $pickup = null,
		array $additionalServices = []
	) {
		$this->additionalServices = $additionalServices;
		$this->recipient = $recipient;
		$this->packages  = $packages;
		$this->sender    = $sender;
		$this->pickup    = $pickup;
		$this->order     = $order;
	}

	/**
	 * {@inheritdoc}
	 */
	public function apiEndPoint()
	{
		return 'order_create';
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
		$recipient = $this->recipient;
		$sender    = $this->sender;
		$order     = $this->order;
		$pickup    = [];

		if ($this->pickup instanceof Pickup) {
			$pickup = [
				'date' => $this->pickup->date(),
				'from' => $this->pickup->from(),
				'to'   => $this->pickup->to(),
			];
		}

		return [
			'Order' => [
				'cod'		  => $order->cod(),
				'insurance'   => $order->insurance(),
				'description' => $order->description(),
				'service'     => $order->service(),
				'voucher'     => $order->voucher(),
				'delivery'    => $order->delivery(),
				'value'       => $order->value(),
				'package'     => $order->package()
			],
			'Sender' => [
				'name'			=> $sender->name(),
				'person'		=> $sender->contact(),
				'address'		=> $sender->address(),
				'city'			=> $sender->city(),
				'postal_code'	=> $sender->postalCode(),
				'country'		=> $sender->country(),
				'phone'			=> $sender->phone(),
				'email'			=> $sender->email(),
				'dropoff_point' => $sender->dropoffPoint(),
				'bank_account'  => $sender->bankAccount()
			],
			'Recipient' => [
				'name'			=> $recipient->name(),
				'person'		=> $recipient->contact(),
				'address'		=> $recipient->address(),
				'city'			=> $recipient->city(),
				'postal_code'	=> $recipient->postalCode(),
				'country'		=> $recipient->country(),
				'phone'			=> $recipient->phone(),
				'email'			=> $recipient->email(),
				'dropoff_point' => $recipient->dropoffPoint()
			],
			'Pickup'   => $pickup,
			'Packages' => $this->packages->toArray(),
			'Services' => $this->additionalServices
		];
	}

    /**
     * @param array $response
     *
     * @return CreateOrderResponse
     */
	public function response(array $response)
	{
		return new CreateOrderResponse($response);
	}
}
