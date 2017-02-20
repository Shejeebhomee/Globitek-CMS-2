<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$states_result = find_state_by_id($_GET['id']);
// No loop, only one result
$state = db_fetch_assoc($states_result);



$errors = array();
if(is_post_request()) {
  $state_original = $state;
  // Confirm that values are present before accessing them.
  if(isset($_POST['name'])) { $state['name'] = $_POST['name']; }
  if(isset($_POST['code'])) { $state['code'] = $_POST['code']; }
  $result = update_state($state);
  if($result === true) {
    redirect_to('show.php?id=' . u($state['id']));
  } else {
    $errors = $result;
    $state = $state_original;
  }
}


?>
<?php $page_title = 'Staff: Edit State ' . $state['name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="show.php">Back to States List</a><br />

  <h1>Edit State: <?php echo $state['name']; ?></h1>

  <!-- TODO add form -->


 <form action="edit.php?id=<?php echo u($state['id']); ?>" method="post">
    Name:<br />
    <input type="text" name="name" value="<?php echo h($state['name']); ?>" /><br />
    Code:<br />
    <input type="text" name="code" value="<?php echo h($state['code']); ?>" /><br />
    <br />
    <input type="submit" name="submit" value="Update"  />
  </form>

  <br />
  <a href="show.php?id=<?php echo u($state['id']); ?>">Cancel</a>


</div>

<?php include(SHARED_PATH . '/footer.php'); ?>