<?php
include("dbconnection.php");

// Get form data from POST request
$customer_name = $_POST['customerName'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$courier_type = $_POST['courier'];
$courier_fee = floatval($_POST['fee']);
$total_amt = floatval($_POST['totalAmount']); // Total amount after adding services and courier fee
$services = array(); // Array of items from POST

// Collect service details (service IDs, quantities, and amounts)
foreach ($_POST['service'] as $index => $service_id) {
    $services[] = [
        'service_id' => $service_id,
        'qty' => $_POST['qty'][$index],
        'price' => $_POST['servicePrice'][$index],
        'amount' => $_POST['amount'][$index]
    ];
}
var_dump($services);
// 1. Insert customer into the database
$stmt = $conn->prepare("INSERT INTO customer (name, contact, address) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $customer_name, $contact, $address);
$stmt->execute();
$customer_id = $stmt->insert_id;
$stmt->close();

// 2. Insert laundry_order (using total_amt from form)
$stat = 'Pending';
$order_date = date('Y-m-d');
$employee_id = 1; // Assuming a fixed employee ID for now

$stmt = $conn->prepare("INSERT INTO laundry_order (customer_id, stat, order_date, total_amt, employee_id, courier_type, courier_fee)
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issdiss", $customer_id, $stat, $order_date, $total_amt, $employee_id, $courier_type, $courier_fee);
$stmt->execute();
$order_id = $stmt->insert_id; // Get the order ID of the newly inserted order
$stmt->close();

// 3. Insert order_detail items into the database
$stmt = $conn->prepare("INSERT INTO order_detail (order_id, service_id, subtotal, qty) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iidi", $order_id, $service_id, $subtotal, $qty); // Binding parameters
foreach ($services as $item) {
    $service_id = $item['service_id'];
    $subtotal = intval($item['amount']); // Total amount for that service
    $qty = intval($item['qty']); // Quantity for the service
    
    echo "Service ID: $service_id, Subtotal: $subtotal, Qty: $qty<br>";
    $stmt->execute();
}
$stmt->close();

// 4. Insert into tracking table
$stmt = $conn->prepare("INSERT INTO tracking (order_id, status, update_at) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $order_id, $stat, $order_date);
$stmt->execute();
$stmt->close();

// Redirect to the order list or show a success message
echo "Order successfully saved!";
header("Location: order-list.php"); // Redirect to order list page
exit;
?>