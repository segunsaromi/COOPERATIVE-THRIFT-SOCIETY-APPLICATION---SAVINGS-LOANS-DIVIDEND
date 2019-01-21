
$(document).ready(function() {
  $("#state").change(function(){            
         var state = $(this).val(); 
		

	
switch (state) {
  case "Technology":
  var data = ['Select School...', 'Computer Science', 'Food Technology', 'Hospitality Management']; 
   break;
 
 case "Science":
  var data = ['Select School...', 'Science Laboratory Technology', 'Statistics', 'Microbiology', 'Mathematics'];
   break;
    case "Engineering":
  var data = ['Select School...', 'Computer Engineering', 'Industrial Maintenance Engineering', 'Electrical Engineering', 'Civil Engineering', 'Mechanical Engineering','Metallurgical Engineering'];
   break;
   case "Environmental Studies":
  var data = ['Select School...', 'Quantity Surveying', 'Building Technology', 'Estate Management and Valuation', 'Surveying & Geoinformatics', 'Architecture','Urban and Regional Planning'];
   break;
   
   case "Management and Business Studies":
  var data = ['Select School...', 'Accounting', 'Business Admin', 'Marketing', 'Public Administration', 'Office Technology and Management', 'Banking and Finance'];
   break;
    case "Art, Design and Printing":
  var data = ['Select School...', 'Polymer & Textile Technology', 'Printing', 'Fine Art', 'Graphics', 'Industrial Design'];

   break;
   
   case "Liberal Studies":
  var data = ['Select School...', 'Mass Communication', 'Languages'];
 
 }
	
	


var i;
var html = [];
//loop through the array
for (var i = 0; i < data.length; i++) {//begin for loop

  //add the option elements to the html array
  html.push("<option>" + data[i] + "</option>")

}//end for loop

//add the option values to the select list with an id of lga
document.getElementById("lga").innerHTML = html.join('');

});

});

