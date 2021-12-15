<?php
    require_once (__DIR__ . '\..\router\index.php');
?>

<?php
class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addToCart($quantity, $id)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sessionId = session_id();

        $query = "SELECT * FROM item WHERE item_id ='$id' ";
        $result = $this->db->select($query)->fetch_assoc();

        $itemName = $result['itemName'];
        $price = $result['price'];
        $size = $result['size'];
        $image = $result['image'];

        $query1 = "INSERT INTO cart(item_id,sessionId,itemName,price,size,quantity,image) 
        VALUES('$id','$sessionId','$itemName', '$price','$size', $quantity, '$image')";
        $result1 = $this->db->insert($query1);
        // var_dump($result);
        // die();
        if ($result1) {
            $alert = "<span class='fs-4'>Thêm Thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='fs-4'>Error: Thêm thất bại, hãy kiểm tra!!!</span>";
            return $alert;
        }
    }

    public function showAllCart()
    {
        $sessionId = session_id();

        $query = "SELECT * FROM cart WHERE sessionId='$sessionId'";
        $result = $this->db->select($query);

        return $result;
    }

    // public function getCateById($id)
    // {
    //     $query = "SELECT * FROM category WHERE cate_id = '$id' ";
    //     $result = $this->db->select($query);

    //     return $result;
    // }

    // public function updateCategory($cateName, $id)
    // {
    //     $cateName = $this->fm->validation($cateName);

    //     $cateName = mysqli_real_escape_string($this->db->link, $cateName);
    //     $id = mysqli_real_escape_string($this->db->link, $id);

    //     if(empty($cateName))
    //     {
    //         $alert = "<span class='fs-4'>Error: Hãy nhập tên danh mục</span>";
    //         return $alert;
    //     } else {
    //         $query = "UPDATE category SET cateName='$cateName' WHERE cate_id='$id' ";
    //         $result = $this->db->update($query);
    //         if($result)
    //         {
    //             $alert = "<span class='fs-4'>*Sửa thành công*</span>";
    //             return $alert;
    //         } else {
    //             $alert = "<span class='fs-4'>Error: Sửa thất bại, hãy kiểm tra!!!</span>";
    //             return $alert;
    //         }

    //     }
    // }

    // public function deleteCategory($id)
    // {
    //     $query = "DELETE FROM category WHERE cate_id = '$id'";
    //     $result = $this->db->delete($query);

    //     if($result)
    //     {
    //         $alert = "<span class='fs-4'>*Xóa thành công*</span>";
    //         return $alert;
    //     } else{
    //         $alert = "<span class='fs-4'>Error:Xóa thất bại, hãy kiểm tra!!!</span>";
    //         return $alert;
    //     }
    // }

}

?>