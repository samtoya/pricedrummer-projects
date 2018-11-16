
Category_check_message = '';
Category_check_message_number = 0;


function Check_Categories(){
	
	if ($('#lev2 option').length > 2 && $('#lev2').val() == null) {
		Category_check_message = Category_check_message + "Please Select A Category Level 2 \n";
		Category_check_message_number++;
		}else if($('#lev3 option').length > 2 && $('#lev3').val() == null){
		Category_check_message = Category_check_message + "Please Select A Category Level 3 \n";
		Category_check_message_number++;
		}else if($('#lev4 option').length > 2 && $('#lev4').val() == null){
		Category_check_message = Category_check_message + "Please Select A Category Level 4 \n";
		Category_check_message_number++;
	}
	
	if(Category_check_message_number == 0){
		//submit the form if there are no issues
		$( "#Product_Check_Form" )[0].submit();
		}else{
		alert(Category_check_message);
		DontSubmitForm();
		Category_check_message = '';
		Category_check_message_number = 0;
	}
	
	
}

//PREVENT FORM FROM SUBMITTING 
function DontSubmitForm(){
	var dontSubmit = function(event) { 
		event.preventDefault();
		//console.log("the links, they do nothing!");
	}
	$( "#Product_Check_Form" ).bind('submit', dontSubmit);
	
};
