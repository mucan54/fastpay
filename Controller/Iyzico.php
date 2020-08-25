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

namespace Kaffe\FastPay\Controller;

use Iyzico\Iyzipay\Controller\IyzicoBase\IyzicoFormObjectGenerator;
use Iyzico\Iyzipay\Controller\IyzicoBase\IyzicoPkiStringBuilder;
use Iyzico\Iyzipay\Controller\IyzicoBase\IyzicoRequest;
use Magento\Customer\Api\Data\GroupInterface;


class Iyzico extends \Magento\Framework\App\Action\Action 
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
        \Magento\Framework\Json\EncoderInterface $encoder,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Iyzico\Iyzipay\Model\IyziCardFactory $iyziCardFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_context = $context;
        $this->_pageFactory = $pageFactory;
		$this->_jsonEncoder = $encoder;
        $this->_checkoutSession = $checkoutSession;
        $this->_customerSession = $customerSession;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context);
        $this->_iyziCardFactory = $iyziCardFactory;
        $this->_storeManager = $storeManager;
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
            
            $this->_customerSession->setIyziToken($postData['token']);
        }
        if(isset($postData['iyziQuoteEmail']) && isset($postData['iyziQuoteId'])) {

            $this->_customerSession->setEmail($postData['iyziQuoteEmail']);
            $this->_checkoutSession->setGuestQuoteId($postData['iyziQuoteId']);
            $guestEmail = $postData['iyziQuoteEmail'];
        }

        return;  

    }
}