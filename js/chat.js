var lastMessage;
$('.user').on('click',function(e){
  
  e.preventDefault()
  lastMessage = 0
  if(startCheckChanges){
    clearInterval(checkChanges)
  }

  var iRecipientId = $(this).attr('data-id')
  var sUserId = 'id'+iRecipientId
  var sName = $(this).attr('data-name')
  var sLastName = $(this).attr('data-lastName')
 
  $('#messageDisplay h3').remove()
  $('#messageDisplay .chatBox').css("display", "grid");
  $('#messageDisplay').attr('data-recipientId',iRecipientId);
  $('#messageDisplay .chatBox h4').text(sName+' '+sLastName)
  $('div.conversation').empty()

  $.ajax({
    url: "apis/api-load-chat.php",
    data: {id:iRecipientId
          },
    dataType: "JSON"
  }).always(function(jData){
    if(jData.status === 1){      
      for(var id in jData.messages){
        timestamp = id.split('-').pop();
        var onlyId = id.slice(0, id.indexOf('-'))
        if(onlyId != sUserId){
          $('div.conversation').append('<div class="currentUserMessage message" data-dateCreated="'+timestamp+'"><p>'+jData.messages[id]+'</p></div>')
        }else{
          $('div.conversation').append('<div class="otherUserMessage message" data-dateCreated="'+timestamp+'"><p>'+jData.messages[id]+'</p></div>')
        }
      }
      startCheckChanges(iRecipientId)
      return
    }
      $('div.conversation').append('<h4>'+jData.message+'</h4>')
      startCheckChanges(iRecipientId)
    })
})


var checkChanges;
function startCheckChanges(recipientID){
  sUserId ='id'+recipientID
  checkChanges = setInterval(function(){
    lastMessage = $('div.conversation div:last-child').attr('data-dateCreated')
    $.ajax({
      url: "apis/api-check-chat-changes.php",
      data: {id:recipientID,
             lastMessage:lastMessage
            },
      dataType: "JSON"
    }).always(function(jData){
      if(jData.status === 1){
        
        var timestamp;
        if(!jQuery.isEmptyObject(jData.messages)){
          console.log(jData.messages)
          console.log('recipientID: '+recipientID)
          for(var id in jData.messages){
            timestamp = id.split('-').pop();
            var onlyId = id.slice(0, id.indexOf('-'))
            if(onlyId != sUserId){
              $('div.conversation').append('<div class="currentUserMessage message" data-dateCreated="'+timestamp+'"><p>'+jData.messages[id]+'</p></div>')
            }else{
              $('div.conversation').append('<div class="otherUserMessage message" data-dateCreated="'+timestamp+'"><p>'+jData.messages[id]+'</p></div>')
            }
          }
        }
        return
      }
    })
  }, 1000);
}

  $('#messageDisplay').on('click','.btnSendMessage', function(e){
  
    var iRecipientId = $(this).parent().parent().parent().attr('data-recipientId')
    var sMessage = $('.inpMessage').val()

    $.ajax({
      url: "apis/api-send-message.php",
      method: "POST",
      data: {id:iRecipientId,
             message:sMessage
      },
      dataType: "JSON"
    }).always(function(jData){
      console.log(jData)
      $('div.conversation h4').remove()
      $('.inpMessage').val('')
    })

  })