<?php
namespace Kaffe\FastPay\Model;


class Custom {

    /**
     * {@inheritdoc}
     */
    public function getPost($param)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $products = $objectManager->create('\Magento\Quote\Model\Quote')->load($param)->getAllVisibleItems();
        $productRepositoryFactory= $objectManager->create('\Magento\Catalog\Api\ProductRepositoryInterfaceFactory');
        $array=(object)[];
        $objectManager =\Magento\Framework\App\ObjectManager::getInstance();
        $helperImport = $objectManager->get('\Magento\Catalog\Helper\Image');

        $allproducts=[];
        foreach ($products as $product){
            $myproduct = $productRepositoryFactory->create()->getById($product->getProductId());
            $array->image= $helperImport->init($myproduct, 'product_page_image_small')
                ->setImageFile($myproduct->getImage()) // image,small_image,thumbnail
                ->resize(380)
                ->getUrl();
            $array->sku=$myproduct->getData('sku');
            $array->qty=$product->getData('qty');
            $array->price=$product->getData('price');
            $array->base_price=$product->getData('base_price');
            $array->discount_percent=$product->getData('discount_percent');
            $array->discount_amount=$product->getData('discount_amount');

            array_push($allproducts, $array);
        }


        return \GuzzleHttp\json_encode($allproducts);
    }
}
