<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PRODUCTS | Dashboard</title>

  <!-- Add style here -->
  <?php include('style.php'); ?>
  
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php include('header.php'); ?>
  
  <!-- Main Sidebar Container -->
  <?php include('sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product List</h3>
                <a href="products_add.php"><button class="btn btn-primary float-right">ADD NEW</button></a>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                
                <!-- Search Form -->
                <form method="get" action="product.php" class="mb-3">
                  <div class="input-group">
                    <input type="text" name="search_query" class="form-control" placeholder="Search for products" value="<?php echo isset($_GET['search_query']) ? $_GET['search_query'] : ''; ?>">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button>
                    </div>
                  </div>
                </form>

                <!-- Product Table -->
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Images</th>
                      <th>Category Name</th>
                      <th>Sub Category Name</th>
                      <th>Product Name</th>
                      <th>Product Description</th>
                      <th>Product Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include('config.php'); 

                    // Capture the search query if present
                    $search_query = isset($_GET['search_query']) ? mysqli_real_escape_string($conn, $_GET['search_query']) : '';

                    // Modify the query if there's a search query
                    if ($search_query != '') {
                        $qry = "SELECT * FROM products WHERE productname LIKE '%$search_query%' OR productdescription LIKE '%$search_query%' ORDER BY id DESC";
                    } else {
                        $qry = "SELECT * FROM products ORDER BY id DESC";  
                    }

                    $result = mysqli_query($conn, $qry) or exit("Products fetch failed: ".mysqli_error($conn));

                    while ($rows = mysqli_fetch_array($result)) {
                        // Fetch category name from the categories table
                        $catqry = "SELECT catname FROM categories WHERE id = '".$rows['catid']."'";  
                        $catresult = mysqli_query($conn, $catqry) or exit("Category fetch failed: ".mysqli_error($conn));
                        $catrows = mysqli_fetch_array($catresult);
                        $categoryName = $catrows ? $catrows['catname'] : 'Unknown Category';

                        // Fetch subcategory name from the subcategories table
                        $subcatqry = "SELECT subcatname FROM subcategories WHERE id = '".$rows['subcatid']."'";  
                        $subcatresult = mysqli_query($conn, $subcatqry) or exit("Subcategory fetch failed: ".mysqli_error($conn));
                        $subcatrows = mysqli_fetch_array($subcatresult);
                        $subCategoryName = $subcatrows ? $subcatrows['subcatname'] : 'Unknown Subcategory';
                    ?>
                    <tr>
                        <td><?php echo $rows['id']; ?></td>
                        <td><img src="../images/products/<?php echo $rows['image']; ?>" alt="" width="200px"></td>

                        <td><?php echo $categoryName; ?></td>
                        <td><?php echo $subCategoryName; ?></td>
                        <td><?php echo $rows['productname']; ?></td>
                        <td><?php echo $rows['productdescription']; ?></td>
                        <td><?php echo $rows['productprice']; ?></td>
                        <td>
                            <a href="product_edit.php?id=<?php echo $rows['id']; ?>"><i class="fas fa-edit"></i></a>
                            <a href="product_delete.php?id=<?php echo $rows['id']; ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Images</th>
                      <th>Category Name</th>
                      <th>Sub Category Name</th>
                      <th>Product Name</th>
                      <th>Product Description</th>
                      <th>Product Price</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- Footer -->
  <?php include('footer.php'); ?>

</div><!-- /.wrapper -->

<!-- Add script -->
<?php include('script.php'); ?>

<!-- DataTables Scripts -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
