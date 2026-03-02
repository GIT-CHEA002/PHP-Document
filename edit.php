<?php
// name of file is edit.php

include 'connect-database.php';
date_default_timezone_set("Asia/Phnom_Penh");

$id = "";
$name = "";
$gender = "";
$email = "";
$phone = "";
$address = "";
$salary = 0;
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["id"])) {
        header("location: index.php");
        exit;
    }

    $id = $_GET["id"];

    // SAFE SELECT
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE doctor_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: index.php");
        exit;
    }

    $name = $row["doctor_name"];
    $gender = $row["gender"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["doctor_address"];
    $salary = $row["salary"];

    $stmt->close();

} else {

    // POST → Update
    $id = $_POST["ctr_id"];
    $name = $_POST["ctr_name"];
    $gender = $_POST["ctr_gender"];
    $email = $_POST["ctr_email"];
    $phone = $_POST["ctr_phone"];
    $address = $_POST["ctr_address"];
    $salary = $_POST["ctr_salary"];
    $update_at = date('Y-m-d H:i:s');

    // SAFE UPDATE
    $stmt = $conn->prepare("UPDATE doctors 
        SET doctor_name=?, gender=?, email=?, phone=?, doctor_address=?,salary=?, update_at=? 
        WHERE doctor_id=?");

    $stmt->bind_param("sssssssi",
        $name,
        $gender,
        $email,
        $phone,
        $address,
        $salary,
        $update_at,
        $id
    );

    if ($stmt->execute()) {
        header("location: index.php");
        exit;
    } else {
        $errorMessage = "Update failed: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Doctor</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</head>

<body>

<main class="container my-5">
<h2>Update Doctor</h2>

<?php
if (!empty($errorMessage)) {
    echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    </div>
    ";
}
?>

<form method="POST">

<input type="hidden" name="ctr_id" value="<?php echo $id; ?>">

<div class="row mb-3">
<label class="col-sm-3 col-form-label">Name</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="ctr_name"
value="<?php echo htmlspecialchars($name); ?>" required>
</div>
</div>

<div class="row mb-3">
<label class="col-sm-3 col-form-label">Gender</label>
<div class="col-sm-6">
<select class="form-control" name="ctr_gender" required>
<option value="" disabled>Select Gender</option>
<option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>Male</option>
<option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>Female</option>
</select>
</div>
</div>

<div class="row mb-3">
<label class="col-sm-3 col-form-label">Email</label>
<div class="col-sm-6">
<input type="email" class="form-control" name="ctr_email"
value="<?php echo htmlspecialchars($email); ?>" required>
</div>
</div>

<div class="row mb-3">
<label class="col-sm-3 col-form-label">Phone</label>
<div class="col-sm-6">
<input type="tel" class="form-control" name="ctr_phone"
value="<?php echo htmlspecialchars($phone); ?>" required>
</div>
</div>

<div class="row mb-3">
<label class="col-sm-3 col-form-label">Address</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="ctr_address"
value="<?php echo htmlspecialchars($address); ?>" required>
</div>
</div>

<div class="row mb-3">
<label class="col-sm-3 col-form-label">Salary</label>
<div class="col-sm-6">
<input type="number" class="form-control" name="ctr_salary"
value="<?php echo htmlspecialchars($salary); ?>" required>
</div>
</div>

<div class="row mb-3">
<div class="offset-sm-3 col-sm-3 d-grid">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
<div class="col-sm-3 d-grid">
<a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
</div>
</div>

</form>
</main>

</body>
</html>