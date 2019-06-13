<?php
  session_start();
  if(!isset($_SESSION['aUser'])){
    header('Location: login.php ');
  }

  $sTitle = 'PetAdopt : : My Profile';
  $sCss = 'signup.css';
  require_once './components/top.php';
?>

<div class="container">
  
  <div></div>
  <div class="top">
    <h1>PetAdopt</h1>
    <nav id="topNav">
      <a href="index.php">Adopt</a>
      <a href="chat.php">LiveChat</a>
      <a href="profile.php">My Profile</a>
      <a href="create-listing.php"><button id="btnCreateListing">Create Listing</button></a>
      <a href="apis/api-logout.php">Logout</a>
    </nav>
  </div>

  <div class="content">
    <form id="frmUpdateUser" data-user="<?php echo $_SESSION['aUser']['id'];?>">
      <h2>My Profile</h2>
      <p id="pError">Please fill in the form correctly</p>
      <input name="email" class="mt10" type="text" value="<?php echo $_SESSION['aUser']['email'];?>" placeholder="email *">
      <div id="nameInput">
      <input name="name" class="mt10" type="text" value="<?php echo $_SESSION['aUser']['name'];?>" placeholder="name ( 2-20 ) *">
      <input name="lastName" class="mt10" type="text" value="<?php echo $_SESSION['aUser']['lastName'];?>" placeholder="last name ( 2-20 ) *">
      </div>
      <input name="address" class="mt10" type="text" value="<?php echo $_SESSION['aUser']['address'];?>" placeholder="address *">
      <div id="addressInput">
        <input name="region" class="mt10" type="text" value="<?php echo $_SESSION['aUser']['region'];?>" placeholder="region *">
        <input name="postcode" class="mt10" type="number" value="<?php echo $_SESSION['aUser']['postcode'];?>" placeholder="postcode *">
      </div>
      <input id="inpPassword" name="password" class="mt10" type="password" value="123456" placeholder="password ( 6 to 20 characters ) *">
      <button id="btnUpdateUser" type="submit" class="ok mt10">Save Changes</button>
      <button id="btnDeactivateUser" type="button" class="ok mt10">Deactivate Profile</button>
      <p id="btnDeleteUser" class="mt10">Delete Profile</p>

    </form>
  </div>

</div>

<?php
  $sScript = 'profile.js';
  require_once './components/bottom.php';