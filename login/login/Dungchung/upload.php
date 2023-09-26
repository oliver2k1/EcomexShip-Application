<?php
include './dbcon.php';
session_start();
?>

<?php
// If submit button is clicked
if (isset($_POST['submit'])) {
    // get name from the form when submitted
    $name = $_POST['name'];
    $time = date('Y-m-d H:i:s');
    $name_user = $_SESSION['name'];
    if (isset($_FILES['pdf_file']['name'])) {
        // If the ‘pdf_file’ field has an attachment
        $file_name = $_FILES['pdf_file']['name'];
        $file_tmp = $_FILES['pdf_file']['tmp_name'];

        // Check if file already exists
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = $file_name;
        $counter = 1;

        while (file_exists("./pdf/" . $new_file_name)) {
            // If file already exists, append a counter to the file name
            $new_file_name = pathinfo($file_name, PATHINFO_FILENAME) . ' (' . $counter .')'. '.' . $file_extension;
            $counter++;
        }

        // Move the uploaded pdf file into the pdf folder with the new name
        move_uploaded_file($file_tmp, "./pdf/" . $new_file_name);

        // Insert the submitted data from the form into the table
        $insertquery =
            "INSERT INTO pdf_data(`idOrder`,`filename`,`time`,`name_user`) VALUES('$name','$new_file_name','$time','$name_user')";

        // Execute insert query
        $iquery = mysqli_query($con, $insertquery);

        if ($iquery) {
?>
            <script>
                alert("Upload label thành công!");
                window.close(); // Đóng trang hiện tại
            </script>
<?php
        } else {
?>
            <script>
                alert("Upload label thất bại!");
                window.close(); // Đóng trang hiện tại
            </script>
<?php
        }
    } else {
?>
        <div class="alert alert-danger alert-dismissible fade show text-center">
            <a class="close" data-dismiss="alert" aria-label="close">
                ×
            </a>
            <strong>Thất bại!</strong> Vui lòng upload tệp PDF!
        </div>
<?php
    }
}
?>

<?php
include 'js.php';
?>