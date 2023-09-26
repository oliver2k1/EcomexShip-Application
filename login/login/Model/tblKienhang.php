<?php
require_once("database-connect.php");
function getListKienhang($offset, $per_page)
{
    $conn = ConnectDB();
    if($conn==NULL)
        return NULL;
    $sql = "SELECT * FROM `kienhang` LIMIT $offset, $per_page;";
    $pdo_stm = $conn->prepare($sql);//tạo đối tượng PDOStatement
    $ketqua = $pdo_stm->execute();//thực thi câu sql
    if($ketqua==FALSE){
        $alert = "Không có kiện hàng";
        return $alert;
    }
    else
    {
        $rows = $pdo_stm->fetchAll(PDO::FETCH_BOTH);
        return $rows;//Trả về mảng các dòng dữ liệu
    } 
}
function getNameKienhang()
{
    $conn = ConnectDB();
    if($conn==NULL)
        return NULL;
    $sql = "SELECT DISTINCT `name` FROM kienhang";
    $pdo_stm = $conn->prepare($sql);//tạo đối tượng PDOStatement
    $ketqua = $pdo_stm->execute();//thực thi câu sql
    if($ketqua==FALSE){
        $alert = "Không có kiện hàng";
        return $alert;
    }
    else
    {
        $rows = $pdo_stm->fetchAll(PDO::FETCH_BOTH);
        return $rows;//Trả về mảng các dòng dữ liệu
    } 
}
//Hàm thêm dịch vụ
function addKienhang($name)
{
    $conn = ConnectDB();
    if ($conn == NULL)
        return NULL;
    $sql = "INSERT INTO kienhang(`name`) VALUES(?)";
    $pdo_stm = $conn->prepare($sql); // Tạo đối tượng PDOStatement
    $ketqua = $pdo_stm->execute([$name]); // Thực thi câu sql với mảng dữ liệu
    return $ketqua; // TRUE/FALSE
}
    function updateKienhang($name,$id)
    {
        $conn = ConnectDB();
        if($conn==NULL)
            return NULL;
        $sql = "UPDATE kienhang SET name=? WHERE `id` =?";
        $pdo_stm = $conn->prepare($sql);//tạo đối tượng PDOStatement
        $data = [$name,$id];//tạo mảng chứa các dữ liệu cần bindParam
        $ketqua = $pdo_stm->execute($data);//thực thi câu sql với mảng dữ liệu
        return $ketqua;//TRUE/FALSE
    }
//hàm tìm dịch vụ theo id và trả về bản ghi dạng mảng
function getKienhang($id)
{
    $conn = ConnectDB();
    if($conn==NULL)
        return NULL;
    $sql = "SELECT * FROM `kienhang` WHERE id=?";
    $pdo_stm = $conn->prepare($sql);//tạo đối tượng PDOStatement
    //$pdo_stm->bindParam(1,$id);
    $data =[$id];
    $ketqua = $pdo_stm->execute($data);//thực thi câu sql
    if($ketqua==FALSE){
        return $data;
    }
    else
    {
        $row = $pdo_stm->fetch(PDO::FETCH_BOTH);
        return $row;//Trả về mảng chứa dữ liệu
    } 
}
//Hàm Sửa thông tin dịch vụ

//Hàm xóa dịch vụ
function deleteKienhang($id)
{
    $conn = ConnectDB();
    if($conn==NULL)
        return NULL;
    $sql = "DELETE FROM `kienhang` WHERE id=?";
    $pdo_stm = $conn->prepare($sql);//tạo đối tượng PDOStatement
    //$pdo_stm->bindParam(1,$id);
    $data =[$id];
    $ketqua = $pdo_stm->execute($data);//thực thi câu sql
    return $ketqua;//TRUE/FALSE
}

?>