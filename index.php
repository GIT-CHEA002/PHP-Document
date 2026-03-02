<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatable with Query</title>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

    <link rel="stylesheet"
        href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-4">
    <h2>Paging using jQuery</h2>

    <a class="btn btn-primary mb-3" href="insert.php" role="button">
        Add a New Doctor
    </a>

    <table id="mytable" class="display table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Salary</th>
                <th>Create_At</th>
                <th>Update_At</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php
        include 'connect-database.php';

        $sql = "SELECT * FROM doctors WHERE is_active = 1";
        $records = $conn->query($sql);

        if ($records && $records->num_rows > 0) {
            while ($row = $records->fetch_assoc()) {

                echo "
                <tr>
                    <td>{$row['doctor_id']}</td>
                    <td>{$row['doctor_name']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['doctor_address']}</td>
                    <td>{$row['salary']}</td>
                    <td>{$row['create_at']}</td>
                    <td>{$row['update_at']}</td>
                    <td>
                        <a class='btn btn-sm btn-warning' href='edit.php?id={$row['doctor_id']}'>Edit</a>
                        <a class='btn btn-sm btn-danger' href='delete.php?id={$row['doctor_id']}'>Stop Working</a>
                    </td>
                </tr>
                ";
            }
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    new DataTable('#mytable');
</script>

</body>
</html>