var mydata;
//alert("here");
function getData()
{ 
$.ajax({
     type: 'GET',  
     url:  'http://localhost/Prototype/getDataBasedOnIp.php',
     dataType: 'json',
		 success: function(output){
     mydata = output;
     }          
  });
 return mydata;
 alert(mydata); 
}  
$(document).ready(function(){  
mydata = getData();

var tm;

$(function() { 
var  infoString;
var markerColor;
 	$.ajax({
		type: 'POST',
		url: 'http://localhost/Prototype/markers_back.php',
		dataType: "json",
		data: {action: 'true'},
		success: function(output){
			div = "";       
    
    $.each(output, function(key, value){ 
   
//Timemap initialization        
    tm = TimeMap.init({
    bandIntervals: "mon",
        mapId: "map",               // Id of map div element (required)
        timelineId: "timeline",     // Id of timeline div element (required)
        options: {
            mapType: "physical",
            //eventIconPath: "/images/ComDev.png"
       },
       
        datasets: [
                  {
                title: "Test Dataset",
                id: "test",
                data: {
                    type: "basic",
                    value: mydata
                }
            }
          
                    
          
        ], //end datasets:
        }); // end for loop
        
        //bandInfos[1].highlight = true;
        bandIntervals: [
                  //  Timeline.DateTime.DECADE, 

            
        ] //end bandIntervals
    }); // end Timemap.init
     } //end function success  
    });//end $ajax    
}); //end $(function()) 
});   
         