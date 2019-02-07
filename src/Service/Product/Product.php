<?php

declare(strict_types=1);

namespace Service\Product;

use Model;

class Product
{
    /**
     * Получаем конкретный продукт
     *
     * @param int $id
     * @return Model\Entity\Product|null
     */
    public function getOne(int $id): ?Model\Entity\Product
    {
        $product = $this->getProductRepository()->search([$id]);
        return count($product) ? $product[0] : null;
    }

    /**
     * Получаем коллекцию продуктов
     *
     * @param int[] $ids
     * @return Model\Entity\Product[]
     */
    public function getCollection(array $ids): array
    {
        return $this->getProductRepository()->search($ids);
    }

    /**
     * Получаем все продукты
     *
     * @param string $sortType
     *
     * @return Model\Entity\Product[]
     */
    public function getAll(string $sortType): array
    {
        $productList = $this->getProductRepository()->fetchAll();

//        var_dump($productList);

//        var_dump($productList);
        switch ($sortType) {
            case 'price':
                $strategy = new Sorter(new SorterByPrice());
                break;

            case 'name':
//                new Sorter(new SorterByName());
                $strategy = new Sorter(new SorterByName());
                break;

            default:
                $strategy = new Sorter(new SorterByName());
        }

        return $strategy->sort($productList);
//        return $productSorter->sort($productList);
    }


//    /**
//     * Получаем все продукты
//     *
//     * @param string $sortType
//     *
//     * @return Model\Entity\Product[]
//     */
//    public function getAll(string $sortType): array
//    {
////        echo 'ssss';exit;
//        $productList = $this->getProductRepository()->fetchAll();
//        // Применить паттерн Стратегия
//        // $sortType === 'price'; // Сортировка по цене
//        // $sortType === 'name'; // Сортировка по имени
//        return $productList;
//    }


    /**
     * Фабричный метод для репозитория Product
     *
     * @return Model\Repository\Product
     */
    protected function getProductRepository(): Model\Repository\Product
    {
        return new Model\Repository\Product();
    }
}