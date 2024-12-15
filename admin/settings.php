<?php
session_start();
if (isset($_SESSION['uname'])) {
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Master Layout| Dashboard</title>

    <!-- add  style here -->
    <?php
    include 'style.php';
    ?>
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Preloader -->
  

      <!-- Navbar -->
      <?php include 'header.php'; ?>

      <!-- Main Sidebar Container -->
      <?php include 'sidebar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Site Settings</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
                  <li class="breadcrumb-item active">Site Settings</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">SITE SETTINGS</h3>
                </div>

                <!-- Form Start -->
                <?php
                  include 'config.php';
                  $qry = "SELECT * FROM sitesettings";
                  $result = mysqli_query($conn, $qry) or exit("Settings select failed: " . mysqli_error($conn));
                  $row = mysqli_fetch_array($result);

                  if ($row) {
                ?>
                <form action="settings_add_db.php" method="post" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="sitename">Site Name</label>
                      <input type="text" class="form-control" id="sitename" name="sitename"
                        placeholder="Enter site name" value="<?php echo isset($row['sitename']) ? $row['sitename'] : ''; ?>">
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea name="text" class="form-control" id="address"><?php echo isset($row['address'])?$row['address']: ""; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="phoneno">Phone No</label>
                      <input type="text" class="form-control" id="phoneno" name="phoneno"
                        placeholder="Enter phone number" value="<?php echo isset($row['phoneno']) ? $row['phoneno'] : ''; ?>">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email"
                        placeholder="Enter email address" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>">
                    </div>
                    
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
                <?php } else { echo "No site settings found."; } ?>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- Footer -->
      <?php include 'footer.php'; ?>
    </div>

    <!-- Scripts -->
    <?php include 'script.php'; ?>
  </body>

  </html>
  <?php
} else {
  $_SESSION['error'] = "You are not authorized to access this page without login.";
  header("Location: index.php");
}
?>
