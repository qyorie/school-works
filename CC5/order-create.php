<?php 
  include("dbconnection.php");
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
               <a class="nav-link active" href="order-list.php"
                  ><i class="bi bi-list me-2"></i>Orders</a
               >
            </li>
            <li class="nav-item">
               <a class="nav-link" href="pickup-delivery.php"
                  ><i class="bi bi-box-arrow-up me-2"></i>Pick-up/Delivery</a
               >
            </li>
            <li class="nav-item ">
               <a class="nav-link" href="order-history.php"
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
         <section id="createOrder">
            <form id="orderForm" method="POST" action="save-order.php">
               <!-- Customer Details -->
               <h2 class="mb-4">PLACE AN ORDER</h2>
               <h4 class="mb-4">Customer's Detail</h4>
               <div class="form-group row pb-1">
                  <label for="customerName" class="col-sm-2 col-form-label">Customer's Name*</label>
                  <div class="col-sm-3">
                        <input type="text" class="form-control" name="customerName" placeholder="Name" required>
                  </div>
                  <label for="contact" class="col-sm-2 col-form-label">Contact No.*</label>
                  <div class="col-sm-3">
                        <input type="text" class="form-control" name="contact" placeholder="e.g 09123456789" required>
                  </div>
               </div>
               <div class="form-group row pb-1">
                  <label for="address" class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" placeholder="e.g San Isidro Pob., Goa, Camarines Sur">
                  </div>
               </div>

               <!-- Order Details -->
               <h4 class="my-4">Order Detail</h4>
               <div class="table-responsive mb-3">
                  <table class="table table-bordered align-middle" id="itemsTable">
                        <thead class="table-light">
                           <tr>
                              <th>Service</th>
                              <th>Quantity</th>
                              <th>Service Price</th>
                              <th>Amount</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody id="itemsBody">
                           <tr>
                              <td>
                              <select class="form-select serviceSelect" name="service[]">
                                    <option value="">Select a service</option>
                                 </select>
                              </td>
                              <td><input type="number" class="form-control qty" name="qty[]" value="1"></td>
                              <td><input type="number" class="form-control servicePrice" name="servicePrice[]" value="0" readonly></td>
                              <td><input type="number" class="form-control amount" name="amount[]" value="0" readonly></td>
                              <td><button type="button" class="btn btn-danger btn-sm removeRow">Remove</button></td>
                           </tr>
                        </tbody>
                  </table>
                  <button type="button" class="btn btn-success btn-sm" id="addItem">+ Add New</button>
               </div>

               <div class="row mb-3">
                  <div class="col-md-3">
                        <label class="form-label">Sub Total</label>
                        <input type="number" class="form-control" id="subTotal" name="subTotal" value="0" readonly>
                  </div>
                  <div class="col-md-3">
                        <label class="form-label">Courier Type</label>
                        <select class="form-select" id="courier" name="courier">
                           <option>Pick-up</option>
                           <option>Delivery</option>  
                        </select>
                  </div>
                  <div class="col-md-3">
                        <label class="form-label">Fee</label>
                        <input type="number" class="form-control" id="addOn" name="fee" value="0">
                  </div>
                  <div class="col-md-3">
                        <label class="form-label">Total</label>
                        <input type="number" class="form-control bg-light" id="totalAmount" name="totalAmount" value="0" readonly>
                  </div>
               </div>

               <div class="form-group row pb-1">
                  <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Save</button>
                  </div>
               </div>
            </form>
         </section>
      </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="order-create.js"></script>
   
</body>
</html>
