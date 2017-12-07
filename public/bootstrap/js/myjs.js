var postId = 0;
var eventId = 0;
var postBodyElement = null;

$('.post').find('.interaction').find('.edit').on('click', function(event){
	event.preventDefault();

	postBodyElement = event.target.parentNode.parentNode.childNodes[1];
	var postBody = postBodyElement.textContent;
	postId= event.target.parentNode.parentNode.dataset['postid'];
	$('#post-body').val(postBody);
	$('#editModal').modal();
});

$('#modal-save').on('click', function(){
	$.ajax({
		method: 'POST',
		url: urlEdit,
		data: {body: $('#post-body').val(), postId: postId, _token: token}
	})
	.done(function (msg){
		$(postBodyElement).text(msg['new_body']);
		$('#editModal').modal('hide');
	});
});


$('.like').on('click',function(event){
	event.preventDefault();
	postId= event.target.parentNode.parentNode.dataset['postid'];
	var isLike = event.target.previousElementSibling == null;
	$.ajax({
		method: 'POST',
		url: urlLike,
		data: {isLike: isLike, postId: postId, _token: token}
	})
	.done(function(){
		event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You Like This Post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t Like this Post': 'Dislike';
		if(isLike){
			event.target.nextElementSibling.innerText = 'Dislike';
		}else{ 
			event.target.previousElementSibling.innerText = 'Like';
		}		
	});
});


 $(document).ready(function(){
    $('.modal').on('show.bs.modal', function () {
      if ($(document).height() > $(window).height()) {
        // no-scroll
        $('body').addClass("modal-open-noscroll");
      }
      else { 
        $('body').removeClass("modal-open-noscroll");
      }
    })
    $('.modal').on('hide.bs.modal', function () {
        $('body').removeClass("modal-open-noscroll");
    })
  })

  ///////////////////END MODAL /////////

$('.response').on('click', function(event){
	event.preventDefault();
 	eventId = event.target.parentNode.parentNode.dataset['eventid'];
 	var isResponse = event.target.previousElementSibling == null;
	$.ajax({
		method: 'POST',
		url: urlResponse,
		data: {isResponse: isResponse, eventId: eventId, _token: token}
	});
/*	.done(function(){
		event.target.innerText = eventId ? event.target.innerText == 'Go' ? 'You Go' : 'Go' : event.target.innerText == 'Can\'tGo' ? 'You can\'t Go': 'Can\'t Go';
		if(isResponse){
			event.target.nextElementSibling.innerText = 'You Go';
		}else{ 
			event.target.previousElementSibling.innerText = 'You can\'t Go';
		}		
	});*/
});

