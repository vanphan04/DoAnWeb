<?php
include '../common/database.php';
$db = new Database();

// Xử lý thêm, sửa, xóa sản phẩm
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['id_type'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $quantity = $_POST['quantity'];
            $id_type = $_POST['id_type'];
            
            if ($price > 0 && $quantity >= 0) {
                $check_query = "SELECT COUNT(*) as total FROM product WHERE name = '$name' AND id_type = '$id_type'";
                $result = $db->query($check_query);
                
                if ($result && $result[0]['total'] > 0) {
                    echo "<script>alert('Sản phẩm này đã tồn tại trong loại sản phẩm này!');</script>";
                } else {
                    $query = "INSERT INTO product (name, price, description, quantity, id_type, image) 
                              VALUES ('$name', '$price', '$description', '$quantity', '$id_type', 'default.jpg')";
                    $db->insert($query);
                    echo "<script>alert('Sản phẩm đã được thêm thành công!');</script>";
                }
            } else {
                echo "<script>alert('Giá và số lượng phải hợp lệ!');</script>";
            }
        }
    } elseif ($action == 'delete' && isset($_POST['id_product'])) {
        $id_product = $_POST['id_product'];
        $query = "DELETE FROM product WHERE id_product='$id_product'";
        $db->delete($query);
        echo "<script>alert('Sản phẩm đã được xóa thành công!');</script>";
    }
}

// Lấy dữ liệu sản phẩm để sửa
$edit_id = isset($_POST['edit_id']) ? $_POST['edit_id'] : null;
$edit_product = null;
if ($edit_id) {
    $edit_product = $db->query("SELECT * FROM product WHERE id_product = $edit_id")[0];
}

// Lấy danh sách sản phẩm và loại sản phẩm
$products = $db->query("SELECT * FROM product");
$types = $db->query("SELECT * FROM pro_type");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
</head>
<body>
    <h1>Quản lý Sản phẩm</h1>
    
    <!-- Form thêm sản phẩm -->
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <label>Tên sản phẩm:</label><input type="text" name="name" required><br>
        <label>Giá:</label><input type="number" name="price" required min="0"><br>
        <label>Số lượng:</label><input type="number" name="quantity" required min="0"><br>
        <label>Mô tả:</label><textarea name="description"></textarea><br>
        <label>Loại sản phẩm:</label>
        <select name="id_type" required>
            <?php foreach ($types as $type) : ?>
                <option value="<?= $type['id_type'] ?>"><?= $type['name'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit">Thêm sản phẩm</button>
    </form>

    <h2>Danh sách Sản phẩm</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Mô tả</th>
            <th>Loại</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= $product['id_product'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                <td><?= $product['quantity'] ?></td>
                <td><?= $product['description'] ?></td>
                <td>
                    <?php
                        $type_name = "";
                        foreach ($types as $type) {
                            if ($product['id_type'] == $type['id_type']) {
                                $type_name = $type['name'];
                            }
                        }
                    ?>
                    <?= $type_name ?>
                </td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="edit_id" value="<?= $product['id_product'] ?>">
                        <button type="submit">Sửa</button>
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id_product" value="<?= $product['id_product'] ?>">
                        <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
