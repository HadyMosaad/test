<?php

namespace app\controllers;

use app\models\Product;
use app\Router;

/**
 * Class ProductController
 *
 * @author  Hady Mosaas <hadymo77@gmail.com>
 * @package app\controllers
 */
class ProductController
{
    public function index(Router $router)
    {
        $keyword = $_GET['search'] ?? '';
        $disks = $router->database->getDisks();
        $books = $router->database->getBooks();
        $furniture = $router->database->getFurniture();
        var_dump($furniture);
        #var_dump($disks);
        $router->renderView('products/index', [
            'disks' => $disks,
            'products' => $furniture,
            'keyword' => $keyword

        ]);
    }

    public function create(Router $router)
    {
        $productData = [
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productData['sku'] = $_POST['sku'];
            $productData['name'] = $_POST['name'];
            $productData['price'] = $_POST['price'];
            $productData['weight'] = $_POST['weight'] ?? null;
            $productData['size'] = $_POST['size'] ?? null;
            $productData['width'] = $_POST['width'] ?? null;
            $productData['length'] = $_POST['length'] ?? null;
            $productData['height'] = $_POST['height'] ?? null;
            $classy = $_POST['switcher'];
            var_dump($classy);
            $class = "\app\models\\$classy";
            $product = new $class();
            $product->load($productData);
            $product->save($classy);
            header('Location: /products');
            exit;
        }
        $router->renderView('products/create', [
            'product' => $productData
        ]);
    }

    public function update(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /products');
            exit;
        }
        $productData = $router->database->getProductById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productData['sku'] = $_POST['sku'];
            $productData['name'] = $_POST['name'];
            $productData['price'] = $_POST['price'];
            $productData['imageFile'] = $_FILES['image'] ?? null;

            $product = new Product();
            $product->load($productData);
            $product->save();
            header('Location: /products');
            exit;
        }

        $router->renderView('products/update', [
            'product' => $productData
        ]);
    }

    public function delete(Router $router)
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /products');
            exit;
        }

        if ($router->database->deleteProduct($id)) {
            header('Location: /products');
            exit;
        }
    }
    public function MassDelete(Router $router)
    {
        $DeleteIds = $_POST['checked'] ?? null;
        if (!$DeleteIds) {
            header('Location: /products');
            exit;
        }
        foreach ($_POST['checked'] as $value) {
            $router->database->deleteProduct($value);
        }
        $router->renderView('products/index', [
            'products' => $products,
            'keyword' => $keyword,
            'ch' => $_POST['checked']
        ]);
        exit;

    }
   
   
}
