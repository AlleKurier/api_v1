<?php

namespace allekurier\api_v1\response;

/**
 * @author it@allekurier.pl
 */
class GetOrderLabelResponse extends AbstractResponse
{
	/**
	 * @var string
	 */
	private $label;

	/**
	 * @return string
	 */
	public function label()
	{
		return $this->label;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @throws \Exception
	 */
	protected function readApiResponse(array $response)
	{
		if (($label = base64_decode($response['label'])) === false) {
			throw new \Exception('Nie można przetworzyć pliku.');
		}

		$this->label = $label;
	}
}
