<?php

namespace allekurier\api_v1;

use allekurier\api_v1\action\ActionInterface;
use allekurier\api_v1\Credentials;
use allekurier\api_v1\vendor\Curl;

/**
 * AKAPI
 *
 * @author it@allekurier.pl
 * @see https://github.com/AlleKurier/api_v1
 * @version 1.0.0
 */
class AKAPI
{
	const API_URL = 'https://allekurier.pl/api_v1/';
	const API_FORMAT = 'json';

	/**
	 * @var Credentials
	 */
	private $credentials;

	/**
	 * @var Curl
	 */
	private $curl;

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;

		$this->curl = new Curl;
		$this->curl->setHeader('Accept', 'application/' . self::API_FORMAT);
	}

	/**
	 * Call action request to api
	 *
	 * @param ActionInterface $action
	 * @return AbstractResponse
	 *
	 * @throws \Exception
	 * @throws \InvalidArgumentException
	 */
	public function call(ActionInterface $action)
	{
		$this->curl->{$action->httpMethod()}(
			self::API_URL . $action->apiEndPoint(),
			$this->prepareRequest($action->request())
		);

		if ($this->curl->error) {
			throw new \Exception($this->curl->error_message, $this->curl->error_code);
		}

		$response = json_decode($this->curl->response, true);

		if ($response === null) {
			throw new \InvalidArgumentException('Nie można przetworzyć odpowiedzi.');
		}

		return $action->response($response);
	}

	/**
	 * @param array $request
	 * @return array
	 */
	private function prepareRequest(array $request)
	{
		return array_merge(
			$request,
			[
				'User' => [
					'email'    => $this->credentials->login(),
					'password' => $this->credentials->password()
				]
			]
		);
	}

	public function __destruct()
	{
		$this->curl->close();
	}
}
