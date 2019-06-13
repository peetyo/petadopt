$('#frmCreateListing').submit(function(e){
  e.preventDefault()
  $.ajax({
    url: "apis/api-create-listing.php",
    method: "POST",
    data: new FormData(this),
    dataType: "JSON",
    contentType: false,
    cache: false,
    processData:false,
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