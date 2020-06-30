<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Kaffe\FastPay\Model\Quote;

class Item extends \Magento\Quote\Model\Quote\Item implements \Kaffe\FastPay\Api\Data\CartItemInterface
{

    /**
     * Quote Item Before Save prepare data process
     *
     * @return \Kaffe\FastPay\Model\Quote\Item
     */
    public function beforeSave()
    {
        parent::beforeSave();
        $this->setIsVirtual($this->getProduct()->getIsVirtual());
        if ($this->getQuote()) {
            $this->setQuoteId($this->getQuote()->getId());
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getImage()
    {
        return $this->getData(self::KEY_IMAGE);
    }

    /**
     * @inheritdoc
     */
    public function setImage($image)
    {
        return $this->setData(self::KEY_IMAGE, $image);
    }

}
