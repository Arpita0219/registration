


<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "registration_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name    = htmlspecialchars($_POST['name']);
  $email   = htmlspecialchars($_POST['email']);
  $phone   = htmlspecialchars($_POST['phone']);
  $gender  = htmlspecialchars($_POST['gender']);
  $course  = htmlspecialchars($_POST['course']);
  $address = htmlspecialchars($_POST['address']);

  $sql = "INSERT INTO applications (name, email, phone, gender, course, address)
          VALUES ('$name', '$email', '$phone', '$gender', '$course', '$address')";

  if (!$conn->query($sql)) {
    die("Error inserting data: " . $conn->error);
  }
}

// Fetch all records
$result = $conn->query("SELECT * FROM applications");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Application Submitted</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f9;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h1 {
      text-align: center;
      color: #130606ff;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      text-align: center;
      padding: 12px;
      border: 1px solid #100404ff;
    }
    th {
      background-color: #05532fff;
      color: white;
    }
    td {
      color: #000000ff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>All Applications</h1>
    <table>
      <tr>
        <th>Serial No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Course</th>
        <th>Address</th>
      </tr>
      <?php 
      $serial = 1; // start serial number
      while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $serial++ ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['gender']) ?></td>
        <td><?= htmlspecialchars($row['course']) ?></td>
        <td><?= htmlspecialchars($row['address']) ?></td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>
