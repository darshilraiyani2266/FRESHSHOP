<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sub Category| Dashboard</title>

  <!-- add  style here -->
  <?php include'style.php'; ?>
   <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
 

  <!-- Navbar -->
 <!--add  navbar here-->
 <?php include'header.php'; ?>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<!-- add  sidebar here -->
<?php include'sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">sub categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
              <li class="breadcrumb-item active">sub category</li>
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
        <div class="col-12">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sub Category List</h3>
                <a href="subcategory_add.php"><button class="btn btn-primary float-right">ADD NEW</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Sub Category Description</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                     include'config.php'; 
                    $qry="select * from subcategories order by id desc";  
                   $result = mysqli_query($conn,$qry) or exit("Subcategories insert fail".mysqli_error($conn));
                    while ($rows = mysqli_fetch_array($result)){
                        $catqry="select catname from categories where id = '".$rows['catid']."' ";  
                        $catresult = mysqli_query($conn,$catqry) or exit("Category insert fail".mysqli_error($conn));
                        $catrows = mysqli_fetch_array($catresult)
                    ?>
                    <tr>
                    <td><?php echo $rows['id']; ?></td>
                    <td><img src="../images/subcategories/<?php echo $rows['image'] ?>" alt="" width="200px"></td>
                    <td><?php echo $catrows['catname']; ?></td>
                    <td><?php echo $rows['subcatname']; ?></td>
                    <td><?php echo $rows['subcatdescription']; ?></td>
                    <td>
                         <a href="subcategory_edit.php?id=<?= $rows['id']; ?>"><i class="fas fa-edit"></i></a>
                         <a href="subcategory_delete.php?id=<?= $rows['id']; ?>"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                        <?php
                    }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Sub Category Description</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- add footer here -->
 <?php include'footer.php'; ?>
<!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
 <!-- add script here  -->
 <?php include'script.php'; ?>
  <!-- datatables & plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>