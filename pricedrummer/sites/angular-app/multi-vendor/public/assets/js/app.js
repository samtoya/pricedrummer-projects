$(function () {

  // Setting page
    $.uploadPreview({
        input_field: "#logo-image",   // Default: #main-image
        preview_box: "#logo-preview",  // Default: .image-preview
        label_field: "#logo-label",    // Default: .image-label
        // label_default: "Choose File",   // Default: Choose File
        label_selected: '<i class="fa fa-image fa-3x"></i> Change Logo',  // Default: Change File
        // no_label: false                 // Default: false
    });

  // Close button for image listing page
  $('.image-wrapper > input[type="file"]').on('change', function() {
     $(this).siblings('img.img-close').removeClass('hidden');
  });
  // Close button for listing page
  $("img.img-close").on('click', function() {
      btn = $(this);
      content = '<i class="fa fa-image fa-3x"></i> Upload an image';
      var imagePreview = $(this).parent();
      var label = $(this).siblings('label.input-label');
      if ( imagePreview.css('background-image') ) {
          imagePreview.css('background-image', '');
          btn.addClass('hidden');
          label.html(content);
        }
        document.getElementById("main-image").value = "";
    });

  // Image Preview for listing page
  $.uploadPreview({
      input_field: "#main-image",   // Default: #main-image
      preview_box: "#main-preview",  // Default: .image-preview
      label_field: "#main-label",    // Default: .image-label
      // label_default: "Choose File",   // Default: Choose File
      label_selected: '<i class="fa fa-image fa-3x"></i> Change Image',  // Default: Change File
      // no_label: false                 // Default: false
  });
   $.uploadPreview({
      input_field: "#main-image-edit",   // Default: #main-image
      preview_box: "#main-preview-edit",  // Default: .image-preview
      label_field: "#main-label-edit",    // Default: .image-label
      // label_default: "Choose File",   // Default: Choose File
      label_selected: '<i class="fa fa-image fa-3x"></i> Change Image',  // Default: Change File
      // no_label: false                 // Default: false
  });
  
  $.uploadPreview({
      input_field: "#image-1",   // Default: #main-image
      preview_box: "#preview-1",  // Default: .image-preview
      label_field: "#label-1",    // Default: .image-label
      // label_default: "Choose File",   // Default: Choose File
      label_selected: '<i class="fa fa-image fa-3x"></i> Change Image',  // Default: Change File
      // no_label: false                 // Default: false
  });

  $.uploadPreview({
      input_field: "#image-2",   // Default: #main-image
      preview_box: "#preview-2",  // Default: .image-preview
      label_field: "#label-2",    // Default: .image-label
      // label_default: "Choose File",   // Default: Choose File
      label_selected: '<i class="fa fa-image fa-3x"></i> Change Image',  // Default: Change File
      // no_label: false                 // Default: false
  });

  $.uploadPreview({
      input_field: "#image-3",   // Default: #main-image
      preview_box: "#preview-3",  // Default: .image-preview
      label_field: "#label-3",    // Default: .image-label
      // label_default: "Choose File",   // Default: Choose File
      label_selected: '<i class="fa fa-image fa-3x"></i> Change Image',  // Default: Change File
      // no_label: false                 // Default: false
  });



    var allNextBtn, allWells, lev2_container, lev3_container, lev4_container, navListItems;
    navListItems = $('div.setup-panel div a');
    allWells = $('.setup-content');
    allNextBtn = $('.nextBtn');
    allWells.show();
    navListItems.click(function (e) {
        var $item, $target;
        e.preventDefault();
        $target = $($(this).attr('href'));
        $item = $(this);
        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });
    allNextBtn.click(function () {
        var curInputs, curStep, curStepBtn, i, isValid, nextStepWizard;
        curStep = $(this).closest('.setup-content');
        curStepBtn = curStep.attr('id');
        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children('a');
        curInputs = curStep.find('input[type=\'text\'],input[type=\'url\']');
        isValid = true;
        $('.form-input-wrapper').removeClass('has-error');
        i = 0;
        while (i < curInputs.length) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest('.form-group').addClass('has-error');
            }
            i++;
            if (isValid) {
                nextStepWizard.removeAttr('disabled').trigger('click');
            }
        }
    });
    $('div.setup-panel div a.btn-primary').trigger('click');

    // Registration URL
    // Hidden by default

    $('#website-wrapper').css('display', 'none');
    $('#website').click(function (event) {
        console.log('#website');
    });
    AmCharts.makeChart('mapdiv', {
        'type': 'map',
        'dataProvider': {
            'map': 'ghanaHigh',
            'getAreasFromMap': true
        },
        'areasSettings': {
            'autoZoom': false
        },
        'smallMap': false
    });
});


  
//================================================================================//
//================================ ADD PRODUCT PAGE =============================//
//==============================================================================//

(function () {
    lev2_container = $('#has-sub2');
    lev3_container = $('#has-sub3');
    lev4_container = $('#has-sub4');
})();


var selected_level_1 = '';
var selected_level_2 = '';
var selected_level_3 = '';
var selected_level_4 = '';

var selected_level_1_name = '';
var selected_level_2_name = '';
var selected_level_3_name = '';
var selected_level_4_name = '';

var selected_category_List =[];
var selected_category_List_name =[];

function setLevel2(level1,levelName,LevelID) {
    var level2s = $(level1).siblings('div.has-sub');

    if ($(lev2_container).parent().is(':hidden')) {
        $(lev2_container).parent().removeClass('hidden');
    }

    $(lev2_container).html("");
    $(lev3_container).html("");
    $(lev4_container).html("");
    $(level2s).clone().appendTo(lev2_container);


    selected_level_1 = level1;
    selected_level_2 = "";
    selected_level_3 = "";
    selected_level_4 = "";

    selected_level_1_name = $(level1).text().trim().replace(/,/g , "__COMMA__") // Replace `,` by some unique string;
    selected_level_2_name = '';
    selected_level_3_name = '';
    selected_level_4_name = '';

    selected_category_List =[];
    selected_category_List.push(selected_level_1);

    selected_category_List_name =[];
    selected_category_List_name.push(selected_level_1_name);
    $("#category_drill").val(selected_category_List_name.toString());
    //set html5 session to savetemp data for after pageload
    sessionStorage.setItem('selected_category_List', selected_category_List);

    ShowCategores();
}



function setLevel3(level2,levelName,LevelID) {
   var level3s = $(level2).siblings('div.has-sub');

   if ($(lev3_container).parent().is(':hidden')) {
    $(lev3_container).parent().removeClass('hidden');
}

$(lev3_container).html("");
$(lev4_container).html("");
$(level3s).clone().appendTo(lev3_container);

selected_level_2 = level2;
selected_level_3 = "";
selected_level_4 = "";

selected_level_2_name = $(level2).text().trim().replace(/,/g , "__COMMA__") // Replace `,` by some unique string;
selected_level_3_name = '';
selected_level_4_name = '';

selected_category_List =[];
selected_category_List.push(selected_level_1);
selected_category_List.push(selected_level_2);

selected_category_List_name =[];
selected_category_List_name.push(selected_level_1_name);
selected_category_List_name.push(selected_level_2_name);
$("#category_drill").val(selected_category_List_name.toString());
ShowCategores();
}




function setLevel4(level3,levelName,LevelID) {
 var level4s = $(level3).siblings('div.has-sub');

 if ($(lev4_container).parent().is(':hidden')) {
    $(lev4_container).parent().removeClass('hidden');
}

$(lev4_container).html("");
$(level4s).clone().appendTo(lev4_container);

selected_level_3 = level3;
selected_level_4 = "";

selected_level_3_name = $(level3).text().trim().replace(/,/g , "__COMMA__") // Replace `,` by some unique string;
selected_level_4_name = '';

selected_category_List =[];
selected_category_List.push(selected_level_1);
selected_category_List.push(selected_level_2);
selected_category_List.push(selected_level_3);

selected_category_List_name =[];
selected_category_List_name.push(selected_level_1_name);
selected_category_List_name.push(selected_level_2_name);
selected_category_List_name.push(selected_level_3_name);
$("#category_drill").val(selected_category_List_name.toString());
ShowCategores();
}


function ShowForm(category_id,levelName,category_level){
    var AddProductForm = $('#AddProductForm');
    var CategoriesSelection = $('#CategoriesSelection');
    var SelectedCategory = $('#SelectedCategory');


    if(category_level == 3){

        selected_level_3 = levelName;
        selected_level_4 = "";

        selected_level_3_name = $(levelName).text().trim().replace(/,/g , "__COMMA__") // Replace `,` by some unique string;
        selected_level_4_name = '';

        selected_category_List =[];
        selected_category_List.push(selected_level_1);
        selected_category_List.push(selected_level_2);
        selected_category_List.push(selected_level_3);

        selected_category_List_name =[];
        selected_category_List_name.push(selected_level_1_name);
        selected_category_List_name.push(selected_level_2_name);
        selected_category_List_name.push(selected_level_3_name);
        $("#category_drill").val(selected_category_List_name.toString());

        GenerateCatLinks(selected_category_List);

    }else if(category_level == 4){

        selected_level_4 = levelName;

        selected_level_4_name = $(levelName).text().trim().replace(/,/g , "__COMMA__") // Replace `,` by some unique string;

        selected_category_List =[];
        selected_category_List.push(selected_level_1);
        selected_category_List.push(selected_level_2);
        selected_category_List.push(selected_level_3);
        selected_category_List.push(selected_level_4);

        selected_category_List_name =[];
        selected_category_List_name.push(selected_level_1_name);
        selected_category_List_name.push(selected_level_2_name);
        selected_category_List_name.push(selected_level_3_name);
        selected_category_List_name.push(selected_level_4_name);
        $("#category_drill").val(selected_category_List_name.toString());

        GenerateCatLinks(selected_category_List);
    }

    AddProductForm.removeClass('hidden');
    CategoriesSelection.addClass('hidden');
    SelectedCategory.val(category_id);

}



function ShowCategores(){
    var AddProductForm = $('#AddProductForm');
    var CategoriesSelection = $('#CategoriesSelection');

    CategoriesSelection.removeClass('hidden');
    AddProductForm.addClass('hidden');
}



function GenerateCatLinks(selected_category_List){

    var Last_Category_Position = selected_category_List.length-1;

    $('#Category_Links').html("");
    $.each( selected_category_List, function( key, value) {


        if(Last_Category_Position == key){
            //remove link if its the last selected category
            $('#Category_Links').append("<span> "+$(value).text()+"</span> &rarr;");
        }else{
            //add link if its not the last category in the list
            $('#Category_Links').append("<a href='javascript:void(0);' onclick='$(selected_level_"+(key+1)+").click()'> "+$(value).text()+"</a> &rarr;");
        }
    });
    $('#Category_Links').append('<a href="javascript:void(0);" onclick="ShowCategores();"> Change</a>');
}



function Re_GenerateCatLinks(){
  var Category_drill = $('#category_drill').val();
  categories = Category_drill.split(',');

  $.each( categories, function( key, value) {
    var val = value.replace(/__COMMA__/g, ','); // Replace the string by `,`
    if(key==0){
      $( "#Categories_level_1" ).children('li').children("a.l1:contains('"+val.trim()+"')").filter(function() {
        return $(this).text().trim() === val.trim();
      }).click(); 
    }
    if(key==1){
      $( "#has-sub2 > .has-sub > #Categories_level_2").children('li').children("a.l2:contains('"+val.trim()+"')").filter(function() {
        return $(this).text().trim() === val.trim();
      }).click();
    }
    if(key==2){
      $( "#has-sub3 > .has-sub > #Categories_level_3" ).children('li').children("a.l3:contains('"+val.trim()+"')").filter(function() {
        return $(this).text().trim() === val.trim();
      }).click();
    }
    if(key==3){
      $( "#has-sub4 > .has-sub > #Categories_level_4" ).children('li').children("a.l4:contains('"+val.trim()+"')").filter(function() {
        return $(this).text().trim() === val.trim();
      }).click();
    }
  });

   GenerateCatLinks(selected_category_List);
};


$( document ).ready(function() {
    

     //form submit handler
    $('#Retailer_Products_Form').submit(function (e) {
      var isFormValid = true;
      var isFormImageValid = true;
        //check atleat 1 checkbox is checked
        if ($('#main-image').get(0).files.length === 0) {
          // e.preventDefault();
           //isFormImageValid = false;
        }
        //Check all the required fields for validity
        $(".required").each(function(){
          if ($.trim($(this).val()).length == 0){
            console.log($.trim($(this).val()).length);
              $(this).addClass("highlight");
              isFormValid = false;
          }
          else{
              $(this).removeClass("highlight");
          }
        });

        if (!isFormValid) {
          alert("Please fill in all the required fields (indicated by *) AND Upload the main image.");
          $('html,body').animate({scrollTop:0},200);
           e.preventDefault();
        }else if(!isFormValid ){
          alert("Please fill in all the required fields (indicated by *)");
          $('html,body').animate({scrollTop:0},200);
           e.preventDefault();
        }else if(!isFormImageValid ){
          // alert("Please Select the Main Image.");
          // $('html, body').animate({
          //     scrollTop: $("#Retailer_Products_Form").offset().top
          //   }, 200);
          // e.preventDefault();
        }
        return isFormValid;
// if (!isFormValid && !isFormImageValid) {
//           alert("Please fill in all the required fields (indicated by *) AND Upload the main image.");
//           $('html,body').animate({scrollTop:0},200);
//            e.preventDefault();
//         }else if(!isFormValid ){
//           alert("Please fill in all the required fields (indicated by *)");
//           $('html,body').animate({scrollTop:0},200);
//            e.preventDefault();
//         }else if(!isFormImageValid ){
//           alert("Please Select the Main Image.");
//           $('html, body').animate({
//               scrollTop: $("#Retailer_Products_Form").offset().top
//             }, 200);
//           e.preventDefault();
//         }
//         return isFormValid;

    })
});
//prevent inputs from submiting the form when the user press enter
$(document).on("keypress", ":input:not(textarea)", function(event) {
  if (event.keyCode == 13) {
    event.preventDefault();
  }
});


function numberOnly(ele){
  $(ele).keydown(function (event) {
    if ((event.keyCode >= 48 && event.keyCode <= 57) || 
    (event.keyCode >= 96 && event.keyCode <= 105) || 
    event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
    event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190|| event.keyCode == 110) {
      } else {
      event.preventDefault();
    }
    if(($(ele).val().indexOf('.') !== -1 && event.keyCode == 190) || ($(ele).val().indexOf('.') !== -1 && event.keyCode == 110))
    event.preventDefault(); 
    //if a decimal has been added, disable the "."-button
    
  });
}