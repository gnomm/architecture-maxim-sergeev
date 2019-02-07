<?php

declare(strict_types=1);

namespace Controller;

use function Couchbase\defaultDecoder;
use Framework\Render;
use Service\Order\Order;
use Service\Product\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController
{
    use Render;

    /**
     * Информация о продукте
     *
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function infoAction(Request $request, $id): Response
    {
        $product = new Product();
        if ($request->isMethod(Request::METHOD_POST)) {
            (new Order($request->getSession()))->addProduct((int)$request->request->get('product'));
        }

        $productInfo = $product->getOne((int)$id);

        if ($productInfo === null) {
            return $this->render('error404.html.php');
        }

        $isInBasket = (new Order($request->getSession()))->isProductInBasket($productInfo->getId());

        return $this->render('product/info.html.php', ['productInfo' => $productInfo, 'isInBasket' => $isInBasket]);
    }

    /**
     * Список всех продуктов
     *
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(Request $request): Response
    {

        $productList = (new Product())->getAll($request->query->get('sort', ''));



//        $productList = (new Product())->getAll($request->query->get('sort', ''));


        return $this->render('product/list.html.php', ['productList' => $productList]);
    }
}
