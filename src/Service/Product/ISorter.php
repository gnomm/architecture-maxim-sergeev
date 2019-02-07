<?php

declare(strict_types = 1);

namespace Service\Product;

interface ISorter
{
    /**
     * @param array $products
     * 
     * @return array
     */
    public function sort(array $products): array;
}