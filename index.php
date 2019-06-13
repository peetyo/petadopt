<?php
  $sTitle = 'PetAdopt : : home';
  $sCss = 'home.css';
  require_once './components/top.php';

  session_start();
  if(!isset($_SESSION['aUser'])){
    header('Location: login.php ');
  }
?>

<div class="containerHome">
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
      <h2 id="subtitle">Animals Looking for a New Home</h2>
      <div id="listingsContainer">
        
      </div>
  </div>

</div>

<?php
  $sScript = 'home.js';
  require_once './components/bottom.php';