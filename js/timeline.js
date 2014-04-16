var tLine;
function onLoad() {
var eventSource = new Timeline.DefaultEventSource();
  
  var bandInfos = [
    Timeline.createBandInfo({
      eventSource:      eventSource,
      date:             "Jun 10 2012 12:48:32 GMT",
      height:           "30%",
      width:            "70%",
      intervalUnit:     Timeline.DateTime.MONTH,
      intervalPixels:   100                              
    }),
   Timeline.createBandInfo({
      eventSource:    eventSource,
      date:           "Jun 28 2006 00:00:00 GMT",      
      height:           "30%",
      width:            "30%",
      intervalUnit:     Timeline.DateTime.YEAR,
      intervalPixels:   100   
    })
  ];
  
   bandInfos[1].syncWith = 0;
  bandInfos[1].highlight = true;
  
  
  tLine = Timeline.create(document.getElementById("timeline"), bandInfos);
  Timeline.loadXML("example1.xml", function(xml, url) { eventSource.loadXML(xml,url); });

}

var resizeTimerID = null;
function onResize() {
  if (resizeTimerID == null){
      resizeTimerID = window.setTimeout (function() {
        resizeTimerID = null;
        tLine.layout();
        }, 500);
      
      }
    
  }
 