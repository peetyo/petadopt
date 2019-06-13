$('#frmSignup').submit(function(e){
  e.preventDefault()
  $.ajax({
    url: "apis/api-create-user.php",
    method: "POST",
    data: $('#frmSignup').serialize(),
    dataType: "JSON"
  }).always(function(jData){
    console.log(jData)
    if(jData.status == 0){
      $('p#pError').text(jData.message)
      $('p#pError').css('opacity', '1');
    }else{
      location.href = 'index.php';
    }
  })
})