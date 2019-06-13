<?php

  session_start();
  if(isset($_SESSION['aUser'])){
    header('Location: index.php');
  }

  $sTitle = 'PetAdopt : : login';
  $sCss = 'login.css';
  require_once './components/top.php';
?>

<div class="container">
  <div></div>
  <div class="top">
    <h1>PetAdopt</h1>
  </div>

  <div class="content">
    <form id="frmLogin">
      <h2>Login</h2>
      
      <div class="boxInput">
        <div id="invalidEmail" class="invalid">invalid email</div>
        <input id="txtEmail" name="email" class="mt10" type="text" value="a@a.com" placeholder="email">
      </div>
   
      <div class="boxInput">
      <div id="invalidPassword" class="invalid">invalid password</div>
        <input id="txtPassword" name="password" class="mt10" type="password" value="123456" placeholder="password" maxlength="20">
      </div>
      
      <button id="btnLogin" type="submit" class="ok mt10">login</button>
      <p id="pSwitchSignupLogin" class="mt10">Not registered? <a href='signup.php'>Sign up!</a></p>
    </form>
  </div>


</div>

<?php
  $sScript = 'login.js';
  require_once './components/bottom.php';