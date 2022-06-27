<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
     <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<?php if ($_SESSION['role'] == 'admin') {?>
      		<!-- For Admin -->
      		<div class="card" style="width: 18rem;">
			  <img src="img/admin-default.png" 
			       class="card-img-top" 
			       alt="admin image">
			  <div class="card-body text-center">
			    <h5 class="card-title">
			    	<?=$_SESSION['name']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
			<div class="p-3">
				<?php include 'php/members.php';
                 if ($select_stmt->rowCount() > 0) {?>
                  
				<h1 class="display-4 fs-1">Members</h1>
				<table class="table" 
				       style="width: 32rem;">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Name</th>
				      <th scope="col">User name</th>
				      <th scope="col">Role</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  	$i =1;
				  	while ($rows = $select_stmt->fetch(PDO::FETCH_ASSOC)) {?>
				    <tr>
				      <th scope="row"><?=$i?></th>
				      <td><?=$rows['name']?></td>
				      <td><?=$rows['username']?></td>
				      <td><?=$rows['role']?></td>
				    </tr>
				    <?php $i++; }?>
				  </tbody>
				</table>
				<?php }?>
				<div id='map-div' style="height:500px;width=200px,"></div>
			</div>

      	<?php }else { ?>
      		<!-- FORE USERS -->
      		<div class="card" style="width: 18rem;">
			  <img src="img/user-default.png" 
			       class="card-img-top" 
			       alt="admin image">
			  <div class="card-body text-center">
			    <h5 class="card-title">
			    	<?=$_SESSION['name']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
      	<?php } ?>
      </div>
</body>


<script>
        var map = L.map('map-div').setView([27.6739337, 85.4129625], 12);

        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, OSM'
        });
        osm.addTo(map);

        $.get('php/spatial_data.php', function(data) {
            console.log(data);
            data = JSON.parse(data);
            data.forEach(poi => {
                L.marker([poi.lat, poi.lon]).addTo(map);
            })

            //
        })




    </script>

</html>
<?php }else{
	header("Location: index.php");
} ?>