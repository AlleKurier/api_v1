<?php

namespace allekurier\api_v1\response;

/**
 * @author it@allekurier.pl
 */
class CancelOrderResponse extends AbstractResponse
{
	/**
	 * @var bool
	 */
	private $isCanceled;

	/**
	 * @return bool
	 */
	public function isCanceled()
	{
		return $this->isCanceled;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function readApiResponse(array $response)
	{
		$this->isCanceled = $response['status'];
	}
}
