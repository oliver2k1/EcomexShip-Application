<?php
require_once("database-connect.php");
function getListService($offset, $per_page)
{
    $conn = ConnectDB();
    if($conn==NULL)
        return NULL;
    $sql = "SELECT * FROM service LIMIT $offset, $per_page;";
    $pdo_stm = $conn->prepare($sql);//tạo đối tượng PDOStatement
    $ketqua = $pdo_stm->execute();//thực thi câu sql
    if($ketqua==FALSE){
        $alert = "Không có dịch vụ";
        return $alert;
    }
    else
    {
        $rows = $pdo_stm->fetchAll(PDO::FETCH_BOTH);
        return $rows;//Trả về mảng các dòng dữ liệu
    } 
}
function getNameService()
{
    $conn = ConnectDB();
    if($conn==NULL)
        return NULL;
    $sql = "SELECT DISTINCT name FROM service";
    $pdo_stm = $conn->prepare($sql);//tạo đối tượng PDOStatement
    $ketqua = $pdo_stm->execute();//thực thi câu sql
    if($ketqua==FALSE){
        $alert = "Không có dịch vụ";
        return $alert;
    }
    else
    {
        $rows = $pdo_stm->fetchAll(PDO::FETCH_BOTH);
        return $rows;//Trả về mảng các dòng dữ liệu
    } 
}
//Hàm thêm dịch vụ
function addService($name,$start,$end,$price)
{
    $conn = ConnectDB();
    if($conn==NULL)
        return NULL;
    $sql = "INSERT INTO service(name,weight_from,weight_to,price) VALUES(?,?,?,?)";
    $pdo_stm = $conn->prepare($sql);//tạo đối tượng PDOStatement
    $data = [$name,$start,$end,$price];//tạo mảng chứa các dữ liệu cần bindParam
    $ketqua = $pdo_stm->execute($data);//thực thi câu sql với mảng dữ liệu
    return $ketqua;//TRUE/FALSE
}
    function updateService($name,$start,$end,$price,$id)
    {
        $conn = ConnectDB();
        if($conn==NULL)
            return NULL;
        $sql = "UPDATE service SET name=?,weight_from=?,weight_to=?,price=? WHERE `id` =?";
        $pdo_stm = $conn->prepare($sql);//tạo đối tượng PDOStatement
        $data = [$name,$start,$end,$price,$id];//tạo mảng chứa các dữ liệu cần bindParam
        $ketqua = $pdo_stm->execute($data);//thực thi câu sql với mảng dữ liệu
        return $ketqua;//TRUE/FALSE
    }
//hàm tìm dịch vụ theo id và trả về bản ghi dạng mảng
function getService($id)
{
    $conn = ConnectDB();
    if($conn==NULL)
        return NULL;
    $sql = "SELECT * FROM `service` WHERE id=?";
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
function deleteService($id)
{
    $conn = ConnectDB();
    if($conn==NULL)
        return NULL;
    $sql = "DELETE FROM `service` WHERE id=?";
    $pdo_stm = $conn->prepare($sql);//tạo đối tượng PDOStatement
    //$pdo_stm->bindParam(1,$id);
    $data =[$id];
    $ketqua = $pdo_stm->execute($data);//thực thi câu sql
    return $ketqua;//TRUE/FALSE
}

    function getService_now($idOrder)
    {
        $conn = ConnectDB();
        if($conn==NULL)
            return NULL;
        $sql = "SELECT * FROM `oder` WHERE idOrder=?";
        $pdo_stm = $conn->prepare($sql);//tạo đối tượng PDOStatement
        $ketqua = $pdo_stm->execute([$idOrder]);//thực thi câu sql
        if($ketqua==FALSE){
            return NULL;
        }
        else
        {
            $rows = $pdo_stm->fetch(PDO::FETCH_BOTH);
            return $rows;//Trả về mảng chứa dữ liệu
        } 
    }
    function get_prices($idService, $idOrder){
        $conn = ConnectDB();
        if($conn==NULL)
            return NULL;
        $sql = "SELECT s.*
                FROM service s
                JOIN `oder` o ON s.name = o.service
                WHERE s.name = ? AND o.idOrder = ?";
        $pdo_stm  = $conn->prepare($sql);
        $ketqua = $pdo_stm->execute([$idService, $idOrder]);//thực thi câu sql
        if($ketqua==FALSE){
            return NULL;
        }
        else
        {
            $rows = $pdo_stm->fetch(PDO::FETCH_BOTH);   
            return $rows;  
    }
}
?>