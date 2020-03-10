<?php

namespace allekurier\api_v1\model;

/**
 * @author it@allekurier.pl
 */
class Recipient extends AbstractIdentity
{
    /**
     * @var string
     */
    private $state;

    public function __construct(
        $name = null,
        $contact = null,
        $postalCode = null,
        $address = null,
        $city = null,
        $phone = null,
        $email = null,
        $country = null,
        $dropoffPoint = null,
        $state = null
    ) {
        parent::__construct($name, $contact, $postalCode, $address, $city, $phone, $email, $country, $dropoffPoint);

        $this->state = $state;
    }

    /**
     * @return string
     */
    public function state()
    {
        return $this->state;
    }
}
