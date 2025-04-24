<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit products</title>

  <?php
  include('style.php');
  include('config.php');

  // Get the car ID from the URL
  $id = $_GET['id'];
  $qry = "SELECT * FROM products WHERE id = $id";
  $result = mysqli_query($conn, $qry);
  $product = mysqli_fetch_assoc($result);
  
  // Fetch categories for the dropdown
  $categories_query = "SELECT * FROM categories ORDER BY id DESC";
  $categories_result = mysqli_query($conn, $categories_query);
  
  // Fetch subcategories based on the car's category
  $subcategories_query = "SELECT * FROM subcategories WHERE catid = " . $product['catid'];
  $subcategories_result = mysqli_query($conn, $subcategories_query);
  ?>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <?php include('header.php'); ?>

  <!-- Main Sidebar Container -->
  <?php include('sidebar.php'); ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
              <li class="breadcrumb-item"><a href="product.php">products</a></li>
              <li class="breadcrumb-item active">Edit products</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">EDIT products</h3>
            </div>

            <form action="product_edit_db.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
              <div class="card-body">
                <div class="form-group">
                  <label for="catid">Category Name</label>
                  <select name="catid" id="catid" class="form-control">
                    <option disabled>Select Category</option>
                    <?php while ($row = mysqli_fetch_array($categories_result)) { ?>
                      <option value="<?php echo $row['id']; ?>" <?php echo ($product['catid'] == $row['id']) ? 'selected' : ''; ?>>
                        <?php echo $row['catname']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="subcatid">Select Sub Category Name</label>
                  <select name="subcatid" id="subcatid" class="form-control">
                    <option disabled>Select Sub Category</option>
                    <?php while ($subrow = mysqli_fetch_array($subcategories_result)) { ?>
                      <option value="<?php echo $subrow['id']; ?>" <?php echo ($product['subcatid'] == $subrow['id']) ? 'selected' : ''; ?>>
                        <?php echo $subrow['subcatname']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="productname">product Name</label>
                  <input type="text" class="form-control" id="productname" name="productname" value="<?php echo $product['productname']; ?>">
                </div>
                <div class="form-group">
                  <label for="productdescription">productdescription</label>
                  <textarea name="productdescription" class="form-control" id="productdescription"><?php echo $product['productdescription']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="carprice">product Price</label>
                  <input type="text" class="form-control" id="carprice" name="productprice" value="<?php echo $product['productprice']; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Select Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include('footer.php'); ?>
  
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<?php include_once('script.php'); ?>
<script>
  $(document).ready(function() {
    // Pre-populate subcategories based on selected category
    $("#catid").change(function() {
      var catid = $(this).val();
      $.ajax({
        url: "getsubcat.php",
        type: "GET",
        cache: false,
        data: { id: catid },
        success: function(result) {
          $("#subcatid").html(result);
        }
      });
    }).trigger("change"); // Trigger change to pre-select the subcategory on page load
  });
</script>

</body>
</html>