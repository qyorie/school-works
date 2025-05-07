<?php
include("dbconnection.php");
$date = date("Y-m-d");

if(isset($_GET['filter_date'])){
   $date = $_GET['date'];
}
if(isset($_GET['reset_date'])){
   $date = date("Y-m-d");
}

// Query to retrieve orders
$sql = "SELECT 
            o.order_id, 
            c.name,
            c.address,
            o.order_date, 
            o.stat, 
            c.contact, 
            o.courier_type, 
            o.courier_fee, 
            o.total_amt,
            (o.total_amt - o.courier_fee) as subtotal,
            GROUP_CONCAT(CONCAT(s.service_name, ' (', od.qty, ')') ORDER BY od.order_detail_id SEPARATOR ', ') AS service_names
         FROM laundry_order o
         JOIN customer c ON o.customer_id = c.customer_id
         LEFT JOIN order_detail od ON o.order_id = od.order_id
         LEFT JOIN service s ON od.service_id = s.service_id
         WHERE o.stat = 'Done' AND o.order_date = '$date'
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
               <a class="nav-link" href="pickup-delivery.php" data-section="pickup"
                  ><i class="bi bi-box-arrow-up me-2"></i>Pick-up/Delivery</a
               >
            </li>
            <li class="nav-item ">
               <a class="nav-link active" href="order-history.php" data-section="pickup"
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
         <h2 class="mb-4">Order History</h2>
         <form name="filter" method="GET">
            <div class="row mb-3">
               <div class="col-2">
                  <input type="date" name="date" value= "<?php echo $date?>"class="form-control" />
               </div>
               <div class="col">
                  <button type="submit" name="filter_date" class="btn btn-primary">Filter</button>
                  <button type="submit" name="reset_date" class="btn btn-danger">Reset</button>
               </div>
            </div>
         </form>
         <table class="table table-bordered" id="ordersTable">
            <thead class="table-light">
               <tr>
                  <th style="width: 5%;">Order ID</th>
                  <th style="width: 15%;">Customer</th>
                  <th style="width: 12%;">Contact</th>
                  <th style="width: 20%;">Address</th>
                  <th style="width: 12%;">Order Created</th>
                  <th style="width: 18%;">Type of Service</th>
                  <th style="width: 5%;">Courier</th>
                  <th style="width: 5%;">Fee</th>
                  <th style="width: 10%;">Subtotal</th>
                  <th style="width: 10%;">Total</th>
               </tr>
               </thead>
               <tbody>
                  <?php if ($result->num_rows > 0): ?>
                     <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                           <td><?= $row['order_id'] ?></td>
                           <td><?= htmlspecialchars($row['name']) ?></td>
                           <td><?= htmlspecialchars($row['contact']) ?></td>
                           <td><?= htmlspecialchars($row['address']) ?></td>
                           <td><?= htmlspecialchars($row['order_date']) ?></td>
                           <td><?= htmlspecialchars($row['service_names']) ?></td>
                           <td><?= htmlspecialchars($row['courier_type']) ?></td>
                           <td><?= number_format($row['courier_fee'], 2) ?></td>
                           <td><?= number_format($row['subtotal'], 2) ?></td>
                           <td><?= number_format($row['total_amt'], 2) ?></td>
                        </tr>
                     <?php endwhile; ?>
                  <?php else: ?>
                     <tr><td colspan="9" class="text-center">No history orders found.</td></tr>
                  <?php endif; ?>
               </tbody>
            </table>
         </section>
      </div>
  </div>
  
</body>
</html>
