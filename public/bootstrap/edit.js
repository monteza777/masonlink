var postBody;
var postId;
var postBodyElement=null;
$(".btnupdate").click(function(event){
    event.preventDefault();
 postBodyElement=event.target.parentNode.parentNode.childNodes[1];
 postBody=  postBodyElement.textContent;  
 postId=event.target.parentNode.parentNode.dataset['postid'];
    
    $("#editmodal").modal();
    $("#post-body").val(postBody);
    
});
$('#formEdit').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: 'POST',
        url: url,
        data: {
            body: $('#post-body').val(),
            postId: postId
        },
        success: function(msg) {
           //postBody.text(msg['message']);
            console.log('success');
            $(postBodyElement).text(msg['new_body']);
            $('#editmodal').modal('toggle');
        }
    });

});
    
    
   



//$("#modal-save").click(function(){
    //$.ajax({
      //  headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')},
      //  method:'POST',
       // url:url,
       // data:{body:$('#post-body').val(), postId:postId, _token:token} 
    //})
    //alert(token);
 
//});