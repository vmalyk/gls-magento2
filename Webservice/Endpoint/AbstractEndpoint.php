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
namespace TIG\GLS\Webservice\Endpoint;

use TIG\GLS\Webservice\Rest;

abstract class AbstractEndpoint implements EndpointInterface
{
    /** @var Rest $restApi */
    private $restApi;

    private $requestData = [];

    // @codingStandardsIgnoreStart
    protected $endpoint;

    protected $method = 'GET';
    // @codingStandardsIgnoreEnd

    /**
     * @param Rest $restApi
     */
    public function __construct(Rest $restApi)
    {
        $this->restApi = $restApi;
    }

    /**
     * @return mixed
     * @throws \Zend_Http_Client_Exception
     */
    public function call()
    {
        return $this->restApi->getRequest($this);
    }

    /**
     * @return string
     */
    public function getEndpointUrl()
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param array $requestData
     */
    public function setRequestData(array $requestData)
    {
        $this->requestData = $requestData;
    }

    /**
     * @return array
     */
    public function getRequestData()
    {
        return $this->requestData;
    }
}
