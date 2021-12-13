<?php
    include (__DIR__ . '\..\lib\session.php');

    Session::checkLogin();
    // include '../lib/database.php';
    // include '../helper/format.php';
    include (__DIR__ . '\..\lib\database.php');
    include (__DIR__ . '\..\helper\format.php');
    // include('router/index.php');
    // Session::checkLogin();
?>

<?php
class AdminLogin
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function loginAdmin($username, $password)
    {
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if(empty($username) || empty($password))
        {
            $alert = "Username or password must be provided";
            return $alert;
        } else {
            $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND role_id='1' LIMIT 1";
            $result = $this->db->select($query);

            if($result != false)
            {
                $value = $result->fetch_assoc();

                Session::set('adminlogin', true);

                Session::set('user_id', $value['user_id']);
                Session::set('name', $value['name']);
                Session::set('username', $value['username']);
                header('Location:index.php');
            } else {
                $alert = "Username or password do not match";
                return $alert;
            }
        }

    }
}

?>