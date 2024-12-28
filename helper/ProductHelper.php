<?php
include '../common/database.php';

class ProductHelper
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function Products()
    {
        $products = $this->db->query('SELECT p.id_product,p.name,p.price,p.image,pt.name AS ptName FROM `product` p
            JOIN `pro_type` pt ON p.id_type = pt.id_type');

        return $products;
    }

    public function findById($id)
    {
        $product = $this->db->query('SELECT * FROM `product` WHERE `id_product`=' . $id);

        return $product[0];
    }
}
