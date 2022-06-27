<?php
include "../db_conn.php";
    $sql = "SELECT * FROM osm_in_bkt";
    $select_poi = $postgis_db->prepare($sql);
    $select_poi->execute();
    if ($select_poi->rowCount() > 0) {
        $res = [];
        while($rows = $select_poi->fetch(PDO::FETCH_ASSOC)){
            $res[]= $rows;
        }
        echo json_encode($res);
    }
    // $res = mysqli_query($conn, $sql);
    ?>