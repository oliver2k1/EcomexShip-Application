<?php require_once 'database.php'; ?>
<?php require_once 'format.php';?>
<?php
    class order{
        private $db;
        private $fm;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_order_admin($data){
            $idOrder = mysqli_real_escape_string($this->db->link, $data['idOrder']);    
            $nameUser = mysqli_escape_string($this->db->link, $data['name_user']);
            $time = mysqli_escape_string($this->db->link, $data['time']);
            $nameCreater = mysqli_escape_string($this->db->link, $data['nameCreater']);
            $nameReceiver = mysqli_escape_string($this->db->link, $data['nameReceiver']);
            $addressReceiver = mysqli_escape_string($this->db->link, $data['addressReceiver']);
            $phoneReceiver = mysqli_escape_string($this->db->link, $data['phoneReceiver']);
            $country = mysqli_escape_string($this->db->link, $data['country']);
            $state = mysqli_escape_string($this->db->link, $data['state']);
            $city = mysqli_escape_string($this->db->link, $data['city']);
            $zipcode = mysqli_escape_string($this->db->link, $data['result']);
            $nameProduct = mysqli_escape_string($this->db->link, $data['product']);
            $quantity = mysqli_escape_string($this->db->link, $data['quantity']);
            $service = mysqli_escape_string($this->db->link, $data['service']);
            $length = mysqli_escape_string($this->db->link, $data['length']);
            $height = mysqli_escape_string($this->db->link, $data['height']);;
            $width = mysqli_escape_string($this->db->link, $data['width']);
            $weight = mysqli_escape_string($this->db->link, $data['weight']);
            $dim = mysqli_escape_string($this->db->link, $data['dim']);
            if(empty($nameReceiver)||empty($addressReceiver)){
                $alert = '<div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle-fill"></i> Bạn chưa nhập thông tin người nhận
                <span id="countdown" class="float-end"></span>
              </div>';
                return $alert;
            }else{
                $query = "INSERT INTO oder(`idOrder`,`name_user`, `time`, `name_creater`, `name_consignee`,`address_consignee`, `phone_consignee`, `country`, `state`, `city`, `zipcode`,`name_product`, `quantity`,`service`,`length`,`width`,`height`,`weight`,`status`,`dim`,`trangthai`)
                VALUES ('$idOrder','$nameUser','$time','$nameCreater','$nameReceiver','$addressReceiver','$phoneReceiver','$country','$state','$city','$zipcode','$nameProduct','$quantity','$service',$length,$width,$height,$weight,1,$dim,0)";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert= ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Tạo đơn hàng thành công!.
                    <span id="countdown" class="float-end"></span>
                    </div> ';
                    return $alert;
                }else{
                    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Đã xảy ra lỗi khi tạo đơn hàng. Vui lòng thử lại sau.
                      <span id="countdown" class="float-end"></span>
                    </div>';
                    return $alert;
                }
            }
    }

            public function detail_order($idOrder){   
                $query = "SELECT * FROM `oder` where `idOrder` = '$idOrder'";
                $result = $this->db->select($query);
                return $result;
            }
            public function send_order($idOrders){
                $successCount = 0;
                $errorCount = 0;
              
                foreach ($idOrders as $idOrder) {
                  $query = "UPDATE `oder` SET `status` = 1 WHERE `idOrder` = '$idOrder'";
                  $result = $this->db->update($query);
                  if ($result) {
                    $successCount++;
                  } else {
                    $errorCount++;
                  }
                }
                if ($successCount > 0) {
                  $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Gửi đơn hàng thành công!.
                    <span id="countdown" class="float-end"></span>
                  </div>';
                } else {
                  $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Đã xảy ra lỗi khi gửi đơn hàng. Vui lòng thử lại sau.
                    <span id="countdown" class="float-end"></span>
                  </div>';
                }
              
                return $alert;
              }
        
            public function show_order_customer($offset,$per_page,$name_user){
                $query = "SELECT * FROM oder Where name_user = '$name_user' and `status` = 1 order by `time` DESC LIMIT $offset,$per_page";
                $result = $this->db->select($query);
                return $result;
        }

            public function update_order($data){ 
                $idOrder = mysqli_escape_string($this->db->link, $data['product_id']);
                $nameReceiver = mysqli_escape_string($this->db->link, $data['nameReceiver']);
                $addressReceiver = mysqli_escape_string($this->db->link, $data['addressReceiver']);
                $phoneReceiver = mysqli_escape_string($this->db->link, $data['phoneReceiver']);
                $country = mysqli_escape_string($this->db->link, $data['country']);
                $state = mysqli_escape_string($this->db->link, $data['state']);
                $city = mysqli_escape_string($this->db->link, $data['city']);
                $zipcode = mysqli_escape_string($this->db->link, $data['zipcode']);
                $nameProduct = mysqli_escape_string($this->db->link, $data['product']);
                $quantity = mysqli_escape_string($this->db->link, $data['quantity']);
                $service = mysqli_escape_string($this->db->link, $data['service']);
                $nameCreater = mysqli_escape_string($this->db->link, $data['name_creater']);
                if(empty($nameReceiver)||empty($addressReceiver)){
                    $alert = '<div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle-fill"></i> Bạn chưa nhập thông tin người nhận! Vui lòng kiểm tra lại
                    <span id="countdown" class="float-end"></span>
                  </div>
                    <script>
                        setTimeout(function(){
                            history.go(-2);
                        }, 2000);
                    </script>';
                    return $alert;
                }else{
                    $query = "UPDATE oder SET `name_consignee`= '$nameReceiver', `address_consignee`='$addressReceiver', `phone_consignee`='$phoneReceiver', `country`='$country', `state`='$state', `city`='$city',
                    `zipcode`='$zipcode',`name_product`='$nameProduct', `quantity`='$quantity',`service`='$service',`name_creater`='$nameCreater' WHERE `idOrder` = '$idOrder'";
                    $result = $this->db->update($query);
                    if($result){
                        $alert=  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Cập nhật đơn hàng thành công!.
                        <span id="countdown" class="float-end"></span>
                        </div>
                        <script>
                            setTimeout(function(){
                                history.go(-2);
                            }, 2000);
                        </script>';
                        return $alert;
                    }else{
                        $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Đã xảy ra lỗi khi sửa đơn hàng. Vui lòng thử lại sau.
                        <span id="countdown" class="float-end"></span>
                      </div>
                        <script>
                            setTimeout(function(){
                                history.go(-2);
                            }, 2000);
                        </script>';
                        return $alert;
                    }
            }
        }
            public function update_order_admin($data){ 
                $idOrder = mysqli_escape_string($this->db->link, $data['product_id']);
                $nameReceiver = mysqli_escape_string($this->db->link, $data['nameReceiver']);
                $name_user = mysqli_escape_string($this->db->link, $data['name_user']);
                $addressReceiver = mysqli_escape_string($this->db->link, $data['addressReceiver']);
                $phoneReceiver = mysqli_escape_string($this->db->link, $data['phoneReceiver']);
                $country = mysqli_escape_string($this->db->link, $data['country']);
                $state = mysqli_escape_string($this->db->link, $data['state']);
                $city = mysqli_escape_string($this->db->link, $data['city']);
                $zipcode = mysqli_escape_string($this->db->link, $data['zipcode']);
                $nameProduct = mysqli_escape_string($this->db->link, $data['product']);
                $quantity = mysqli_escape_string($this->db->link, $data['quantity']);
                $service = mysqli_escape_string($this->db->link, $data['service']);
                $kienhang = mysqli_escape_string($this->db->link, $data['kienhang']);
                $length = mysqli_escape_string($this->db->link, $data['length']);
                $height = mysqli_escape_string($this->db->link, $data['height']);;
                $width = mysqli_escape_string($this->db->link, $data['width']);
                $weight = mysqli_escape_string($this->db->link, $data['weight']);
                $dim = mysqli_escape_string($this->db->link, $data['dim']);
                $disscount = mysqli_escape_string($this->db->link, $data['disscount']);
                $fee = mysqli_escape_string($this->db->link, $data['fee']);
                $price = mysqli_escape_string($this->db->link, $data['price']);
                $payment = mysqli_escape_string($this->db->link, $data['payment']);
                $delivery_time = mysqli_escape_string($this->db->link, $data['delivery_time']);
                $ship_time = mysqli_escape_string($this->db->link, $data['ship_time']);
                $time_dukien = mysqli_escape_string($this->db->link, $data['time_dukien']);
                $status = mysqli_escape_string($this->db->link, $data['trangthai']);
                $trackingNumber = mysqli_escape_string($this->db->link, $data['tracking_number']);
                $query = "UPDATE oder SET `name_consignee`= '$nameReceiver',`name_user`='$name_user', `address_consignee`='$addressReceiver', `phone_consignee`='$phoneReceiver', `country`='$country', `state`='$state', `city`='$city',`dim`='$dim',`fee`='$fee',`tracking_number`='$trackingNumber',`time_dukien`='$time_dukien',`disscount` = '$disscount',
                `zipcode`='$zipcode',`name_product`='$nameProduct',`ship_time`='$ship_time', `quantity`='$quantity',`service`='$service',`delivery_time`='$delivery_time',`trangthai`=$status,`length`='$length',`width`='$width',`height`='$height',`weight`='$weight',`price`='$price',`payment` = '$payment',`kienhang` = '$kienhang' WHERE `idOrder` = '$idOrder'";
                $result = $this->db->update($query);
                if($result){
                    $alert=  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Cập nhật đơn hàng thành công!.
                    <span id="countdown" class="float-end"></span>
                    </div>
                    <script>
                        setTimeout(function(){
                            history.go(-2);
                        }, 2000);
                    </script>';
                    return $alert;
                }else{
                    $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Đã xảy ra lỗi khi sửa đơn hàng. Vui lòng thử lại sau.
                    <span id="countdown" class="float-end"></span>
                    </div>
                    <script>
                        setTimeout(function(){
                            history.go(-2);
                        }, 2000);
                    </script>';
                    return $alert;
                }
        }
                    public function update_order_support($data){ 
                $idOrder = mysqli_escape_string($this->db->link, $data['product_id']);
                $trackingNumber = mysqli_escape_string($this->db->link, $data['tracking_number']);
                $query = "UPDATE oder SET `tracking_number` = '$trackingNumber' WHERE `idOrder` = '$idOrder'";
                $result = $this->db->update($query);
                if($result){
                    $alert=  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Cập nhật đơn hàng thành công!.
                    <span id="countdown" class="float-end"></span>
                    </div>
                    <script>
                        setTimeout(function(){
                            history.go(-2);
                        }, 2000);
                    </script>';
                    return $alert;
                }else{
                    $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Đã xảy ra lỗi khi sửa đơn hàng. Vui lòng thử lại sau.
                    <span id="countdown" class="float-end"></span>
                    </div>
                    <script>
                        setTimeout(function(){
                            history.go(-2);
                        }, 2000);
                    </script>';
                    return $alert;
                }
        }
            public function delete_order($idOrder){
                $query = "DELETE  FROM oder Where idOrder = '$idOrder'";
                $result = $this->db->delete($query);
                if($result){
                    $alert=  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Xóa đơn hàng thành công!.
                    <span id="countdown" class="float-end"></span>
                    </div>';
                    return $alert;
                }else{
                    $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Đã xảy ra lỗi khi xóa đơn hàng. Vui lòng thử lại sau.
                    <span id="countdown" class="float-end"></span>
                    </div>';
                    return $alert;
                }
            }
            public function load_status() {
                $query2 = "SELECT * FROM oder WHERE (`trangthai` = 1 OR `trangthai` = 5 OR `trangthai` = 7 OR `trangthai` = 8) AND `status`= 1";
                $result2 = $this->db->select($query2);
            
                // Duyệt qua từng đơn hàng
                while ($row = mysqli_fetch_assoc($result2)) {
                        // Tính thời gian đã trôi qua từ khi tạo đơn hàng
                        $created_time = $row['ship_time'];
                        $current_time = time();
                        $time = $row['time_dukien'];
                        (int)$elapsed_time = (int)$current_time - (int)$created_time;
                        // Nếu đã trôi qua 5 giây
                        if ($elapsed_time >= $time) {
                            // Cập nhật trạng thái của đơn hàng thành "Đơn rủi ro"
                            $idOrder = $row['idOrder'];
                            $update_query = "UPDATE oder SET `trangthai` = 3 WHERE `idOrder` = '$idOrder'";
                            $result = $this->db->update($update_query);
                            return "";
                        }   
                }
            }
            public function show_number_order(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE status = 1";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_epacket(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE `status` = 1 AND `service` = 'Epacket-USA' AND (`trangthai` = 1 OR `trangthai` = 7 OR `trangthai` = 8)";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_epacket_label(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE `status` = 1 AND `service` = 'Epacket-USA' AND `trangthai` = 6";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_nhapkho_epacket(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE `status` = 1 AND `service` = 'Epacket-USA' AND `trangthai` = 7";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_xuatkho_epacket(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE `status` = 1 AND `service` = 'Epacket-USA' AND `trangthai` = 8";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_label(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE status = 1 AND `trangthai` = 6";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_order_label($offset, $per_page){
                $query = "SELECT * FROM oder WHERE `status` = 1 AND `trangthai` = 6 order by `time` desc LIMIT $offset, $per_page";
                $result = $this->db->select($query);
                return $result;
            }
            public function show_number_order_ship(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE status = 1 AND `trangthai` = 5";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_nhapkho(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE status = 1 AND `trangthai` = 7";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_xuatkho(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE status = 1 AND `trangthai` = 8";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_ship_customer($name_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE status = 1 AND `trangthai` = 5 AND name_user = '$name_user' ";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_label_customer($id_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE `status` = 1 AND `trangthai` = 6 AND name_user = '$id_user'";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_order_ship($offset, $per_page){
                $query = "SELECT * FROM oder WHERE status = 1 AND `trangthai` = 5 order by `time` desc LIMIT $offset, $per_page";
                $result = $this->db->select($query);
                return $result;
            }
            public function show_order_nhapkho($offset, $per_page){
                $query = "SELECT * FROM oder WHERE status = 1 AND `trangthai` = 7 order by `time` desc LIMIT $offset, $per_page";
                $result = $this->db->select($query);
                return $result;
            }
            public function show_order_nhapkho_epacket($offset, $per_page){
                $query = "SELECT * FROM oder WHERE status = 1 AND `trangthai` = 7 AND `service` = 'Epacket-USA' order by `time` desc LIMIT $offset, $per_page";
                $result = $this->db->select($query);
                return $result;
            }
            public function show_order_xuatkho_epacket($offset, $per_page){
                $query = "SELECT * FROM oder WHERE status = 1 AND `trangthai` = 8 AND `service` = 'Epacket-USA' order by `time` desc LIMIT $offset, $per_page";
                $result = $this->db->select($query);
                return $result;
            }
            public function show_order_xuatkho($offset, $per_page){
                $query = "SELECT * FROM oder WHERE status = 1 AND `trangthai` = 8 order by `time` desc LIMIT $offset, $per_page";
                $result = $this->db->select($query);
                return $result;
            }
            public function show_order_ship_customer($offset, $per_page, $name_user){
                $query = "SELECT * FROM oder WHERE `status` = 1 AND `trangthai` = 5 AND `name_user` = '$name_user' order by `time` desc LIMIT $offset, $per_page";
                $result = $this->db->select($query);
                return $result;
            }
            public function show_order_label_customer($offset, $per_page, $name_user){
                $query = "SELECT * FROM oder WHERE status = 1 AND `trangthai` = 6 AND `name_user` = '$name_user' order by `time` desc LIMIT $offset, $per_page";
                $result = $this->db->select($query);
                return $result;
            }
            public function show_number_order_customer($id_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE status = 0 AND name_user = '$id_user'";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_all($id_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count FROM oder WHERE status = 1 AND name_user = '$id_user'";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_new(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `trangthai` = 0;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_new_customer($id_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND name_user = '$id_user'
                AND `trangthai` = 0";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_transporting(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `trangthai` = 1;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_transporting_epacket(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `trangthai` = 1 AND `service` = 'Epacket-USA'";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_transporting_customer($id_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `name_user` = '$id_user'
                AND `trangthai` = 1;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_nhapkho_customer($id_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `name_user` = '$id_user'
                AND `trangthai` = 7;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_xuatkho_customer($id_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `name_user` = '$id_user'
                AND `trangthai` = 8;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_done(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `trangthai` = 2;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_done_customer($id_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND name_user = '$id_user'
                AND `trangthai` = 2;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }

            public function show_number_order_return(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `trangthai` = 3;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_return_customer($name_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1 AND `name_user` = '$name_user'
                AND `trangthai` = 3;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
                
            public function show_number_order_cancel(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `trangthai` = 4;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
                     public function show_number_order_cancel_customer($name_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `name_user` = '$name_user'
                AND `trangthai` = 4;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_unpaid(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `payment` <> 1;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_unpaid_customer($name_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `name_user` = '$name_user'
                AND `payment` <> 1;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_paid_customer($name_user){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `name_user` = '$name_user'
                AND `payment` = 1;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_number_order_paid(){
                $count = 0; // Khởi tạo biến $count
                $query = "SELECT COUNT(*) AS count
                FROM oder
                WHERE `status` = 1
                AND `payment` = 1;";
                $result = $this->db->select($query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];
                return $count;// Trả về giá trị mặc định nếu biến $_SESSION['id'] chưa được khởi tạo
            }
            public function show_order_transporting_admin($offset, $per_page ){
                $query = "SELECT * FROM oder WHERE `status` = 1 AND `trangthai`= 1  order by `time` desc LIMIT $offset, $per_page "; 
                $result = $this->db->select($query);
                return $result;
        }  
            public function show_order_transporting_staff($offset, $per_page ){
                $query = "SELECT * FROM oder WHERE `status` = 1 AND `trangthai`= 1 AND `service` = 'Epacket-USA' order by `time` desc LIMIT $offset, $per_page "; 
                $result = $this->db->select($query);
                return $result;
        } 
            public function show_order_transporting_customer($offset,$per_page,$name_user){
                $query = "SELECT * FROM oder WHERE `trangthai` = 1 AND `status` = 1 AND `name_user` = '$name_user' order by `time` DESC LIMIT $offset, $per_page ";
                $result = $this->db->select($query);
                return $result;
        } 
            public function show_order_nhapkho_customer($offset,$per_page,$name_user){
                $query = "SELECT * FROM oder WHERE `trangthai` = 7 AND `status` = 1 AND `name_user` = '$name_user' order by `time` DESC LIMIT $offset, $per_page ";
                $result = $this->db->select($query);
                return $result;
        } 
            public function show_order_xuatkho_customer($offset,$per_page,$name_user){
                $query = "SELECT * FROM oder WHERE `trangthai` = 8 AND `status` = 1 AND `name_user` = '$name_user' order by `time` DESC LIMIT $offset, $per_page ";
                $result = $this->db->select($query);
                return $result;
        } 
            public function show_order_done_admin($offset, $per_page){
                $query = "SELECT * FROM oder WHERE `status` = 1 AND `trangthai`= 2 order by `time` desc LIMIT $offset, $per_page "; 
                $result = $this->db->select($query);
                return $result;
        } 
            public function show_order_done_customer($offset,$per_page,$name_user){
                $query = "SELECT * FROM oder WHERE `trangthai` = 2 AND `status` = 1 AND `name_user`='$name_user' order by `time` DESC LIMIT $offset, $per_page ";
                $result = $this->db->select($query);
                return $result;
        } 
            public function show_order_return_admin($offset, $per_page){
                $query = "SELECT * FROM oder WHERE trangthai = 3 AND `status` = 1 order by `time` DESC LIMIT $offset, $per_page";
                $result = $this->db->select($query);
                return $result;
        } 
        
            public function show_order_return_customer($offset,$per_page,$name_user){
                $query = "SELECT * FROM oder WHERE `trangthai` = 3 AND `name_user` = '$name_user' order by `time` DESC LIMIT $offset, $per_page";
                $result = $this->db->select($query);
                return $result;
        } 
            public function show_order_by_service($service,$offset,$per_page){
                $query = "SELECT * FROM oder WHERE `service` = '$service' AND `status` = 1  order by `time` DESC LIMIT $offset, $per_page";
                $result = $this->db->select($query);
                return $result;
        } 
        public function show_cart($id_user){
            $query = "SELECT * FROM oder WHERE name_user = '$id_user' AND `status` = 0  order by `time` DESC";
            $result = $this->db->select($query);
            return $result;
    } 
        public function save_order($data){
            $idOrder = mysqli_real_escape_string($this->db->link, $data['idOrder']);    
            $nameUser = mysqli_escape_string($this->db->link, $data['name_user']);
            $time = mysqli_escape_string($this->db->link, $data['time']);
            $nameCreater = mysqli_escape_string($this->db->link, $data['nameCreater']);
            $nameReceiver = mysqli_escape_string($this->db->link, $data['nameReceiver']);
            $addressReceiver = mysqli_escape_string($this->db->link, $data['addressReceiver']);
            $phoneReceiver = mysqli_escape_string($this->db->link, $data['phoneReceiver']);
            $country = mysqli_escape_string($this->db->link, $data['country']);
            $state = mysqli_escape_string($this->db->link, $data['state']);
            $city = mysqli_escape_string($this->db->link, $data['city']);
            $zipcode = mysqli_escape_string($this->db->link, $data['result']);
            $nameProduct = mysqli_escape_string($this->db->link, $data['product']);
            $quantity = mysqli_escape_string($this->db->link, $data['quantity']);
            $service = mysqli_escape_string($this->db->link, $data['service']);
            $length = mysqli_escape_string($this->db->link, $data['length']);
            $width = mysqli_escape_string($this->db->link, $data['width']);
            $height = mysqli_escape_string($this->db->link, $data['height']);
            $weight = mysqli_escape_string($this->db->link, $data['weight']);
            $query = "INSERT INTO oder(`idOrder`,`name_user`, `time`, `name_creater`, `name_consignee`,`address_consignee`, `phone_consignee`, `country`, `state`, `city`, `zipcode`,`name_product`, `quantity`,`service`,`status`,`trangthai`,`length`,`width`,`height`,`weight`)
            VALUES ('$idOrder','$nameUser','$time','$nameCreater','$nameReceiver','$addressReceiver','$phoneReceiver','$country','$state','$city','$zipcode','$nameProduct','$quantity','$service',0,0,'$length','$width','$height','$weight')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert= ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                Lưu đơn hàng thành công!.
                <span id="countdown" class="float-end"></span>
                </div> ';
                return $alert;
            }else{
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Đã xảy ra lỗi khi lưu đơn hàng. Vui lòng thử lại sau.
                    <span id="countdown" class="float-end"></span>
                </div>';
                return $alert;
            }
        }
        public function insert_order($data){
            $idOrder = mysqli_real_escape_string($this->db->link, $data['idOrder']);    
            $nameUser = mysqli_escape_string($this->db->link, $data['name_user']);
            $time = mysqli_escape_string($this->db->link, $data['time']);
            $nameCreater = mysqli_escape_string($this->db->link, $data['nameCreater']);
            $nameReceiver = mysqli_escape_string($this->db->link, $data['nameReceiver']);
            $addressReceiver = mysqli_escape_string($this->db->link, $data['addressReceiver']);
            $phoneReceiver = mysqli_escape_string($this->db->link, $data['phoneReceiver']);
            $country = mysqli_escape_string($this->db->link, $data['country']);
            $state = mysqli_escape_string($this->db->link, $data['state']);
            $city = mysqli_escape_string($this->db->link, $data['city']);
            $zipcode = mysqli_escape_string($this->db->link, $data['result']);
            $nameProduct = mysqli_escape_string($this->db->link, $data['product']);
            $quantity = mysqli_escape_string($this->db->link, $data['quantity']);
            $service = mysqli_escape_string($this->db->link, $data['service']);
            $length = mysqli_escape_string($this->db->link, $data['length']);
            $width = mysqli_escape_string($this->db->link, $data['width']);
            $height = mysqli_escape_string($this->db->link, $data['height']);
            $weight = mysqli_escape_string($this->db->link, $data['weight']);
            $query = "INSERT INTO oder(`idOrder`,`name_user`, `time`, `name_creater`, `name_consignee`,`address_consignee`, `phone_consignee`, `country`, `state`, `city`, `zipcode`,`name_product`, `quantity`,`service`,`status`,`trangthai`,`length`,`width`,`height`,`weight`)
            VALUES ('$idOrder','$nameUser','$time','$nameCreater','$nameReceiver','$addressReceiver','$phoneReceiver','$country','$state','$city','$zipcode','$nameProduct','$quantity','$service',1,0,'$length','$width','$height','$weight')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert= ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                Tạo đơn hàng thành công!.
                <span id="countdown" class="float-end"></span>
                </div> ';
                return $alert;
            }else{
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Đã xảy ra lỗi khi tạo đơn hàng. Vui lòng thử lại sau.
                    <span id="countdown" class="float-end"></span>
                </div>';
                return $alert;
            }
        }

        public function get_list_user(){
            $query = "SELECT * FROM user WHERE quyen = 3 order by `name` DESC";
            $result = $this->db->select($query);
            return $result;
    } 
        public function Show_label($idOrder){
            $idOrder = mysqli_escape_string($this->db->link, $idOrder);
            $query = "SELECT * FROM pdf_data WHERE `idOrder` = '$idOrder' order by `filename` DESC";
            $label = $this->db->select($query);
            return $label;
        }
        public function delete_label($id, $filename){ // sửa đổi tham số của hàm ở đây
            $id = mysqli_escape_string($this->db->link, $id); // sử dụng tham số $id thay cho $data['idOrder']
            $filename= mysqli_escape_string($this->db->link, $filename); // sử dụng tham số $filename thay cho $data['filename']
            $filepath = '../../Dungchung/pdf/'.$filename;
            $query = "DELETE FROM pdf_data WHERE `id` = '$id'";
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            $result = $this->db->delete($query);
            if ($result) {
                $alert= ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                Xóa thành công!.
                <span id="countdown" class="float-end"></span>
                </div> ';
              return $alert;
            }else{
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Xóa thất bại! Vui lòng thử lại sau.
                  <span id="countdown" class="float-end"></span>
                </div>';
            return $alert;
            }
        }
        public function find_by_id($order_id){
            $query = "SELECT * FROM `oder` WHERE `status` = 1 AND (`idOrder` LIKE '%$order_id%') order by `time` desc";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return null;
            }
        }
        public function find_by_id_epacket($order_id){
            $query = "SELECT * FROM `oder` WHERE `status` = 1 AND `service` = 'Epacket-USA' AND (`idOrder` LIKE '%$order_id%') AND (`trangthai` = 1 OR `trangthai` = 7 OR `trangthai` = 8) order by `time` desc";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return null;
            }
        }
                public function find_by_id_epacket_support($order_id){
            $query = "SELECT * FROM `oder` WHERE `status` = 1 AND `service` = 'Epacket-USA' AND (`idOrder` LIKE '%$order_id%') AND `trangthai` = 6 order by `time` desc";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return null;
            }
        }
        public function find_by_id_customer($order_id,$name_user){
            $query = "SELECT * FROM `oder` WHERE `name_user` = '$name_user' AND (`idOrder` LIKE '%$order_id%') order by `time` desc";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return null;
            }
        }
        public function show_order_cancel_admin($offset, $per_page){
            $query = "SELECT * FROM oder WHERE `status` = 1 AND `trangthai` = 4 order by `time` DESC LIMIT $offset, $per_page";
            $result = $this->db->select($query);
            return $result;
    } 
        public function show_order_cancel($offset,$per_page,$name_user){
            $query = "SELECT * FROM oder WHERE `status` = 1 AND `trangthai` = 4 AND `name_user` = '$name_user' order by `time` DESC LIMIT $offset, $per_page";
            $result = $this->db->select($query);
            return $result;
    } 

    public function show_order_new_admin($offset,$per_page){
        $query = "SELECT * FROM oder WHERE `status` = 1 AND `trangthai`= 0 order by `time` DESC LIMIT $offset, $per_page "; 
        $result = $this->db->select($query);
        return $result;
    }
    public function show_order_new($offset,$per_page,$name_user){
        $query = "SELECT * FROM oder WHERE `status` = 1 AND `trangthai`= 0 AND `name_user` = '$name_user' order by `time` DESC LIMIT $offset,$per_page"; 
        $result = $this->db->select($query);
        return $result;
    }
    public function show_order_all_admin($offset,$per_page){
        $query2 = "SELECT * FROM oder WHERE `status` = 1 order by `time` DESC LIMIT $offset, $per_page "; 
        $result = $this->db->select($query2);
        return $result;
    }
    public function show_order_all_staff($offset, $per_page) {
        $query2 = "SELECT * FROM oder WHERE `status` = 1 AND `service` = 'Epacket-USA' AND (`trangthai` = 1 OR `trangthai` = 7 OR `trangthai` = 8) ORDER BY `time` DESC LIMIT $offset, $per_page"; 
        $result = $this->db->select($query2);
        return $result;
    }
        public function show_order_all_support($offset, $per_page) {
        $query2 = "SELECT * FROM oder WHERE `status` = 1 AND `service` = 'Epacket-USA' AND `trangthai` = 6 ORDER BY `time` DESC LIMIT $offset, $per_page"; 
        $result = $this->db->select($query2);
        return $result;
    }
    public function show_order_unpaid($offset,$per_page){
        $query2 = "SELECT * FROM oder WHERE `status` = 1 AND `payment` <> 1 order by `time` DESC LIMIT $offset, $per_page "; 
        $result = $this->db->select($query2);
        return $result;
    }
    public function show_order_paid($offset,$per_page){
        $query2 = "SELECT * FROM oder WHERE `status` = 1 AND `payment` = 1 order by `time` DESC LIMIT $offset, $per_page "; 
        $result = $this->db->select($query2);
        return $result;
    }
    public function show_payment($offset,$per_page){
        $query2 = "SELECT * FROM vnpay order by `time` DESC LIMIT $offset, $per_page "; 
        $result = $this->db->select($query2);
        return $result;
    }
    public function show_payment_customer($name_user,$offset,$per_page){
        $query2 = "SELECT * FROM vnpay WHERE `name_user` = '$name_user' order by `time` DESC LIMIT $offset, $per_page "; 
        $result = $this->db->select($query2);
        return $result;
    }
    public function show_order_by_customer($name_user,$offset,$per_page){
        $query = "SELECT * FROM oder WHERE `name_user` = '$name_user' and `status` = 1 order by `time` DESC LIMIT $offset, $per_page"; 
        $result = $this->db->select($query);
        return $result;
    }
        public function show_order_by_kienhang($kienhang,$offset,$per_page){
        $query = "SELECT * FROM oder WHERE `kienhang` = '$kienhang' and `status` = 1 order by `time` DESC LIMIT $offset, $per_page"; 
        $result = $this->db->select($query);
        return $result;
    }
    public function show_order_by_staff($name_user){
        $query = "SELECT * FROM oder WHERE `name_creater` = '$name_user' order by `time` DESC"; 
        $result = $this->db->select($query);
        return $result;
    }
    public function update_profile($data){
        $name = mysqli_escape_string($this->db->link, $data['name']);
        $email = mysqli_escape_string($this->db->link, $data['email']);
        $phone = mysqli_escape_string($this->db->link, $data['phone']);
        $id = $_SESSION['id'];
           // Xử lý ảnh đại diện
    if (!empty($_FILES['avatar']['name'])) {
        $avatar_name = $_FILES['avatar']['name'];
        $avatar_size = $_FILES['avatar']['size'];
        $avatar_tmp = $_FILES['avatar']['tmp_name'];
        $avatar_ext = strtolower(pathinfo($avatar_name, PATHINFO_EXTENSION));
        $avatar_path = '../../uploads/' . $id . '.' . $avatar_ext;
        $allow_ext = array('jpg', 'jpeg', 'png');
            if (in_array($avatar_ext, $allow_ext)) {
                if ($avatar_size < 5000000) {
                    if (move_uploaded_file($avatar_tmp, $avatar_path)) {
                        // Lưu đường dẫn ảnh đại diện mới vào cơ sở dữ liệu
                        $avatar_url = $this->db->link->real_escape_string($avatar_path);
                        $avatar_query = "UPDATE user SET `avatar` = '$avatar_url' WHERE `id` = '$id'";
                        $this->db->update($avatar_query);
                    } else {
                        $avatar_url = $this->db->link->real_escape_string($avatar_path);
                        $avatar_query = "UPDATE user SET `avatar` = '$avatar_url' WHERE `id` = '$id'";
                        return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Lỗi khi tải lên ảnh đại diện! Vui lòng thử lại sau.'.$avatar_query.'
                        <span id="countdown" class="float-end"></span>
                        </div>';
                    }
                } else {
                    return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Kích thước tệp ảnh đại diện quá lớn! Vui lòng chọn tệp ảnh nhỏ hơn.
                    <span id="countdown" class="float-end"></span>
                    </div>';
                }
            } else {
                return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Định dạng tệp ảnh đại diện không hợp lệ! Chỉ chấp nhận ảnh JPG, JPEG, PNG và GIF.
                <span id="countdown" class="float-end"></span>
                </div>';
            }
            $query = "UPDATE user SET `name` = '$name',`email`= '$email',`phone` = '$phone' WHERE `id` = '$id'"; 
            $result = $this->db->update($query);
            if ($result) {
                $alert= ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                Cập nhật thành công! Thông tin sẽ hiện thị ở lần đăng nhập kế tiếp.
                <span id="countdown" class="float-end"></span>
                </div> ';
              return $alert;
            }else{
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Cập nhật thất bại! Vui lòng thử lại sau.
                  <span id="countdown" class="float-end"></span>
                </div>';
            return $alert;
            }
        }
    }
    public function show_status_order(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate = date('Y/m/d');
        $query = "SELECT * FROM daily_order WHERE `time` LIKE '%$currentDate%'";
        $result = $this->db->select($query);
        if ($result->num_rows > 0) {
            // Đã có bản ghi thống kê cho ngày hiện tại, cập nhật số lượng đơn hàng theo từng trạng thái vào các cột tương ứng
            $query = "SELECT COUNT(*) AS count FROM oder WHERE `status` = 1 AND DATE(`time`) = '$currentDate'";
            $result = $this->db->select($query);
            $row = mysqli_fetch_assoc($result);
            $allOrderCount = $row['count'];
            $query1 = "SELECT COUNT(*) AS count FROM oder WHERE `status` = 1 AND `trangthai` = 0 AND DATE(`time`) = '$currentDate'";
            $result1 = $this->db->select($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $newOrderCount = $row1['count'];
            $query2 = "SELECT COUNT(*) AS count FROM `oder` WHERE `status` = 1 AND `trangthai` = 6 AND DATE(`time`) = '$currentDate'";
            $result2 = $this->db->select($query2);
            $row2 = mysqli_fetch_assoc($result2);
            $labelOrderCount = $row2['count'];
            $query3 = "SELECT COUNT(*) AS count FROM `oder` WHERE `status` = 1 AND `trangthai` = 1 AND DATE(`time`) = '$currentDate'";
            $result3 = $this->db->select($query3);
            $row3 = mysqli_fetch_assoc($result3);
            $transportingOrderCount = $row3['count'];
            $query4 = "SELECT COUNT(*) AS count FROM `oder` WHERE `status` = 1 AND `trangthai` = 5 AND DATE(`time`) = '$currentDate'";
            $result4 = $this->db->select($query4);
            $row4 = mysqli_fetch_assoc($result4);
            $shipOrderCount = $row4['count'];
            $query5 = "SELECT COUNT(*) AS count FROM `oder` WHERE `status` = 1 AND `trangthai` = 2 AND DATE(`time`) = '$currentDate'";
            $result5 = $this->db->select($query5);
            $row5 = mysqli_fetch_assoc($result5);
            $doneOrderCount = $row5['count'];
            $query6 = "SELECT COUNT(*) AS count FROM `oder` WHERE `status` = 1 AND `trangthai` = 3 AND DATE(`time`) = '$currentDate'";
            $result6 = $this->db->select($query6);
            $row6 = mysqli_fetch_assoc($result6);
            $returnOrderCount = $row6['count'];
            $query7 = "SELECT COUNT(*) AS count FROM `oder` WHERE `status` = 1 AND `trangthai` = 4 AND DATE(`time`) = '$currentDate'";
            $result7 = $this->db->select($query7);
            $row7 = mysqli_fetch_assoc($result7);
            $cancelOrderCount = $row7['count'];
            // Cập nhật giá trị trong bảng daily_order
            $query8 = "UPDATE `daily_order` SET 
                        `all_order` = '$allOrderCount',
                        `new_order` = '$newOrderCount',
                        `label_order` = '$labelOrderCount',
                        `transporting_order` = '$transportingOrderCount',
                        `ship_order` = '$shipOrderCount',
                        `done_order` = '$doneOrderCount',
                        `return_order` = '$returnOrderCount',
                        `cancel_order` = '$cancelOrderCount'
                    WHERE `time` = '$currentDate'";
            $result8 = $this->db->update($query8);
        } else {
            // Tạo bản ghi mới với giá trị ban đầu và cập nhật số lượng đơn hàng theo từng trạng thái
            $query = "INSERT INTO daily_order(`time`, `all_order`, `new_order`, `label_order`,`transporting_order`,`ship_order`,`done_order`, `return_order`, `cancel_order`) 
                    VALUES ('$currentDate', 0, 0, 0, 0, 0, 0, 0, 0)";
            $result = $this->db->insert($query);
        }
    }
    public function show_status_finances(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate = date('Y:m:d');
        $currentDate2 = date('Ymd');
        $query = "SELECT * FROM report WHERE `time` LIKE '%$currentDate%' order by `time` DESC";
        $result = $this->db->select($query);
        if ($result->num_rows > 0) {
            // Đã có bản ghi thống kê cho ngày hiện tại, cập nhật số lượng đơn hàng theo từng trạng thái vào các cột tương ứng
            $query = "SELECT SUM(`price`) AS total_price FROM `vnpay` WHERE `status` = 1 AND `time` LIKE '%$currentDate2%'";
            $result = $this->db->select($query);
            $row = mysqli_fetch_assoc($result);
            $doanhthu = $row['total_price'];
            $query1 = "SELECT SUM(`price`) AS total_price FROM `chiphi` WHERE `time` LIKE '%$currentDate%'";
            $result1 = $this->db->select($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $chiphi = $row1['total_price'];
            // Cập nhật giá trị trong bảng report
            $loinhuan = $doanhthu - $chiphi;
            $query2 = "UPDATE `report` SET 
                        `doanh_thu` = '$doanhthu',
                        `chi_phi` = '$chiphi',
                        `loi_nhuan`='$loinhuan'
                    WHERE `time` = '$currentDate'";
            $result2 = $this->db->update($query2);
        } else {
            // Tạo bản ghi mới với giá trị ban đầu và cập nhật số lượng đơn hàng theo từng trạng thái
            $query = "INSERT INTO report(`time`) 
                    VALUES ('$currentDate')";
            $result = $this->db->insert($query);
        }
    }
    public function insert_chiphi($data){
        $time = mysqli_real_escape_string($this->db->link, $data['time']);    
        $price = mysqli_escape_string($this->db->link, $data['price']);
        $content = mysqli_escape_string($this->db->link, $data['content']);
        $query = "INSERT INTO chiphi(`time`,`price`, `content`)
        VALUES ('$time','$price','$content')";
        $result = $this->db->insert($query);
        if ($result) {
            $alert= ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            Thêm chi phí thành công!.
            <span id="countdown" class="float-end"></span>
            </div> ';
            return $alert;
        }else{
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Đã xảy ra lỗi khi thêm chi phí. Vui lòng thử lại sau.
                <span id="countdown" class="float-end"></span>
            </div>';
            return $alert;
        }
    }
    public function insert_thongbao($data){
        $time = mysqli_real_escape_string($this->db->link, $data['time']);    
        $tieude = mysqli_escape_string($this->db->link, $data['tieude']);
        $noidung = mysqli_escape_string($this->db->link, $data['noidung']);
        $quyen = mysqli_escape_string($this->db->link, $data['quyen']);
        $avatar_url = '../../uploads/0.jpg'; // Khởi tạo biến $avatar_url
        if (!empty($_FILES['image_noti']['name'])) {
            $avatar_name = $_FILES['image_noti']['name'];
            $avatar_size = $_FILES['image_noti']['size'];
            $avatar_tmp = $_FILES['image_noti']['tmp_name'];
            $avatar_ext = strtolower(pathinfo($avatar_name, PATHINFO_EXTENSION));
            $avatar_path = '../../uploads/'.$quyen . $avatar_name; // Lưu tại đường dẫn uploads với tên gốc của tệp
            $allow_ext = array('jpg', 'jpeg', 'png');
            if (in_array($avatar_ext, $allow_ext)) {
                if ($avatar_size < 5000000) {
                    if (move_uploaded_file($avatar_tmp, $avatar_path)) {
                        $avatar_url = $this->db->link->real_escape_string($avatar_path);
                    } else {
                        return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Lỗi khi tải lên ảnh! Vui lòng thử lại sau.
                            <span id="countdown" class="float-end"></span>
                        </div>';
                    }
                } else {
                    return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Kích thước tệp ảnh quá lớn! Vui lòng chọn tệp ảnh nhỏ hơn.
                        <span id="countdown" class="float-end"></span>
                    </div>';
                }
            } else {
                return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Định dạng tệp ảnh không hợp lệ! Chỉ chấp nhận ảnh JPG, JPEG, PNG và GIF.
                    <span id="countdown" class="float-end"></span>
                </div>';
            }
        }
        $query = "INSERT INTO thongbao(`time`, `tieude`, `noidung`, `quyen`,`image`)
                  VALUES ('$time', '$tieude', '$noidung', '$quyen','$avatar_url')";
        $result = $this->db->insert($query);
        if ($result) {
            $alert = ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                Thêm Thông báo thành công!.
                <span id="countdown" class="float-end"></span>
            </div> ';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Đã xảy ra lỗi khi thêm thông báo. Vui lòng thử lại sau.
                <span id="countdown" class="float-end"></span>
            </div>';
            return $alert;
        }
    }
    public function getListChiPhi($offset, $per_page){
        $query = "SELECT * FROM `chiphi` order by `time` DESC LIMIT $offset, $per_page";
        $result = $this->db->select($query);
        return $result;
    }
    public function getListThongBao($offset, $per_page){
        $query = "SELECT * FROM `thongbao` order by `time` DESC LIMIT $offset, $per_page";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_chiphi($id){
        $query = "DELETE FROM `chiphi` WHERE `id` = $id";
        $result = $this->db->delete($query);
        if ($result) {
            $alert= ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            Xóa chi phí thành công!.
            <span id="countdown" class="float-end"></span>
            </div> ';
            return $alert;
        }else{
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Đã xảy ra lỗi khi xóa chi phí. Vui lòng thử lại sau.
                <span id="countdown" class="float-end"></span>
            </div>';
            return $alert;
        }
    }
    public function delete_thongbao($id){
        $query = "DELETE FROM `thongbao` WHERE `id` = $id";
        $result = $this->db->delete($query);
        if ($result) {
            $alert= ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            Xóa thông báo thành công!.
            <span id="countdown" class="float-end"></span>
            </div> ';
            return $alert;
        }else{
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Đã xảy ra lỗi khi xóa thông báo. Vui lòng thử lại sau.
                <span id="countdown" class="float-end"></span>
            </div>';
            return $alert;
        }
    }
    public function show_order_paid_customer($offset,$per_page,$name_user){
        $query2 = "SELECT * FROM oder WHERE `status` = 1 AND `payment` = 1 AND `name_user` = '$name_user' order by `time` DESC LIMIT $offset, $per_page "; 
        $result = $this->db->select($query2);
        return $result;
    }
    public function show_order_unpaid_customer($offset,$per_page,$name_user){
        $query2 = "SELECT * FROM oder WHERE `status` = 1 AND `payment` <> 1 AND `name_user` = '$name_user' order by `time` DESC LIMIT $offset, $per_page "; 
        $result = $this->db->select($query2);
        return $result;
    }
    public function show_congno($name_user) {
        $query = "SELECT 
            `name_user`,
            SUM(CASE WHEN `payment` = 1 THEN price ELSE 0 END) AS da_thanh_toan,
            SUM(CASE WHEN `payment` <> 1 THEN price ELSE 0 END) AS chua_thanh_toan,
            SUM(price) AS tong_tien
        FROM 
            `oder`
        WHERE 
             `status` = 1
        GROUP BY
            `name_user`";
        
        $result = $this->db->select($query);
        return $result;
    }
    public function setvanchuyen($selectedIds){
            // Xử lý trạng thái vận chuyển cho từng ID
    foreach ($selectedIds as $id) {
      // Thực hiện truy vấn để set trạng thái vận chuyển cho ID
      $count = 0;
      $sql = "UPDATE `oder` SET `trangthai` = 1 WHERE idOrder = '$id' AND trangthai !=2 ";
      $result = $this->db->update($sql);
      $count++;
    }
        if($result){
            $alert=  '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Đã cập nhật trạng thái '.$count.' đơn hàng thành đang vận chuyển!.
            </div>';
            return $alert;
        }else{
            $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Đã xảy ra lỗi khi cập nhật trạng thái. Vui lòng thử lại sau.
          </div>';
            return $alert;
        }
    }
        public function setnhapkho($selectedIds){
            // Xử lý trạng thái nhập kho cho từng ID
    foreach ($selectedIds as $id) {
      // Thực hiện truy vấn để set trạng thái vận chuyển cho ID
      $count = 0;
      $sql = "UPDATE `oder` SET `trangthai` = 7 WHERE idOrder = '$id' AND trangthai !=2";
      $result = $this->db->update($sql);
      $count++;
    }
        if($result){
            $alert=  '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Đã cập nhật trạng thái '.$count.' đơn hàng thành đã nhập kho!.
            </div>';
            return $alert;
        }else{
            $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Đã xảy ra lỗi khi cập nhật trạng thái. Vui lòng thử lại sau.
          </div>';
            return $alert;
        }
    }
            public function setxuatkho($selectedIds){
            // Xử lý trạng thái xuất kho cho từng ID
    foreach ($selectedIds as $id) {
      // Thực hiện truy vấn để set trạng thái vận chuyển cho ID
      $count = 0;
      $sql = "UPDATE `oder` SET `trangthai` = 8 WHERE `idOrder` = '$id' AND trangthai !=2";
      $result = $this->db->update($sql);
      $count++;
    }
        if($result){
            $alert=  '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Đã cập nhật trạng thái '.$count.' đơn hàng thành đã xuất kho!.
            </div>';
            return $alert;
        }else{
            $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Đã xảy ra lỗi khi cập nhật trạng thái. Vui lòng thử lại sau.
          </div>';
            return $alert;
        }
    }
                public function setgiaophat($selectedIds){
            // Xử lý trạng thái giao phát cho từng ID
    foreach ($selectedIds as $id) {
      // Thực hiện truy vấn để set trạng thái vận chuyển cho ID
      $count = 0;
      $sql = "UPDATE `oder` SET `trangthai` = 5 WHERE idOrder = '$id' AND trangthai !=2";
      $result = $this->db->update($sql);
      $count++;
    }
        if($result){
            $alert=  '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Đã cập nhật trạng thái '.$count.' đơn hàng thành đang giao phát!.
            </div>';
            return $alert;
        }else{
            $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Đã xảy ra lỗi khi cập nhật trạng thái. Vui lòng thử lại sau.
          </div>';
            return $alert;
        }
    }
                    public function sethoanthanh($selectedIds){
            // Xử lý trạng thái giao phát cho từng ID
    foreach ($selectedIds as $id) {
      // Thực hiện truy vấn để set trạng thái vận chuyển cho ID
      $count = 0;
      $sql = "UPDATE `oder` SET `trangthai` = 2 WHERE idOrder = '$id' ";
      $result = $this->db->update($sql);
      $count++;
    }
        if($result){
            $alert=  '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Đã cập nhật trạng thái '.$count.' đơn hàng thành đã hoàn thành!.
            </div>';
            return $alert;
        }else{
            $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Đã xảy ra lỗi khi cập nhật trạng thái. Vui lòng thử lại sau.
          </div>';
            return $alert;
        }
    }
    public function xoakhoikien($selectedIds){
            // Xử lý trạng thái giao phát cho từng ID
    foreach ($selectedIds as $id) {
      // Thực hiện truy vấn để set trạng thái vận chuyển cho ID
      $count = 0;
      $sql = "UPDATE `oder` SET `kienhang` = '' WHERE idOrder = '$id' ";
      $result = $this->db->update($sql);
      $count++;
    }
        if($result){
            $alert=  '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Đã xóa '.$count.' đơn hàng khỏi kiện hàng!.
            </div>';
            return $alert;
        }else{
            $alert =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Đã xảy ra lỗi khi xóa kiện hàng. Vui lòng thử lại sau.
          </div>';
            return $alert;
        }
    }
}
?>