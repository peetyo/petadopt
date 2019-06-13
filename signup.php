<?php
  $sTitle = 'PetAdopt : : signup';
  $sCss = 'signup.css';
  require_once './components/top.php';
?>

<div class="container">
  
  <div></div>
  <div class="top">
    <h1>PetAdopt</h1>
  </div>

  <div class="content">
    <form id="frmSignup">
      <h2>Signup</h2>
      <p id="pError">Please fill in the form correctly</p>
      <input name="email" class="mt10" type="text" value="x@x.com" placeholder="email *">
      <div id="nameInput">
      <input name="name" class="mt10" type="text" value="xx" placeholder="name ( 2-20 ) *">
      <input name="lastName" class="mt10" type="text" value="yy" placeholder="last name ( 2-20 ) *">
      </div>
      <input name="address" class="mt10" type="text" value="xx street 5" placeholder="address *">
      <div id="addressInput">
        <input name="region" class="mt10" type="text" value="Copenhagen" placeholder="region *">
        <input name="postcode" class="mt10" type="number" value="2200" placeholder="postcode *">
      </div>
      <input name="number1" class="mt10" type="number" value="87654321" placeholder="phone number ( +45 )">
      <input name="password" class="mt10" type="password" value="123456" placeholder="password ( 6 to 20 characters ) *">
      <input name="confirmPassword" class="mt10" type="password" value="123456" placeholder="confirm password *">
      <button id="btnSignup" type="submit" class="ok mt10">signup</button>
      <p id="pSwitchSignupLogin" class="mt10">Already registered? <a href='login.php'>Login!</a></p>

    </form>
  </div>

</div>

<?php
  $sScript = 'signup.js';
  require_once './components/bottom.php';