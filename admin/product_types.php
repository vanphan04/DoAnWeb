<?php
include '../common/database.php';
$db = new Database();

// Xử lý thêm, sửa, xóa loại sản phẩm
if (isset($_POST['action_type'])) {
    $action_type = $_POST['action_type'];
    
    if ($action_type == 'add' && isset($_POST['type_name'])) {
        $type_name = $_POST['type_name'];
        
        $check_query = "SELECT COUNT(*) as total FROM pro_type WHERE name = '$type_name'";
        $result = $db->query($check_query);
        
        if ($result && $result[0]['total'] > 0) {
            echo "<script>alert('Loại sản phẩm này đã tồn tại!');</script>";
        } else {
            $query = "INSERT INTO pro_type (name) VALUES ('$type_name')";
            $db->insert($query);
        }
    } elseif ($action_type == 'edit' && isset($_POST['type_name']) && isset($_POST['id_type'])) {
        $id_type = $_POST['id_type'];
        $type_name = $_POST['type_name'];
        $query = "UPDATE pro_type SET name='$type_name' WHERE id_type='$id_type'";
        $db->update($query);
        echo "<script>alert('Cập nhật thành công!');</script>";
    } elseif ($action_type == 'delete' && isset($_POST['id_type'])) {
        $id_type = $_POST['id_type'];
        $check_query = "SELECT COUNT(*) as total FROM product WHERE id_type='$id_type'";
        $result = $db->query($check_query);
        
        if ($result && isset($result[0]['total']) && $result[0]['total'] > 0) {
            echo "<script>alert('Không thể xóa. Loại sản phẩm vẫn tồn tại sản phẩm!');</script>";
        } else {
            $query = "DELETE FROM pro_type WHERE id_type='$id_type'";
            $db->delete($query);
        }
    }
}

// Khởi tạo biến edit_type và types
$edit_type = null;
if (isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $edit_type = $db->query("SELECT * FROM pro_type WHERE id_type = $edit_id")[0] ?? null;
}

$types = $db->query("SELECT * FROM pro_type") ?? [];  // Nếu không có dữ liệu, trả về mảng rỗng
?>
<h1>Quản lý Loại Sản phẩm</h1>
<form method="POST">
    <input type="hidden" name="action_type" value="<?= $edit_type ? 'edit' : 'add' ?>">
    <?php if ($edit_type): ?>
        <input type="hidden" name="id_type" value="<?= $edit_type['id_type'] ?>">
        <label>Tên loại:</label><input type="text" name="type_name" value="<?= $edit_type['name'] ?>" required><br>
        <button type="submit">Cập nhật</button>
    <?php else: ?>
        <label>Tên loại:</label><input type="text" name="type_name" required><br>
        <button type="submit">Thêm loại</button>
    <?php endif; ?>
</form>

<h2>Danh sách Loại Sản phẩm</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach ($types as $type) : ?>
        <tr>
            <td><?= $type['id_type'] ?></td>
            <td><?= $type['name'] ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="edit_id" value="<?= $type['id_type'] ?>">
                    <button type="submit">Sửa</button>
                </form>
                <form method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                    <input type="hidden" name="action_type" value="delete">
                    <input type="hidden" name="id_type" value="<?= $type['id_type'] ?>">
                    <button type="submit">Xóa</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
function confirmDelete() {
    return confirm("Bạn có chắc chắn muốn xóa loại sản phẩm này?");
}
</script>
