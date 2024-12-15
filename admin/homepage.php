<?php
session_start();
include 'config.php'; // Ensure you include your database connection

if (isset($_SESSION['uname'])) {
    // Fetch total sales, total orders, and total users
    $totalSalesSql = "SELECT SUM(total_amount) AS total_sales FROM orders";
    $totalOrdersSql = "SELECT COUNT(*) AS total_orders FROM orders";
    $totalUsersSql = "SELECT COUNT(*) AS total_users FROM user_register";

    // Prepare and execute total sales query
    $totalSalesStmt = $conn->prepare($totalSalesSql);
    $totalSalesStmt->execute();
    $totalSalesResult = $totalSalesStmt->get_result();
    $totalSales = $totalSalesResult->fetch_assoc()['total_sales'] ?? 0; // Default to 0 if null

    // Prepare and execute total orders query
    $totalOrdersStmt = $conn->prepare($totalOrdersSql);
    $totalOrdersStmt->execute();
    $totalOrdersResult = $totalOrdersStmt->get_result();
    $totalOrders = $totalOrdersResult->fetch_assoc()['total_orders'] ?? 0; // Default to 0 if null

    // Prepare and execute total users query
    $totalUsersStmt = $conn->prepare($totalUsersSql);
    $totalUsersStmt->execute();
    $totalUsersResult = $totalUsersStmt->get_result();
    $totalUsers = $totalUsersResult->fetch_assoc()['total_users'] ?? 0; // Default to 0 if null

    // Close statements
    $totalSalesStmt->close();
    $totalOrdersStmt->close();
    $totalUsersStmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Master Layout | Dashboard</title>

  <!-- Add style here -->
  <?php include 'style.php'; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php include 'header.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'sidebar.php'; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>$<?php echo number_format($totalSales, 2); ?></h3>
                <p>Total Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="order.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $totalOrders; ?></h3>
                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="order.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $totalUsers; ?></h3>
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Add footer here -->
  <?php include 'footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- Add script here  -->
<?php include 'script.php'; ?>
</body>
</html>
<?php
} else {
    $_SESSION['error'] = "You are not authorized to access this page without logging in.";
    header("location:index.php");
}
?>
