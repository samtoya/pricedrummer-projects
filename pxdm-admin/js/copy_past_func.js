





var SpecsCheck=0;
var specs_check_message = 'Please Check the following specs: \n';
var clean_specs='';
var clean_specs_table='';

specs_check_array_for_highlight =  new Array();


function Check_Product_Other_info(){
	var tokenizer = $('#specs_tokenizer').val().toString();
	var specs = $('#item_info').val();
	var specs_lines = specs.split("\n");
	//alert(specs_lines[0]);
	
	var loopCheck=1;
	var Category_section = '';
	$.each(specs_lines, function(index, value) {
		if(value != ""){//check if the specs value is not empty. this is to skip empty rows in the textarea
			if(!tokenizer.trim()){
				
				if(value.indexOf("===") >= 0){
					//if category sectioning identifier was found in the string, remove the identifier and set the Category_section
					Category_section = $.trim(value.replace("===", ""));
					}else{
					if (value.indexOf("\t") >= 0){
						//no problem with that line of specs string (and that line is a key value pair seperated by tab)
						clean_specs = clean_specs + Category_section + ' | ' + $.trim(value.replace(/\t/g, " | ")) + '\n';
						clean_specs_table = clean_specs_table +'<tr><td>'+ Category_section +'</td><td>'+ $.trim(value.replace(/\t/g, "</td><td>")) + '</td></tr>';
						}else{
						//spaces may be splited into single lines. so add the first one as specs key in the first loop then the second as value in the next loop
						if(loopCheck==1){
							clean_specs = clean_specs + Category_section + ' | ' + $.trim( value )+ " | ";
							clean_specs_table = clean_specs_table +'<tr><td>'+ Category_section + '</td><td>' + $.trim( value )+ "</td>";
							loopCheck++;
							}else if(loopCheck==2){
							clean_specs = clean_specs +  $.trim(value) + '\n';
							clean_specs_table = clean_specs_table +'<td>'+  $.trim(value) + '</td></tr>';
							//reset key value checker
							loopCheck=1;
						}
					}
				}
				
				
				}else{
				
				if(value.indexOf("===") >= 0){
					//if category sectioning identifier was found in the string, remove the identifier and set the Category_section
					Category_section = $.trim(value.replace("===", ""));
					}else{
					
					
					//check if the specs string contain another charactor as the seperator
					if (value.indexOf("\t") >= 0 || value.indexOf(tokenizer) >= 0){
						//no problem with that line of specs string 
						clean_specs = clean_specs + Category_section + ' | ' + $.trim(value.replace(tokenizer, " | ").replace(/\t/g, " | ")) + '\n';
						clean_specs_table = clean_specs_table +'<tr><td>'+ Category_section +'</td><td>'+ $.trim(value.replace(tokenizer, "</td><td>").replace(/\t/g, "</td><td>")) + '</td></tr>';
						}else{
						//spaces may be splited into single lines. so add the first one as specs key in the first loop then the second as value in the next loop
						if(loopCheck==1){
							clean_specs = clean_specs + Category_section + ' | ' + $.trim(value) + " | ";
							clean_specs_table = clean_specs_table +'<tr><td>'+ Category_section + '</td><td>' + $.trim(value) + "</td>";
							loopCheck++;
							}else if(loopCheck==2){
							clean_specs = clean_specs +  $.trim(value) + '\n';
							clean_specs_table = clean_specs_table +'<td>'+  $.trim(value) + '</td></tr>';
							//reset key value checker
							loopCheck=1;
						}
					}
				}
			}
		}
	});
	
	var clean_specs_lines = clean_specs.split("\n");
	$.each(clean_specs_lines, function(index, value) {
		//if more than 2 | is found in a specs line
		if ((value.match(/\|/ig) || []).length > 2){
			//there is a problem with the string so prompt the user
			SpecsCheck++
			specs_check_message = specs_check_message + value +"\n";
			specs_check_array_for_highlight.push(value);
		}
	});
	
	if(SpecsCheck > 0){
		alert(specs_check_message);
		$('#item_info_hidden').text(clean_specs);
		$('#ST').html(clean_specs_table);
		//reset the required holders
		/*
			$('#item_info_hidden').highlightTextarea({
			words: specs_check_array_for_highlight
			});
		*/
		specs_check_array_for_highlight =  new Array();
		SpecsCheck=0;
		specs_check_message = 'Please Check the following specs: \n';
		clean_specs = '';
		clean_specs_table = '';
		//change the color of the check button and textarea if there are issues
		$('#item_info_check_btn').removeClass('btn-success');
		$('#item_info_check_btn').addClass('btn-danger');
		$('#item_info').removeClass('valid-background');
		$('#item_info').addClass('invalid-background');
		
		}else{
		//alert("No Issues With Specs\n"+clean_specs);
		alert("No Issues With Specs\nBUT PLEASE REVIEW SPECS CAREFULLY!! \nThanks");
		//put the clean specs in the hidden textarea for processing
		$('#item_info_hidden').text(clean_specs);
		$('#ST').html(clean_specs_table);
		//change the color of the check button and textarea if there are no issues
		$('#item_info_check_btn').removeClass('btn-danger');
		$('#item_info_check_btn').addClass('btn-success');
		$('#item_info').removeClass('invalid-background');
		$('#item_info').addClass('valid-background');
		//reset the clean_specs holder
		clean_specs = '';
		clean_specs_table = '';
	}
	
	
}


