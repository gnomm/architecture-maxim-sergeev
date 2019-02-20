<?php
namespace Service\Order;


abstract class BasketTemplate
{

    final public function basketTemplateMethod(): void
    {
        $this->addProduct();
        $this->getDiscount();
        $this->getUser();
        $this->checkout();
    }

    abstract function addProduct();

    abstract function getDiscount();

    abstract function getUser();

    abstract function checkout();
}