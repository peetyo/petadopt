var listingTemplate;
$( document ).ready(function() {
  $.ajax({
    url: "apis/api-read-listings.php",
    data: {},
    dataType: "JSON"
  }).always(function(jData){
    if(jData.status == 0){
      console.log(jData.message)
      return
    }
    var iCurrentUserId = jData.currentUserId
    jData.data.forEach(function(listing) {
      var iId = listing.id
      var iUserId = listing.user_id
      var sTitle = listing.title
      var sDescription = listing.description
      var sImage = listing.image
      var sName = listing.name
      var sLastName = listing.lastName
      var sAddress = listing.address
      var sRegion = listing.region
      var iPostcode = listing.postcode
      var iNumber = listing.number

      listingTemplate =  `
      <div id="1" class="listing" data-id="${iId}" data-user_id="${iUserId}">
        <input class="listingTitle" type="text" value="${sTitle}" placeholder="title" disabled>
        <img src="images/${sImage}" alt="">
        <h3>Description</h3>
        <textarea spellcheck="false" name="" class="listingDescription" placeholder="description" disabled>${sDescription}</textarea>
        <h4>Contact information:</h4>
        <div>${sName} ${sLastName}</div>
        ${iNumber? `<div>+45 ${iNumber}</div> <div>${sAddress}, ${sRegion}, ${iPostcode}</div>`: `<div>${sAddress}, ${sRegion}, ${iPostcode}</div><br>`}
        
        ${iUserId == iCurrentUserId ? '<button class="btnEditListing" type="button">Edit</button> <button class="btnDeleteListing" type="button">Delete</button>' : '<button class="btnGetInTouch" type="button">Get in Touch</button>'}
        
      </div>`

      $('#listingsContainer').append( listingTemplate );
    });
  })
});
$(document).on('click','.btnEditListing', function(){
  if($(this).text() == 'Edit'){
    $('.btnEditListing').text('Edit')
  }
  $('.listingTitle').prop('disabled', true)
  $('.listingDescription').prop('disabled', true)
  if($(this).text() == 'Edit'){
    var iUserId = $(this).parent().attr('data-user_id')
    console.log(iUserId)
    $(this).siblings('.listingTitle').prop('disabled', false)
    $(this).siblings('.listingDescription').prop('disabled', false)
    $(this).text('Save Changes')
  }else{
    var iId = $(this).parent().attr('data-id')
    var iUserId = $(this).parent().attr('data-user_id')
    var sTitle = $(this).siblings('.listingTitle').val()
    var sDescription = $(this).siblings('.listingDescription').val()

    $.ajax({
      url: "apis/api-update-listing.php",
      method: "POST",
      data: {id:iId,userId:iUserId,title:sTitle,description:sDescription},
      dataType: "JSON"
    }).always(function(jData){
      console.log(jData)
    })

    $(this).siblings('.listingTitle').prop('disabled', true)
    $(this).siblings('.listingDescription').prop('disabled', true)
    $(this).text('Edit')
  }
  
})

$(document).on('click','.btnDeleteListing', function(){
  console.log('Delete Listing')
  var iId = $(this).parent().attr('data-id')
  var parent = $(this).parent()
  console.log(iId)
  
  $.ajax({
    url: "apis/api-delete-listing.php",
    data: {id:iId},
    dataType: "JSON"
  }).always(function(jData){
    console.log(jData)
    if(jData.status === 1){
      parent.remove()
      return
    }

  })
})
$(document).on('click','.btnGetInTouch', function(){
  var iId = $(this).parent().attr('data-user_id')
  console.log(iId)
  window.open(
    'chat.php?id='+iId,
    '_blank'
  );
})