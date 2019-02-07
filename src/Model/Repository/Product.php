<?php

declare(strict_types=1);

namespace Model\Repository;

use Model\Entity;

class Product
{
    /**
     * Поиск продуктов по массиву id
     *
     * @param int[] $ids
     * @return Entity\Product[]
     */


    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }
        $productList = [];
//        $products = new Entity\Product();
        $products = new Entity\Product(1, 'test', 200);

        foreach ($this->getDataFromSource(['id' => $ids]) as $item) {
            $cloneProducts = clone $products;
            $cloneProducts->setId($item['id']);
            $cloneProducts->setName($item['name']);
            $cloneProducts->setPrice($item['price']);

            $productList[] = $cloneProducts;
        }
        return $productList;
    }


//    public function search(array $ids = []): array
//    {
//        if (!count($ids)) {
//            return [];
//        }
//        $productList = [];
//        foreach ($this->getDataFromSource(['id' => $ids]) as $item) {
//            $productList[] = new Entity\Product($item['id'], $item['name'], $item['price']);
//        }
//        return $productList;
//    }

    /**
     * Получаем все продукты
     *
     * @return Entity\Product[]
     */
//    public function fetchAll(): array
//    {
//        $productList = [];
//        foreach ($this->getDataFromSource() as $item) {
//            $productList[] = new Entity\Product($item['id'], $item['name'], $item['price']);
//        }
////var_dump($productList);
//        return $productList;
//    }

    public function fetchAll(): array
    {

        $productList = [];

//        $products = new Entity\Product();
//        $products = new Entity\Product($id, $name,$price);
        $products = new Entity\Product(1, 'test', 200);


        foreach ($this->getDataFromSource() as $item) {

            $cloneProducts = clone $products;
            $cloneProducts->setId($item['id']);
            $cloneProducts->setName($item['name']);
            $cloneProducts->setPrice($item['price']);

            $productList[] = $cloneProducts;

        }

//        var_dump($productList);

//        var_dump($new);
        return $productList;
    }


    /**
     * Получаем продукты из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $dataSource = [
            [
                'id' => 1,
                'name' => 'PHP',
                'price' => 15300,
            ],
            [
                'id' => 2,
                'name' => 'Python',
                'price' => 20400,
            ],
            [
                'id' => 3,
                'name' => 'C#',
                'price' => 30100,
            ],
            [
                'id' => 4,
                'name' => 'Java',
                'price' => 30600,
            ],
            [
                'id' => 5,
                'name' => 'Ruby',
                'price' => 18600,
            ],
            [
                'id' => 8,
                'name' => 'Delphi',
                'price' => 8400,
            ],
            [
                'id' => 9,
                'name' => 'C++',
                'price' => 19300,
            ],
            [
                'id' => 10,
                'name' => 'C',
                'price' => 12800,
            ],
            [
                'id' => 11,
                'name' => 'Lua',
                'price' => 5000,
            ],
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
