<?php
  $sTitle = 'PetAdopt : : create listing';
  $sCss = 'create-listing.css';
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
    <div class="listing" >
          <h2>New Listing</h2>
          <p id="pError">Please fill in the form correctly</p>
          <form id="frmCreateListing" enctype="multipart/form-data">
          <input name="title" class="listingTitle" type="text" value="Cute Pet" placeholder="title ( 2 - 30 )">
          <input name="animalType" class="" type="text" value="dog" placeholder="kind of animal (2 - 20)">
          <input name="image" class="inpFile" type="file" accept="image/*" >
          <textarea name="description" class="listingDescription" placeholder="description ( 10 - 600 )">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec consequat augue ac justo interdum</textarea>
          <button id="btnInsertListing" type="submit">Create Listing</button>
          </form>
        </div>
  </div>

</div>

<?php
  $sScript = 'create-listing.js';
  require_once './components/bottom.php';