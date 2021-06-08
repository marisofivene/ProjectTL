<?php
	include("header.php");
?>
  <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script>
  	var map;  	 // metavliti gia xarti kai marker
 	var marker; // i synartisi arxikopoiisis tou xarti
var mrks=[];
function initialize() {

// orizo to zoom tou xarti 
	pos=new google.maps.LatLng(38.25543637637947, 21.77490234375);
 	   var mapOptions = {
 						    zoom: 5,
	   						center: pos
 	 					};
  map = new google.maps.Map(document.getElementById('map'), mapOptions);	 


<?php
$i=1;

$sl=@$_POST['cat'];
$usr1=@$_POST['usr1'];

$sql3="select * from anafores, katigories, users where perigrafi<>'0.000000' and id_sensor=katigories.id 
and katigoria like '%$sl%' and id_user=users.id and email like '%$usr1%' ";

// ektelo to erwtima
$rq3=mysqli_query($conn,$sql3);
$icon[1]="http://maps.google.com/mapfiles/kml/pal4/icon22.png";
$icon[2]="http://maps.google.com/mapfiles/kml/pal4/icon41.png";
$icon[3]="http://maps.google.com/mapfiles/kml/pal3/icon32.png";
$icon[4]="http://maps.google.com/mapfiles/kml/pal4/icon40.png";



// kai gia kathe mia eggrafi emfanizw ena marker 
while($row3=mysqli_fetch_array($rq3))
{

$ic=$row3['id_sensor'];
	echo "
	
	// kainouria thesi  gia  kathe eggrafi
	pos=new google.maps.LatLng($row3[y], $row3[x]);
	
	// neos marker gia kathe eggrafi
	marker$i = new google.maps.Marker({map: map, position: pos, icon:'".$icon[$ic]."'});
	
	// neo parathiro ston marker
	 var infowindow$i = new google.maps.InfoWindow({
      content: 'Τύπος: $row3[katigoria]<br> Τιμή:$row3[perigrafi]<br> Συσκευή: $row3[solution]'
  });
  
  // an patisei click ston marker tote emfanizei to parathiro perigrafis
  google.maps.event.addListener(marker$i, 'click', function() {
    infowindow$i.open(map,marker$i);
  });
	
	// thetei to kentro tou xarti ston marker
	//  map.setCenter(pos);	
mrks.push(marker$i);	  
	    // Add a marker clusterer to manage the markers.
      
      
	  ";

	  $i++;
}


?>  
   
  //var markerCluster = new MarkerClusterer(map, mrks,  {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
 
}
google.maps.event.addDomListener(window, 'load', initialize);




</script>

	
	
		
		<div id=coment>
		
		
		<p><b> Συμμετοχή Μετρήσεων </b><br>Συμμετέχετε σαν εθελοντής στις μετρήσεις της ζωής της πόλης μας κάνοντας απλά μια <b>εγγραφή </b>σας.<br> 
		
		
		
		
		</p>
		<br><br>
		</div>
		<form action='' method=post name="myForm">
		Category: <select name=cat>
		<?php
		$s="select * from katigories";
		$rs1=mysqli_query($conn,$s);
		if(@$_POST['cat']!="") echo "<option value='$_POST[cat]'>$_POST[cat]</option>";
		echo "<option value=''>All</option>";
		while($rw1=mysqli_fetch_array($rs1))
		{
		   echo "<option value='$rw1[katigoria]'>$rw1[katigoria]</option>";
		}
		
		echo "</select> User: <input type=text name=usr1 value='$usr1'>
<input type=submit value='Search'>";
		?>
		
		
		</form>
		
	<div id=map>

		</div>
		
		<div id=ajaxdiv>
		
		</div>
		<br><br>
	
		
		
<?php
	include("footer.php");
?>