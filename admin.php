<?php
include 'db_connect.php';
$result = mysqli_query($conn, "SELECT * FROM students ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Verify QR</title>
  <style>
    body { font-family: Arial; background: #f4f7fb; padding: 40px; }
    table { border-collapse: collapse; width: 100%; background: white; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
    th { background: #2b7cff; color: white; }
    img { width: 80px; }
    h2 { color: #2b7cff; text-align: center; }
  </style>
</head>
<body>
  <h2>Admin - QR Code Verification</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Birthday</th>
      <th>Course</th>
      <th>Exam Date</th>
      <th>QR Code</th>
      <th>Encoded Text</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['fullname']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= htmlspecialchars($row['birthday']) ?></td>
      <td><?= htmlspecialchars($row['course']) ?></td>
      <td><?= htmlspecialchars($row['exam_date']) ?></td>
      <td><img src="qrcodes/<?= htmlspecialchars($row['qr_code']) ?>"></td>
      <td><?= htmlspecialchars($row['qr_text']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
