//$(document).ready(function(){
var mydata;
var tm;

function getData()
{ 
$.ajax({
     type: 'POST',  
     url:  'http://localhost/Prototype/markers.php',
     dataType: 'json',
		 success: function(output)
     {
     mydata = output;
     }          
  });
 //return mydata;
}
//
alert('');
mydata = getData();
$(function(){    
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
          
                  ] //end datasets:
        
        }); // end Timemap.init    
}); //end $(function())    
//});
//}
//}        