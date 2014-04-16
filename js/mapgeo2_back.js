function drawMap()
{
$(document).ready(function(){
var infoString;
var map = new google.maps.Map(document.getElementById('map'),{
      //Center 
      zoom: 15,
      center: new google.maps.LatLng(35.122322,-89.945068),
      mapTypeId: google.maps.MapTypeId.ROADMAP
      });
	$.ajax({
		type: 'POST',
		url: 'http://localhost/Prototype/markers.php',
		dataType: "json",
		data: {action: 'true'},
		success: function(output){
			div = "";
        
      $.each(output, function(key, value){
      var marker;
				div += "IP: "+value.ipAddress + "   ";
        div += "Latitude: " + value.lat + "   ";
				div += "Longitude: " + value.long + "<br></br>";
        //use longitude and latidude
        //contentString ="Name : "+id+"<br/> Location : "+ipaddress+"<br/> Arrival :"+DateTime+"<br/> Departure : "+Devicetype+"<br/> Notes : "+intrusiondes;
        infoString = "Intrusion ID: "+value.intrusionId+"<br />"+"IP Address: " + value.ipAddress+"<br />"+
        "Date & Time: "+ value.dateTimeofIntrusion +"<br />" + "Device Type: " + value.deviceType + "<br />" +
        "Type of Intrusion: " + value.intrusionDescription + "<br />";
        var infoWindow = new google.maps.InfoWindow({
        content: infoString
        });
        var thedata = value.ipAddress;
        marker = new google.maps.Marker({
        position: new google.maps.LatLng(value.lat,value.long),
        map: map,
        title: "IP: " + thedata
        });
       google.maps.event.addListener(marker, 'click',function(){
       infoWindow.open(map,marker);
       });
       
      }); // end for loop
			$("#log-lat-data").html(div);
     } //end function success
     }); //end $ajax
  
  });  //end $function
  
} //end draw map function

google.maps.event.addDomListener(window,'load',drawMap);        
