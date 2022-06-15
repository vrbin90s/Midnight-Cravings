<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="jumbotron">
		<div class="row">
			<div id="googleMap" style="width:100%;height:400px"></div>
		</div>
	</div>


<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:15,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?AIzaSyBxaDm7npZ1zsGKvlgSaCsNaZblcDncMmE&callback=myMap"></script>
</body>
</html>