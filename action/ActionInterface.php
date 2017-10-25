<?php

namespace allekurier\api_v1\action;

/**
 * @author it@allekurier.pl
 */
interface ActionInterface
{
	const HTTP_METHOD_POST = 'post';
	const HTTP_METHOD_GET  = 'get';

	/**
	 * Return request array
	 *
	 * @return array
	 */
	public function request();

	/**
	 * Return action response
	 *
	 * @param array $response
	 * @return AbstractResponse
	 */
	public function response(array $response);

	/**
	 * Return name of api end point
	 *
	 * @return string
	 */
	public function apiEndPoint();

	/**
	 * Return name of http method
	 *
	 * @return string
	 */
	public function httpMethod();
}
