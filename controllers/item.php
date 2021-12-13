<?php
// include (__DIR__ . '\..\lib\session.php');

// include (__DIR__ . '\..\lib\database.php');
// include (__DIR__ . '\..\helper\format.php');

require_once(__DIR__ . '\..\router\index.php');

?>

<?php
class Item
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addItem($data, $files)
    {

        $itemName = mysqli_real_escape_string($this->db->link, $data['itemName']);
        $size = mysqli_real_escape_string($this->db->link, $data['size']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $cate_id = mysqli_real_escape_string($this->db->link, $data['cate_id']);

        //Kiem tra hinh anh va lay hinh anh cho vao Folder UPLOADS
        $permited = array('jpg', 'png', 'jpeg');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($itemName == "" || $size == "" || $price == "" || $cate_id == "" || $file_name == "") {
            $alert = "<span class='fs-4'>Error:Các trường không được để trống!!</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);

            $query = "INSERT INTO item(itemName,size,price,image,cate_id) VALUES('$itemName','$size','$price','$unique_image','$cate_id')";
            $result = $this->db->insert($query);
            // var_dump($result);
            // die();
            if ($result) {
                $alert = "<span class='fs-4'>*Thêm thành công*</span>";
                return $alert;
            } else {
                $alert = "<span class='fs-4'>Error: Thêm thất bại, hãy kiểm tra!!!</span>";
                return $alert;
            }
        }
    }

    public function showAllItem()
    {
        $query = "SELECT item.*, category.cateName 
                FROM item INNER JOIN category
                ON item.cate_id = category.cate_id
                ORDER BY item.item_id desc";

        $result = $this->db->select($query);

        return $result;
    }

    public function getItemById($id)
    {
        $query = "SELECT * FROM `item` WHERE item_id = '$id' ";
        $result = $this->db->select($query);

        return $result;
    }

    public function updateItem($data, $files, $id)
    {

        $itemName = mysqli_real_escape_string($this->db->link, $data['itemName']);
        $size = mysqli_real_escape_string($this->db->link, $data['size']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $cate_id = mysqli_real_escape_string($this->db->link, $data['cate_id']);

        //Kiem tra hinh anh va lay hinh anh cho vao Folder UPLOADS
        $permited = array('jpg', 'png', 'jpeg');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($itemName == "" || $size == "" || $price == "" || $cate_id == "") {
            $alert = "<span class='fs-4'>Error:Các trường không được để trống!!</span>";
            return $alert;
        } else {
            if (!empty($file_name))
            {
                // Nếu người dùng chọn ảnh
                // if ($file_size > 2048) 
                // {
                //     $alert = "<span class='error'> Ảnh nên nhỏ hơn 2Mb!</span>";

                //     return $alert;
                // } 
                if (in_array($file_ext, $permited) === false) 
                {
                    $alert = "<span class='error'>Bạn chỉ có thể upload:-" . implode(',', $permited) . "</span>";

                    return $alert;
                }
                    move_uploaded_file($file_temp, $uploaded_image);
                    
                    $query = "UPDATE `item` SET 
                    itemName='$itemName',
                    size='$size',
                    price='$price',
                    image='$unique_image',
                    cate_id='$cate_id'
                    WHERE item_id='$id' ";
            } 
            else 
            {
                // Nếu người dùng không chọn ảnh mới
                $query = "UPDATE `item` SET 
                itemName='$itemName',
                size='$size',
                price='$price',
                cate_id='$cate_id'
                WHERE item_id='$id' ";
            }

            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='fs-4'>*Sửa thành công*</span>";
                return $alert;
            } else {
                $alert = "<span class='fs-4'>Error: Sửa thất bại, hãy kiểm tra!!!</span>";
                return $alert;
            }
        }
    }
    public function deleteItem($id)
    {
        $query = "DELETE FROM `item` WHERE item_id = '$id'";
        $result = $this->db->delete($query);

        if($result)
        {
            $alert = "<span class='fs-4'>*Xóa thành công*</span>";
            return $alert;
        } else{
            $alert = "<span class='fs-4'>Error:Xóa thất bại, hãy kiểm tra!!!</span>";
            return $alert;
        }
    }

    //-----------------------------------//
    public function get_all_item()
    {
        $query = "SELECT * FROM `item`";
        $result = $this->db->select($query);

        return $result;
    }

}

?>