<?php

/**
 *
 *          ..::..
 *     ..::::::::::::..
 *   ::'''''':''::'''''::
 *   ::..  ..:  :  ....::
 *   ::::  :::  :  :   ::
 *   ::::  :::  :  ''' ::
 *   ::::..:::..::.....::
 *     ''::::::::::::''
 *          ''::''
 *
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Creative Commons License.
 * It is available through the world-wide-web at this URL:
 * http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 * If you are unable to obtain it through the world-wide-web, please send an email
 * to servicedesk@totalinternetgroup.nl so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact servicedesk@tig.nl for more information.
 *
 * @copyright   Copyright (c) Total Internet Group B.V. https://tig.nl/copyright
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */

namespace TIG\GLS\Service\DeliveryOptions;

use TIG\GLS\Model\Config\Provider\Carrier;
use TIG\GLS\Webservice\Endpoint\ParcelShop\GetParcelShops as ParcelShopsEndpoint;

class ParcelShops
{
    /** @var ParcelShopsEndpoint $parcelShopsEndpoint */
    private $parcelShopsEndpoint;

    /** @var Carrier $carrierConfig */
    private $carrierConfig;

    /**
     * GetParcelShops constructor.
     *
     * @param ParcelShopsEndpoint $parcelShopsEndpoint
     * @param Carrier             $carrierConfig
     */
    public function __construct(
        ParcelShopsEndpoint $parcelShopsEndpoint,
        Carrier $carrierConfig
    ) {
        $this->parcelShopsEndpoint = $parcelShopsEndpoint;
        $this->carrierConfig       = $carrierConfig;
    }

    /**
     * @param $postcode
     *
     * @return mixed
     * @throws \Zend_Http_Client_Exception
     */
    public function getParcelShops($postcode)
    {
        $parcelShopsAmount = $this->carrierConfig->getShopDeliveryShopAmount();
        $this->parcelShopsEndpoint->setRequestData(
            [
                'zipcode'       => $postcode,
                'amountOfShops' => $parcelShopsAmount
            ]
        );

        return $this->parcelShopsEndpoint->call();
    }
}
