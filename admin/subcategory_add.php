<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sub Category Add| Dashboard</title>

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
            <h1 class="m-0">sub categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
              <li class="breadcrumb-item"><a href="subcategory.php">Sub Category</a></li>
              <li class="breadcrumb-item active">Sub Category Add</li>
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
                <h3 class="card-title">SUB CATAGORY ADD</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <?php
               include'config.php';
                $qry="select * from categories order by id desc";  
                $result = mysqli_query($conn,$qry) or exit("category insert fail".mysqli_error($conn));

              ?>
              <form action="subcategory_add_db.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <select name="catid" id="catid" class="form-control">
                        <option  selected disabled>Select Category</option>
                        <?php
                            while ($rows = mysqli_fetch_array($result)){
                        ?>
                        <option value="<?php echo $rows['id']; ?>"><?php echo $rows['catname']?></option>
                        <?php
                            }
                        ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sub Category Name</label>
                    <input type="text" class="form-control" id="txtcategory" name="subcatname" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Sub Category Description</label>
                    <textarea name="subcatdescription" class="form-control" id=" catdescription "></textarea>
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