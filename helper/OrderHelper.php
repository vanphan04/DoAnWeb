<?php
require_once dirname(__DIR__) . '/common/database.php';
class OrderHelper
{
    private $db;
    public $tongtien;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function checkout($request)
    {
        $queryMaxId = "SELECT MAX(id_cart) as maxId from `cart`";
        $maxId = $this->db->findById($queryMaxId);
        $currentId = 1;
        var_dump($maxId);

        if ($maxId) {
            $currentId = ((int)$maxId['maxId']) + 1;
        }

        $arrQueryCTHD = [];

        if ($request['product']) {
            $totalPrice = 0;
            for ($i = 0; $i < count($request['product']); $i++) {
                $data = json_decode($request['product'][$i], true);
                array_push($arrQueryCTHD, "INSERT INTO `cart_detail` (`card_id`, `quantity`, `price`,`product_id`) 
                VALUES (" . $currentId . ", " . $data['quantity'] . ", " . $data['product']['price'] . "," . (int)$data['product']['id_product'] . ")");
                $totalPrice += (int)$data['quantity'] * (int)$data['product']['price'];
            }
            $queryDH = "INSERT INTO `cart` (`id_cart`, `total_price`) 
                VALUES (" . $currentId . ", " . $totalPrice . ")";

            $this->db->insert($queryDH);
            for ($i = 0; $i < count($arrQueryCTHD); $i++) {
                $this->db->insert($arrQueryCTHD[$i]);
            }
        }
    }
}
