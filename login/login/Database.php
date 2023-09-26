<?php
//hàm kết nối CSDL và trả về biến $conn là đối tượng PDO
function ConnectDB()
{
    $conn = NULL;
    try{
        //new PDO("url","user","password");
        $conn = new PDO("mysql:host=localhost;dbname=eco33771_ecomex","eco33771_ecomex","Ecomex@123");
        $conn->query("SET NAMES UTF8");//thiết lập chế độ unicode
    }catch(PDOException $ex)
    {
        echo "<p>" . $ex->getMessage() . "</p>";
        die('<h3>LỖI KÊT NỐI CSDL</h3>');
    }
    return $conn;
}
//hàm CheckLogin tìm kiếm user,password trong bảng tbUser
//trả về FALSE nếu lỗi truy vấn, trả về NULL nếu không có dữ liệu
//trả về mảng chứa bản ghi truy vấn được của user nếu thành công
function CheckLogin($username,$password)
{
    $conn = ConnectDB();
    //$sql = "SELECT * FROM tbUser WHERE username=? AND password=?";
    $sql = "SELECT * FROM user WHERE username=? AND password=?";
    //tạo đối tượng PDOStatement  để thực hiện sql
    $pdo_stm = $conn->prepare($sql);
    $data = [$username,$password];
    $ketqua = $pdo_stm->execute($data);//thực thiện lệnh sql ở dòng trên và trả về TRUE/FALSE
    if($ketqua==TRUE)
    {
        $n = $pdo_stm->rowCount();
        if($n>0)//Nếu có dữ liệu
            return $pdo_stm->fetch();//trả về mảng chứa record truy vấn được
        else    
            return NULL;
    }
    else {//LỖI TRUY VẤN CSDL
        return FALSE;
    }
}
?>