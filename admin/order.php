<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SMART PHONE | Order List</title>

  <?php include 'style.php'; ?>

  <!-- FontAwesome CDN for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include 'header.php'; ?>

  <!-- Sidebar -->
  <?php include 'sidebar.php'; ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Order List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Order List</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order List</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>User Email</th>
                      <th>Total Amount</th>
                      <th>Order Items</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Fetch all orders
                    $orderQry = "SELECT * FROM orders ORDER BY id";
                    $orderResult = mysqli_query($conn, $orderQry) or exit("Order Select failed: " . mysqli_error($conn));

                    while ($order = mysqli_fetch_assoc($orderResult)) {
                      $orderId = $order['id'];
                      $userEmail = $order['user_email'];
                      $totalAmount = $order['total_amount'];

                      // Fetch items for the current order using order_id
                      $itemQry = "SELECT * FROM order_item WHERE order_id = $orderId";
                      $itemResult = mysqli_query($conn, $itemQry) or exit("Order Item Select failed: " . mysqli_error($conn));

                      // Prepare to display order items
                      $itemsList = '';
                      while ($item = mysqli_fetch_assoc($itemResult)) {
                          $productId = $item['product_id'];
                          $quantity = $item['quantity'];

                          // Fetch product details
                          $productQry = "SELECT * FROM products WHERE id = $productId";
                          $productResult = mysqli_query($conn, $productQry) or exit("Product Select failed: " . mysqli_error($conn));
                          $product = mysqli_fetch_assoc($productResult);

                          // Construct the list of items
                          if ($product) {
                              $itemsList .= '<li><strong>' . $product['productname'] . '</strong> (Quantity: ' . $quantity . ', Price: ₹' . $product['productprice'] . ')</li>';
                          }
                      }
                      ?>
                      <tr>
                        <td><?php echo $orderId; ?></td>
                        <td><?php echo $userEmail; ?></td>
                        <td>₹<?php echo $totalAmount; ?></td>
                        <td>
                          <ul><?php echo $itemsList; ?></ul>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include 'footer.php'; ?>

</div>

<?php include 'script.php'; ?>

<!-- DataTables Scripts -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>

</body>
</html>
