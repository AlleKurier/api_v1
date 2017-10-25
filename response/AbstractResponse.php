<?php

namespace allekurier\api_v1\response;

/**
 * @author it@allekurier.pl
 */
abstract class AbstractResponse
{
	/**
	 * @var array
	 */
	private $errors;

	final public function __construct(array $response)
	{
		$this->errors = $response['Error'];

		if (!$this->hasErrors()) {
			$this->readResponse($response['Response']);
		}
	}

	/**
	 * @return bool
	 */
	public function hasErrors()
	{
		return !empty($this->errors);
	}

	/**
	 * @return array
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Read API Response
	 *
	 * @param array $response
	 */
	abstract protected function readApiResponse(array $response);
}
