<?php

declare(strict_types = 1);

namespace Service\Product;

use Model\Entity\Product;

class SorterByPrice implements ISorter
{
    /**
     * @inheritdoc
     */
    public function sort(array $products): array
    {

//        var_dump($products);
        $sortFunction = function (Product $a, Product $b) {
            if ($a->getPrice() === $b->getPrice()) {
                return 0;
            }

            return $a->getPrice() < $b->getPrice() ? -1 : 1;
        };


        usort($products, $sortFunction);
//        var_dump($products);
        return $products;
    }
}