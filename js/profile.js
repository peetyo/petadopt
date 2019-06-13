$('input#inpPassword').on('focusin', function(){
  $(this).attr('type', 'text');
})
$('input#inpPassword').on('focusout', function(){
  $(this).attr('type', 'password');
})
$('#frmUpdateUser').submit(function(e){
  e.preventDefault()
  $.ajax({
    url: "apis/api-update-user.php",
    method: "POST",
    data: $('#frmUpdateUser').serialize(),
    dataType: "JSON"
  }).always(function(jData){
    console.log(jData)
    if(jData.status == 0){
      $('p#pError').text(jData.message)
      $('p#pError').css('color', 'red')
      $('p#pError').css('opacity', '1')
    }else{
      $('p#pError').text(jData.message)
      $('p#pError').css('color', '#333')
      $('p#pError').css('opacity', '1')
    }
  })
})

$('#btnDeactivateUser').on('click', function(e){
  $.ajax({
    url: "apis/api-deactivate-user.php",
    dataType: "JSON"
  }).always(function(jData){
    console.log(jData)
    if(jData.status == 0){
      $('p#pError').text(jData.message)
      $('p#pError').css('color', 'red')
      $('p#pError').css('opacity', '1')
    }else{
      location.href = 'login.php';
    }
  })
})

$('#btnDeleteUser').on('click', function(e){
  $.ajax({
    url: "apis/api-delete-user.php",
    dataType: "JSON"
  }).always(function(jData){
    console.log(jData)
    if(jData.status == 0){
      $('p#pError').text(jData.message)
      $('p#pError').css('color', 'red')
      $('p#pError').css('opacity', '1')
    }else{
      location.href = 'signup.php';
    }
  })
})