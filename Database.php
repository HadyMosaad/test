<?php
/**
 * User: TheCodeholic
 * Date: 10/11/2020
 * Time: 10:33 AM
 */

namespace app;

use app\models\Book;
use app\models\Disk;
use app\models\Furniture;
use app\models\Product;
use PDO;

/**
 * Class Database
 *
 * @author  Hady Mosaas <hadymo77@gmail.com>
 * @package app
 */
class Database
{
    public ?PDO $pdo = null;
    public static ?Database $db = null;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    }

    public function getProducts($keyword = '')
    {
        if ($keyword) {
            $statement = $this->pdo->prepare('SELECT * FROM products WHERE sku like :keyword' );
            $statement->bindValue(":keyword", "%$keyword%");
        } else {
            $statement = $this->pdo->prepare('SELECT * FROM products ');
        }
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
public function getBooks()
{

    $statement = $this->pdo->prepare('SELECT products.id ,sku,name ,price , weight FROM products right join book on products.id = book.pro_id ');
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
public function getDisks()
    {

        $statement = $this->pdo->prepare('SELECT products.id ,sku,size ,price ,name  FROM products right join disk on products.id = disk.pro_id ');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getFurniture()
    {

        $statement = $this->pdo->prepare('SELECT products.id ,sku,name ,price , length , width ,height FROM products right join furniture on products.id = furniture.pro_id ');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteProduct($id): bool
    {
        $statement = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
        $statement->bindValue(':id', $id);

        return $statement->execute();
    }

    public function updateProduct(Product $product)
    {
        $statement = $this->pdo->prepare('UPDATE products SET sku = :sku, 
                                        name = :name, 
                                        price = :price WHERE id = :id');
        $statement->bindValue(':sku', $product->sku);
        $statement->bindValue(':name', $product->name);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':id', $product->id);

        $statement->execute();
    }

    public function createProduct(Product $product ): ?int
    {
        $statement = $this->pdo->prepare('INSERT INTO products SET sku = :sku, 
                                        name = :name, 
                                        price = :price ');
        $statement->bindValue(':sku', $product->sku);
        $statement->bindValue(':name', $product->name);
        $statement->bindValue(':price', $product->price);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }
    public function createBook(Book $product )
    {
        $P_id = $this->createProduct($product);
        $statement = $this->pdo->prepare("INSERT INTO book (weight , id , pro_id)
                VALUES (:weight , :id , :pro_id) ");
        $statement->bindValue(':weight', $product->weight);
        $statement->bindValue(':id', $product->id);
        $statement->bindValue(':pro_id', $P_id );
        $statement->execute();
    }
    public function createDisk(Disk $product )
    {
        $P_id = $this->createProduct($product);
        $statement = $this->pdo->prepare("INSERT INTO Disk (size , id , pro_id)
                VALUES (:size , :id , :pro_id) ");
        $statement->bindValue(':size', $product->size);
        $statement->bindValue(':id', $product->id);
        $statement->bindValue(':pro_id', $P_id );
        $statement->execute();
    }
    public function createFurniture(Furniture $product )
    {
        $P_id = $this->createProduct($product);
        $statement = $this->pdo->prepare("INSERT INTO furniture (height , length , width , id , pro_id)
                VALUES (:height,:length ,:width , :id , :pro_id) ");
        $statement->bindValue(':height', $product->height);
        $statement->bindValue(':length', $product->length);
        $statement->bindValue(':width', $product->width);
        $statement->bindValue(':id', $product->id);
        $statement->bindValue(':pro_id', $P_id );
        $statement->execute();
    }
}