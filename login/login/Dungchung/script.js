
function goBack() {
    window.history.back();
}
  // Lấy phần tử div thông báo
  var alertDiv = document.querySelector('.alert');

  // Thêm lớp và thuộc tính Bootstrap để định dạng thông báo
  alertDiv.classList.add('alert-dismissible', 'fade', 'show');

  // Tạo thanh đếm thời gian
  var countdownSpan = document.getElementById('countdown');
  var timeLeft = 5;

  var countdownInterval = setInterval(function() {
    timeLeft--;
    countdownSpan.innerHTML = timeLeft + 's';

    if (timeLeft <= 0) {
      // Xóa phần tử div và dừng đếm ngược
      clearInterval(countdownInterval);
      alertDiv.remove();
    }
  }, 1000);

