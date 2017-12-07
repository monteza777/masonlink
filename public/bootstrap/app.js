$(function(){
$('.post').find('.interaction').find('.edit-post').on('click', function(event){
//event.preventDefault();
var postBody=event.target.parentNode.parentNode.childNodes[1].textContent;
//var postID=$("#postId").val();
    
$("#post-body").val(postBody);
//alert(postBody);
  $("#edit-modal").modal();
    
});
    
    
    
//$('#modal-save').on('click', function(){
    //$.ajax({
       // method:'POST',
       // url:url,
        //data:{ body:$("#post-body").val(), //postId: '', _token=token}
        
   // });
    

    
//});
    
    
    });