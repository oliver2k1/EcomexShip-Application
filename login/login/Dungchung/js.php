    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/js/menu.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="../../assets/js/form-basic-inputs.js"></script>
    <script src="../../Dungchung/script.js"></script>
    <script src='../../Dungchung/districts.min.js'></script>
<script>if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<script>
      // Lấy tham chiếu đến các phần tử trên giao diện
      var daiInput = document.getElementById("dai");
      var rongInput = document.getElementById("rong");
      var caoInput = document.getElementById("cao");
      var ketQuaInput = document.getElementById("ketqua");

      // Lắng nghe sự kiện "keyup" của hai input độ dài và độ rộng
      daiInput.addEventListener("input", tinhDiemTichVaChia);
      rongInput.addEventListener("input", tinhDiemTichVaChia);
      caoInput.addEventListener("input", tinhDiemTichVaChia);
      daiInput.addEventListener("change", tinhDiemTichVaChia);
      rongInput.addEventListener("change", tinhDiemTichVaChia);
      caoInput.addEventListener("change", tinhDiemTichVaChia);
      // Hàm tính diện tích và kết quả chia
      function tinhDiemTichVaChia() {
        var dai = +daiInput.value;
        var rong = +rongInput.value;
        var cao = +caoInput.value;
        var dienTich = dai * rong * cao;
        var ketQua = dienTich / 5;
         ketQuaInput.value = Math.round(ketQua);
      }
  </script>
  <script>
    const weightInput = document.getElementById("weight");
    const dimInput = document.getElementById("ketqua");
    const priceDiv = document.getElementById("price");
    const service = document.getElementById("service");
    const feeInput = document.getElementById("fee");
    const disscountInput = document.getElementById("disscount");
    function handleInput() {
    const weight = weightInput.value;
    const dim = dimInput.value;
    const fee = feeInput.value;
    const discount = disscountInput.value;
    const total = Math.max(weight, dim);
    const service_id = service.value;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        const price = parseInt(this.responseText);
        const discountedPrice = price * (100 - discount) / 100;
        const totalPrice = discountedPrice + parseInt(fee);
        priceDiv.value = totalPrice;
      }
    };
    xhttp.open("GET", "get-price.php?total=" + total + "&service=" + service_id, true);
    xhttp.send();
  }
    weightInput.addEventListener("input", handleInput);
    weightInput.addEventListener("change", handleInput);
    dimInput.addEventListener("input", handleInput);
    dimInput.addEventListener("change", handleInput);
    feeInput.addEventListener("input", handleInput);
    feeInput.addEventListener("change", handleInput);
    disscountInput.addEventListener("input", handleInput);
    disscountInput.addEventListener("change", handleInput);
  </script>
  <script>
  $(document).ready(function() {
    var eventSource = new EventSource('sse.php');
    eventSource.onmessage = function(event) {
      var order = JSON.parse(event.data);
      var orderId = order.idOrder;
      var orderTime = new Date(order.time);
      var tableRow = $('<tr>').append(
        $('<td>').append($('<a>').attr('href', 'detail.php?idOrder=' + orderId).text(orderId)),
        $('<td>').text(formatTimeDifference(orderTime))
      );
      $('#orderTableBody').prepend(tableRow);
    };
  });

  function formatTimeDifference(startTime) {
    var currentTime = new Date();
    var timeDiff = currentTime.getTime() - startTime.getTime();
    var seconds = Math.floor(timeDiff / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);
    var days = Math.floor(hours / 24);
    seconds %= 60;
    minutes %= 60;
    hours %= 24;
    var timeString = "";
    if (days > 0) {
      timeString = days + ' ngày trước';
    } else if (hours > 0) {
      timeString = hours + ' giờ trước';
    } else if (minutes > 0) {
      timeString = minutes + ' phút trước';
    } else {
      timeString = 'vừa mới';
    }
    return timeString;
  }
</script>
<script>
  function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
      var output = document.getElementById('preview');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
  var isCheckedAll = false;

  function toggleAll() {
    var checkboxes = document.getElementsByClassName('checkbox');
    
    if (isCheckedAll) {
      // Bỏ chọn tất cả các checkbox
      for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = false;
      }
      isCheckedAll = false;
    } else {
      // Chọn tất cả các checkbox
      for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = true;
      }
      isCheckedAll = true;
    }
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
<?php
    $servername = "localhost";
    $username = "eco33771_ecomex";
    $password = "Ecomex@123";
    $dbname = "eco33771_ecomex";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }
    $currentYear = date("Y");
    // Truy vấn cơ sở dữ liệu để lấy dữ liệu từ cột "time"
    $sql = "SELECT MONTH(`time`) AS month, SUM(`doanh_thu`) AS total_revenue, SUM(`chi_phi`) AS total_expenses,
     SUM(`loi_nhuan`) AS total_profit FROM `report` WHERE YEAR(`time`) = $currentYear GROUP BY MONTH(`time`)";
    $result = $conn->query($sql);

    // Xử lý kết quả truy vấn
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $monthYear = $row['month'];
            $data[$monthYear] = [
                'doanh_thu' => $row['total_revenue'],
                'chi_phi' => $row['total_expenses'],
                'loi_nhuan' => $row['total_profit']
            ];
        }
    }

    // Đóng kết nối cơ sở dữ liệu
    $conn->close();

    // Chuyển đổi mảng dữ liệu thành định dạng JSON
    $jsonData = json_encode($data);
?>
    // Parse dữ liệu JSON
    var jsonData = <?php echo $jsonData; ?>;

        // Parse dữ liệu JSON
        var jsonData = <?php echo $jsonData; ?>;

        // Chuẩn bị dữ liệu cho biểu đồ
        var labels = Object.keys(jsonData);
        var datasets = [
            {
                label: 'Doanh thu',
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                data: labels.map(function (key) {
                    return jsonData[key].doanh_thu;
                })
            },
            {
                label: 'Chi phí',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                data: labels.map(function (key) {
                    return jsonData[key].chi_phi;
                })
            },
            {
                label: 'Lợi nhuận',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                data: labels.map(function (key) {
                    return jsonData[key].loi_nhuan;
                })
            }
        ];

    // Tạo biểu đồ cột
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            return value + ' VNĐ'; // Thêm đơn vị vào giá trị trục y
                        }
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Biểu đồ thống kê tài chính năm <?php echo $currentYear ?>',
                    font: {
                        size: 18
                    }
                }
            }
        }
    });
  </script>
  <script>
    $(document).ready(function() {
        $(".read-more").click(function(event) {
            event.preventDefault();
            var cardText = $(this).closest(".card-body").find(".card-text");
            if (cardText.hasClass("collapsed")) {
                cardText.removeClass("collapsed");
                $(this).text("Thu gọn");
            } else {
                cardText.addClass("collapsed");
                $(this).text("Đọc thêm");
            }
        });
    });
</script>
<script>
$(document).ready(function() {
    // Hàm gửi yêu cầu AJAX để tải tin nhắn
    var currentUsername = $("#current-user").data("username");
    var receiverAccount = currentUsername; // Giá trị mặc định ban đầu
    function loadMessages() {
    $.ajax({
        url: "../../Dungchung/load_messages.php",
        method: "POST",
        data: { currentAccount: currentUsername, receiverAccount: receiverAccount },
        success: function(response) {
            $("#chat-messages").html(response);

            // Cuộn xuống đoạn tin nhắn mới nhất
            var chatMessages = document.getElementById("chat-messages");
            chatMessages.scrollTop = chatMessages.scrollHeight;
            checkNewMessages();
        }
    });
}
    // Gọi hàm loadMessages để tải tin nhắn khi trang được tải lần đầu
    loadMessages();
    // Xử lý sự kiện khi gửi tin nhắn
    $("#message-form").submit(function(e) {
        e.preventDefault();
        var message = $("#input-message").val();
        if (message.trim() === "") {
            return;
        }
        $("#input-message").val("");
        $.ajax({
            url: "../../Dungchung/save_message.php",
            method: "POST",
            data: { currentAccount: currentUsername, receiverAccount: receiverAccount, message: message },
            success: function(response) {
                loadMessages(); // Tải tin nhắn mới cho người nhận
            }
        });
    });
          function activateUser(event) {
        var selectedUser = event.target;
        var receiver = selectedUser.dataset.receiver;
        receiverAccount = receiver;
        
        // Loại bỏ lớp "active" khỏi tất cả các phần tử
        var users = document.querySelectorAll('.list-group-item');
        users.forEach(function(user) {
          user.classList.remove('active');
        });
        
        // Thêm lớp "active" cho phần tử được chọn
        selectedUser.classList.add('active');
        loadMessages();
        // Gửi yêu cầu AJAX để cập nhật trạng thái tin nhắn
        $.ajax({
          url: '../../Dungchung/update_message_status.php',
          method: 'POST',
          data: { receiver: receiver, currentAccount: currentUsername},
          success: function(response) {
            if (response === 'success') {
              // Ẩn chỉ báo tin nhắn chưa đọc (nếu có)
              var messageIndicators = selectedUser.querySelectorAll('.messageIndicator');
              messageIndicators.forEach(function(messageIndicator) {
                messageIndicator.style.display = 'none';
              });
            } else {
              // Xử lý lỗi nếu cần thiết
            }
          }
        });
      }
        // Gửi yêu cầu kiểm tra tin nhắn mới
        function checkNewMessages() {
          $.ajax({
            url: '../../Dungchung/check_new_message.php',
            method: 'GET',
            data: { currentUsername: currentUsername }, // Truyền tham số currentUsername
            success: function(response) {
              if (response === 'true') {
                $('.messageIndicator').show();
              } else {
                $('.messageIndicator').hide();
              }
            }
          });
        }
    $(".list-group-item").click(function(event) {
        activateUser(event);
    });
     // Kiểm tra tin nhắn mới mỗi 2 giây
  setInterval(loadMessages, 2000);
});
</script>
  </body>
</html>