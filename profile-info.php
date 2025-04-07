<?php
$sql = "SELECT * FROM users WHERE id = " . $_SESSION['id'];
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $sql = "UPDATE users SET name = '$name', email = '$email', phone = '$phone', dob = '$dob' WHERE id = " . $_SESSION['id'];
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script>
    alert('Profile Updated Successfully!')
</script>";
        echo "<script>
    window.location.href = 'dashboard.php'
</script>";
    } else {
        echo "<script>
    alert('Error!')
</script>";
    }
}
