<?php
require_once('../../../private/initialize.php');
$errors = array();
$state = array(
  'name' => '',
  'code' => '',
  'state_id' => ''
);
// Get associated Country ID from URL parameter
if(isset($_GET['state_id'])) { $state['state_id'] = $_GET['state_id']; }
if(is_post_request()) {
  // Confirm that values are present before accessing them.
  if(isset($_POST['name'])) { $state['name'] = $_POST['name']; }
  if(isset($_POST['code'])) { $state['code'] = $_POST['code']; }
  $result = insert_state($state);
  if($result === true) {
    $new_id = db_insert_id($db);
    redirect_to('show.php?id=' . u($new_id));
  } else {
    $errors = $result;
  }
}
?>
<?php $page_title = 'Staff: New State'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../states/show.php?id=<?php echo u($state['country_id']); ?>">Back to States List</a><br />

  <h1>New State</h1>

  <!-- TODO add form -->


<?php echo display_errors($errors); ?>

  <form action="new.php?state_id=<?php echo u($state['state_id']); ?>" method="post">
    Name:<br />
    <input type="text" name="name" value="<?php echo h($state['name']); ?>" /><br />
    Code:<br />
    <input type="text" name="code" value="<?php echo h($state['code']); ?>" /><br />
    <br />
    <input type="submit" name="submit" value="Create"  />
  </form>


</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
