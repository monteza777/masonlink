function confirmDelete(){
	var result = confirm('Are you sure you want to Delete this Item?');

	if(result){
		return true;
	}else{
		return false;
	}
}