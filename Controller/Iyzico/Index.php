<?php
/**
 * iyzico Payment Gateway For Magento 2
 * Copyright (C) 2018 iyzico
 * 
 * This file is part of Iyzico/Iyzipay.
 * 
 * Iyzico/Iyzipay is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Kaffe\FastPay\Controller\Iyzico;


class Index extends \Magento\Framework\App\Action\Action 
{
	
    protected $_context;
    protected $_pageFactory;
    protected $_jsonEncoder;
    protected $_checkoutSession;
    protected $_customerSession;
    protected $_scopeConfig;
    protected $_iyziCardFactory;
    protected $_storeManager;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->_context = $context;
        $this->_checkoutSession = $checkoutSession;
        $this->_customerSession = $customerSession;
        parent::__construct($context);
    }
    
	/**
	 * Takes the place of the M1 indexAction. 
	 * Now, every IyziPayGeneratorCheckout has an execute
	 *
	 ***/
    public function execute() 
    {

        /* customer to checkout session */

        $postData = $this->getRequest()->getPostValue();
        $checkoutSession = $this->_checkoutSession->getQuote();

        $guestEmail = false;

        if(isset($postData['token'])){
            echo 1;
            
            $this->_customerSession->setIyziToken($postData['token']);
        }
        if(isset($postData['iyziQuoteEmail']) && isset($postData['iyziQuoteId'])) {

            echo 2;

            $this->_customerSession->setEmail($postData['iyziQuoteEmail']);
            $this->_checkoutSession->setGuestQuoteId($postData['iyziQuoteId']);
            $guestEmail = $postData['iyziQuoteEmail'];
        }
        print_r($postData);
        die();
        return true;  

    }
}