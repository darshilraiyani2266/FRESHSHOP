
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SMART PHONE | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <!--style is here-->
  <?php
    include_once('includes/style.php');
  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
    <!--header is here-->
  <?php
    include('header.php');
  ?>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
      <!--sidebar is here-->
  <?php
   include('sidebar.php');
  ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">SUB-Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="subcategory.php">SUB-Category</a></li>
              <li class="breadcrumb-item active">SUB-category Edit</li>
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
    <div class="col-md-12">
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SUB-CATEGORY EDIT</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               <?php
               include('config.php');
               $id=$_REQUEST['id'];
               $qry = "select * from subcategories where id=$id";
               $result = mysqli_query($conn,$qry) or exit("Category Select fail".mysqli_error($conn));
               $rows =mysqli_fetch_array($result);
               
                $catqry="select * from categories";  
                $catresult = mysqli_query($conn,$catqry) or exit("category insert fail".mysqli_error($conn));
                
              ?>
              <form action="subcategory_update.db.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                
                    <label for="exampleInputEmail1">Category Name</label>
                    <select name="catid" id="catid" class="form-control">
                        <option  selected disabled>Select Category</option>
                        <?php
                            while ($catrows = mysqli_fetch_array($catresult)) {
                        ?>
                        <option value="<?php echo $catrows['id'] ?>" <?php echo $rows['catid']==$catrows['id']?"selected":""?>>
                        <?php echo $catrows['catname']?>
                        </option>

                        <?php
                            }
                            
                        ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sub Category Name</label>
                    <input type="text" class="form-control" id="subcatname" placeholder="Category name" name="subcatname" value="<?php echo $rows['subcatname']; ?>">
                    <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Sub Category Discription</label>
                    <input name="subcatdescription" class="form-control" id="subcatdescription" value="<?php echo $rows['subcatdescription']; ?>" ></input>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Select image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>

                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Old Image</label>
                    <input type="hidden" name="oldimage" value="<?php echo $rows['image'] ?>">
                    <img src="../images/subcategories/<?php echo $rows['image'] ?>" alt=""   width="100px">

                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">UPDATE</button>
                </div>
              </form>
            </div>

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--footer is here-->
  <?php
    include('footer.php');
  ?>


  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!--script is here-->
<?php
  include('script.php');
?>

</body>
</html>
