<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

?>
  <!-- MAIN -->
  <main>
    <!-- HERO -->
    <div class="nero">
      <div class="nero__heading">
        <span class="nero__bold">Local </span>Stores
      </div>
      <p class="nero__text">
      </p>
    </div>
  </main>


<div id="content" ><!-- content Starts -->

<div class="container-fluid" ><!-- container Starts -->






<div class="col-md-12" ><!-- col-md-12 Starts -->

<div class="services row"><!-- services row Starts -->

<?php

$get_store = "select * from store";

$run_store = mysqli_query($con,$get_store);

while($row_store = mysqli_fetch_array($run_store)){

$store_id = $row_store['store_id'];

$store_title = $row_store['store_title'];

$store_image = $row_store['store_image'];

$store_desc = $row_store['store_desc'];

$store_button = $row_store['store_button'];

$store_url = $row_store['store_url'];

?>

<div class="col-md-4 col-sm-6 box"><!-- col-md-4 col-sm-6 box Starts -->

<img src="admin_area/services_images/<?php echo $service_image; ?>" class="img-responsive">

<h2 align="center"> <?php echo $store_title; ?> </h2>

<p>
<?php echo $store_desc; ?>
</p>

<center>

<a href="<?php echo $store_url; ?>" class="btn btn-primary">



<?php } ?>

</div><!-- services row Ends -->

</div><!-- col-md-12 Ends -->



</div><!-- container Ends -->
</div><!-- content Ends -->



<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>
