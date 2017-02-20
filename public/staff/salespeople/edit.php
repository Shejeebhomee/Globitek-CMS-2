<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$salespeople_result = find_salesperson_by_id($_GET['id']);
// No loop, only one result
$salesperson = db_fetch_assoc($salespeople_result);



// Set default values for all variables the page needs.
$errors = array();
if(is_post_request()) {
  echo "was a post request";
  $salesperson_original = $salesperson;
  // Confirm that values are present before accessing them.
  if(isset($_POST['first_name'])) { $salesperson['first_name'] = $_POST['first_name']; }
  if(isset($_POST['last_name'])) { $salesperson['last_name'] = $_POST['last_name']; }
  if(isset($_POST['phone'])) { $salesperson['phone'] = $_POST['phone']; }
  if(isset($_POST['email'])) { $salesperson['email'] = $_POST['email']; }
  $result = update_salesperson($salesperson);
  if($result === true) {
    redirect_to('show.php?id=' . u($salesperson['id']));
  } else {
    $errors = $result;
    $salesperson = $salesperson_original;
  }
}



?>
<?php $page_title = 'Staff: Edit Salesperson ' . $salesperson['first_name'] . " " . $salesperson['last_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />

  <h1>Edit Salesperson: <?php echo $salesperson['first_name'] . " " . $salesperson['last_name']; ?></h1>

  <!-- TODO add form -->

  <?php echo display_errors($errors); ?>

  <form action="edit.php" method="post">
    First name:<br />
    <input type="text" name="first_name" value="<?php echo h($salesperson['first_name']); ?>" /><br />
    Last name:<br />
    <input type="text" name="last_name" value="<?php echo h($salesperson['last_name']); ?>" /><br />
    Phone:<br />
    <input type="text" name="phone" value="<?php echo h($salesperson['phone']); ?>" /><br />
    Email:<br />
    <input type="text" name="email" value="<?php echo h($salesperson['email']); ?>" /><br />
    <br />
    <input type="submit" name="submit" value="Update"  />
  </form>

  <br />
  <?php  echo "<a href=show.php?id=".u($salesperson['id'])."> Cancel</a>;" 
  ?>


</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
