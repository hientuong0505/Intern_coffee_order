<?php
    require_once (__DIR__ . '\..\lib\session.php');

    require_once (__DIR__ . '\..\lib\database.php');
    require_once (__DIR__ . '\..\helper\format.php');

?>

<?php
class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addCategory($cateName)
    {
        $cateName = $this->fm->validation($cateName);

        $cateName = mysqli_real_escape_string($this->db->link, $cateName);

        if(empty($cateName))
        {
            $alert = "<span class='fs-4'>Error: Hãy nhập tên danh mục</span>";
            return $alert;
        } else {
            $query = "INSERT INTO category(cateName) VALUES('$cateName')";
            $result = $this->db->insert($query);
            if($result)
            {
                $alert = "<span class='fs-4'>*Thêm thành công*</span>";
                return $alert;
            } else {
                $alert = "<span class='fs-4'>Error: Thêm thất bại, hãy kiểm tra!!!</span>";
                return $alert;
            }

        }

    }

    public function showAllCate()
    {
        $query = "SELECT * FROM category ORDER BY cateName desc";
        $result = $this->db->select($query);

        return $result;
    }

    public function getCateById($id)
    {
        $query = "SELECT * FROM category WHERE cate_id = '$id' ";
        $result = $this->db->select($query);

        return $result;
    }

    public function updateCategory($cateName, $id)
    {
        $cateName = $this->fm->validation($cateName);

        $cateName = mysqli_real_escape_string($this->db->link, $cateName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if(empty($cateName))
        {
            $alert = "<span class='fs-4'>Error: Hãy nhập tên danh mục</span>";
            return $alert;
        } else {
            $query = "UPDATE category SET cateName='$cateName' WHERE cate_id='$id' ";
            $result = $this->db->update($query);
            if($result)
            {
                $alert = "<span class='fs-4'>*Sửa thành công*</span>";
                return $alert;
            } else {
                $alert = "<span class='fs-4'>Error: Sửa thất bại, hãy kiểm tra!!!</span>";
                return $alert;
            }

        }
    }

    public function deleteCategory($id)
    {
        $query = "DELETE FROM category WHERE cate_id = '$id'";
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

}

?>