// JavaScript Document
function writeAddressName(latLng) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
          "location": latLng
        },
        function(results, status) {
          if (status == google.maps.GeocoderStatus.OK)
            document.getElementById("address").innerHTML = results[0].formatted_address;
          else
            document.getElementById("error").innerHTML += "Unable to retrieve your address" + "<br />";
        });
      }
 
      function geolocationSuccess(position) {
        var userLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        // Write the formatted address
        writeAddressName(userLatLng);
 
 //alert(userLatLng);
 
        var myOptions = {
          zoom : 16,
          center : userLatLng,
          mapTypeId : google.maps.MapTypeId.ROADMAP
        };
        // Draw the map
        var mapObject = new google.maps.Map(document.getElementById("map"), myOptions);
        
        // Place the marker
          var mydata = "IP Address: 192.168.1.10 ";
          var mydatabr = " ";
          var marker = new google.maps.Marker({
          map: mapObject,
          position: userLatLng,    
          title: mydata + mydatabr
          //icon: "http://localhost/prototype/images/computer.jpg" 
        });
        function analyzeIntruder(ipAddress)
        {
        
      $.ajax({
      type: 'GET',  
      url:  'http://localhost/Prototype/markers.php',
      dataType: 'json',
		  success: function(output){
      mydata = output;
      }          
      });
      return mydata;
      alert(mydata); 
        
        }
        var windowstring = "Intrusion ID: 12" + "<br />" + "IP Address: 141.12.100.18" + "<br />" +
        "Date: "+Date()+"<br />" + "Device Type: Mobile Device" + "<br />" +
        "Type of Intrusion: Ping of Death" + "<br />" + "<font color=red># of intrusions: <b/>14</font>" + "<br />"+ 
        "<FORM><INPUT Type=BUTTON VALUE=Analyze Page ONCLICK=window.location.href=\"http://localhost/Prototype/analysismode.html\"></FORM>";
        
        
        //$("#clickbut").alert('You want to go to analyze mode');
        
        var infoWindow2 = new google.maps.InfoWindow({
        content: windowstring,
        map: mapObject,
        position: userLatLng       
        });
    google.maps.event.addListener(marker, 'click', function(){
       infoWindow2.open(mapObject,marker);
       });
       
        // Draw a circle around the user position for accuracy
        var circle = new google.maps.Circle({
          center: userLatLng,
          radius: position.coords.accuracy,
          map: mapObject,
          fillColor: '#9C9DA0',
          fillOpacity: 0.4,
          strokeColor: '#9C9DA0',
          strokeOpacity: 0.7
        });
          mapObject.fitBounds(circle.getBounds());
      }
 
      function geolocationError(positionError) {
        document.getElementById("error").innerHTML += "Error: " + positionError.message + "<br />";
      }
 
      function geolocateUser() {
        // If the browser supports the Geolocation API
        if (navigator.geolocation)
        {
          var positionOptions = {
            enableHighAccuracy: true,
            timeout: 10 * 10000 // 10 seconds
          };
          navigator.geolocation.getCurrentPosition(geolocationSuccess, geolocationError, positionOptions);
        }
        else
          document.getElementById("error").innerHTML += "Your browser doesn't support the Geolocation API";
      }
 
      window.onload = geolocateUser;
    

   // function attachInformation(marker, num){
     // var message = {'get from database using ajax'};
     // var infowindows = new google.maps.InfoWindow({
      //  content: message[num];
     // });
     // google.maps.event.addListener(marker,'click', function(){
      //  infowindows.open(marker.get['map'),marker);
     // });
   // }