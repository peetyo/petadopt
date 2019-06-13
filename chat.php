<?php
  $sTitle = 'PetAdopt : : LiveChat';
  $sCss = 'chat.css';
  require_once './components/top.php';

  session_start();
  if(!isset($_SESSION['aUser'])){
    header('Location: login.php ');
  }
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
    <div id="chatContainer">
      <div id="userList">
        <h3>User List</h3>
        <?php
          require_once 'mariadb.php';
          try{
            $sQuery = $mariadb->prepare('SELECT * FROM users ORDER BY name');
            $sQuery->execute(); 
            $aUsers = $sQuery->fetchAll();
            foreach($aUsers as $aUser){
              if($_SESSION['aUser']['id']!==$aUser['id']){
                echo "<div class='user' data-id='".$aUser['id']."' data-name='".$aUser['name']."' data-lastName='".$aUser['lastName']."'>".$aUser['name']." ".$aUser['lastName']."</div>"; 
              }
            };
          }catch(PDOException $ex){
              echo "Sorry, system is updating ...";
            }
        ?>
      </div>
      <div id="messageDisplay" data-recipientId="">
        <h3>Select recipient</h3>
        <div class="chatBox">
          <h4>User B BB</h4>
          <div class="conversation">

          </div>
          <div id="frmSendMessage">
            <input class="inpMessage" type="text">
            <input class="btnSendMessage" type="button" value="Send">
          </div>
        </div>
      </div>
    </div>
  </div>        

  <?php
  $sScript = 'chat.js';
  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/<?= $sScript ?>"></script>
  <?php
    if(isset($_GET['id'])){
    echo "<script>$('.user[data-id=".$_GET['id']."]').click()</script>";
    }
  ?>   
</body>
</html>