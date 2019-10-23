<?php

namespace allekurier\api_v1\response;

/**
 * @author it@allekurier.pl
 */
class GetUserBalanceResponse extends AbstractResponse
{
    /**
     * @var float
     */
    private $balance;

    /**
     * @return float
     */
    public function balance()
    {
        return $this->balance;
    }

    /**
     * Read API Response
     *
     * @param array $response
     */
    protected function readApiResponse(array $response)
    {
        $this->balance = $response['User']['balance'];
    }
}
