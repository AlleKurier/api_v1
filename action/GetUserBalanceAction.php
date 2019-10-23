<?php

namespace allekurier\api_v1\action;

use allekurier\api_v1\response\AbstractResponse;
use allekurier\api_v1\response\GetUserBalanceResponse;

/**
 * @author it@allekurier.pl
 */
class GetUserBalanceAction implements ActionInterface
{
    /**
     * Return request array
     *
     * @return array
     */
    public function request()
    {
        return [];
    }

    /**
     * Return action response
     *
     * @param array $response
     *
     * @return AbstractResponse
     */
    public function response(array $response)
    {
        return new GetUserBalanceResponse($response);
    }

    /**
     * Return name of api end point
     *
     * @return string
     */
    public function apiEndPoint()
    {
        return 'user_balance';
    }

    /**
     * Return name of http method
     *
     * @return string
     */
    public function httpMethod()
    {
        return ActionInterface::HTTP_METHOD_POST;
}}
