<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Kaffe\FastPay\Api\Data;

/**
 * Interface CartItemInterface
 * @api
 * @since 100.0.2
 */
interface CartItemInterface extends \Magento\Quote\Api\Data\CartItemInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const KEY_IMAGE = 'image';

    /**
     * Returns the product Image.
     *
     * @return string|null Product image url. Otherwise, null.
     */
    public function getImage();

    /**
     * Sets the product Image.
     *
     * @param string $image
     * @return $this
     */
    public function setImage($image);

}
