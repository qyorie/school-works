<?php 
  include("dbconnection.php");
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['mark_done'])) {
    $order_id = $_POST['order_id'];
    $status = 'Done';
    $update_sql = "UPDATE laundry_order SET stat = '$status' WHERE order_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    $date_now = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO tracking (order_id, status, update_at) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $order_id, $status, $date_now);
    $stmt->execute();
    $stmt->close();
  }
  

  $sql = "SELECT 
            o.order_id,
            c.name AS customer_name,
            c.contact,
            c.address,
            GROUP_CONCAT(CONCAT(s.service_name, ' (', od.qty, ')') ORDER BY od.order_detail_id SEPARATOR ', ') AS service_names,
            o.courier_type,
            o.courier_fee,
            o.total_amt,
            o.stat

          FROM laundry_order o
          JOIN customer c ON o.customer_id = c.customer_id
          LEFT JOIN order_detail od ON o.order_id = od.order_id
          LEFT JOIN service s ON od.service_id = s.service_id
          WHERE o.stat = 'Completed'
          GROUP BY o.order_id";
          
  $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WashMax Laundry Shop</title>
  <link rel="icon" type="image/x-icon" href="logo.png">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
  />
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar">
      <div class="logo">
        <img src="logo.png" alt="WashMax Logo" />
        <h5>WashMax</h5>
      </div>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="order-list.php" data-section="orders"
            ><i class="bi bi-list me-2"></i>Orders</a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="pickup-delivery.php" data-section="pickup"
            ><i class="bi bi-box-arrow-up me-2"></i>Pick-up/Delivery</a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order-history.php" data-section="pickup"
            ><i class="bi bi-clipboard-check me-2"></i>History</a
          >
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="logout.php"
            ><i class="bi bi-box-arrow-left me-2"></i>Logout</a
          >
        </li>
      </ul>
    </nav>

    <!-- Main Content -->
    <div class="content w-100">
      <!-- Orders Section -->
      <section id="ordersSection">
        <h2 class="mb-4">Pickup/Delivery</h2>
        <table class="table table-bordered" id="ordersTable">
          <thead class="table-light">
          <tr>
            <th style="width: 5%;">Order ID</th>
            <th style="width: 15%;">Customer</th>
            <th style="width: 12%;">Contact</th>
            <th style="width: 20%;">Address</th>
            <th style="width: 18%;">Type of Service</th>
            <th style="width: 10%;">Courier</th>
            <th style="width: 5%;">Fee</th>
            <th style="width: 5%;">Total</th>
            <th style="width: 8%;">Mark As</th>
          </tr>
          </thead>
          <tbody>
            <?php if ($result->num_rows > 0): ?>
              <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= $row['order_id'] ?></td>
                  <td><?= htmlspecialchars($row['customer_name']) ?></td>
                  <td><?= htmlspecialchars($row['contact']) ?></td>
                  <td><?= htmlspecialchars($row['address']) ?></td>
                  <td><?= htmlspecialchars($row['service_names']) ?></td>
                  <td><?= htmlspecialchars($row['courier_type']) ?></td>
                  <td><?= number_format($row['courier_fee'], 2) ?></td>
                  <td><?= number_format($row['total_amt'], 2) ?></td>
                  <td>
                    <?php if ($row['stat'] !== 'Done'): ?>
                      <form method="POST" onsubmit="return confirm('Mark as Done?');">
                        <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                        <button type="submit" name="mark_done" class="btn btn-success btn-sm">Done</button>
                      </form>
                    <?php else: ?>
                      <span class="badge bg-success">Done</span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr><td colspan="9" class="text-center">No pickup/delivery orders found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </section>
    </div>
  </div>
  
</body>
</html>
