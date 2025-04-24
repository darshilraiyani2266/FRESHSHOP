<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Master Layout| Dashboard</title>

  <!-- add  style here -->
  <?php
  include'style.php';
?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
 <!--add  navbar here-->
 <?php
include'header.php';
  ?>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <!-- add  sidebar here -->
 <?php
include'sidebar.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
              <li class="breadcrumb-item"><a href="category.php">category</a></li>
              <li class="breadcrumb-item active">category add</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">CATAGORY ADD</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="category_add_db.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" class="form-control" id="txtcategory" name="catname" placeholder=" category name" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Category Description</label>
                    <textarea name="catdescription" class="form-control" id=" catdescription "></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Select Image</select></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                     
                    </div>
                  </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">ADD</button>
                </div>
              </form>
            </div>
            </div>
            
          </div>
          
        
        <!-- /.row -->
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <!-- add footer here -->
 <?php
 include'footer.php';
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
 <!-- add script here  -->
  <?php
include'script.php';
  ?>
</body>
</html>