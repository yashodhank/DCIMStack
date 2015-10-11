<?php
function device_power_feed_count($server_id) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$feed_count = 0;
	$server_id    = mysqli_real_escape_string($conn, $server_id);
	$sql = "SELECT * FROM `devices` WHERE `server_id`='$server_id'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $device_power_feed1 = $row["device_power_feed1"];
	        $device_power_feed2 = $row["device_power_feed2"];
	    }
	    if(!empty($device_power_feed1)) {
	    	$feed_count = 1;
	    }
	    if(!empty($device_power_feed2)) {
	    	$feed_count = $feed_count+1;
	    }
	    return $feed_count;
	} else {
	    return $feed_count;
	}     
}
function device_power_feed_check_A($server_id) { //check if server has power feed A
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$server_id    = mysqli_real_escape_string($conn, $server_id);
	$has_A = 0;
	$sql = "SELECT * FROM `devices` WHERE `server_id`='$server_id'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $device_power_feed1 = $row["device_power_feed1"];
	        $device_power_feed2 = $row["device_power_feed2"];
	    }
	    if(!empty($device_power_feed1) && $device_power_feed1=="A") {
	    	$has_A = 1;
	    }
	    if(!empty($device_power_feed2) && $device_power_feed2=="A") {
	    	$has_A = 1;
	    }
	    return $has_A;
	} else {
	    return $has_A;
	}     
}
function device_power_feed_check_B($server_id) { //check if server has power feed B
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$server_id    = mysqli_real_escape_string($conn, $server_id);
	$has_B = 0;
	$sql = "SELECT * FROM `devices` WHERE `server_id`='$server_id'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $device_power_feed1 = $row["device_power_feed1"];
	        $device_power_feed2 = $row["device_power_feed2"];
	    }
	    if(!empty($device_power_feed1) && $device_power_feed1=="B") {
	    	$has_B = 1;
	    }
	    if(!empty($device_power_feed2) && $device_power_feed2=="B") {
	    	$has_B = 1;
	    }
	    return $has_B;
	} else {
	    return $has_B;
	}     
}
function device_power_usage($server_id) { 
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$device_power_usage = 0;
	$server_id    = mysqli_real_escape_string($conn, $server_id);
	$sql = "SELECT * FROM `devices` WHERE `server_id`='$server_id'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	            $device_power_usage = $row["device_power_usage"];
	    }
	    if(device_power_feed_check_B($server_id) && device_power_feed_check_A($server_id)) {
	    	$device_power_usage = $device_power_usage*2;
	    	return $device_power_usage;
	    } else {
	    	return $device_power_usage;
	    }
	} else {
	    $device_power_usage;
	}     
}
function power_usage_A() { 
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$device_power_usage_sum_A = 0;
	$sql = "SELECT SUM(device_power_usage) AS `device_power_usage_sum_A` FROM `devices` WHERE `device_power_feed1`!=''";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	            $device_power_usage_sum_A = $row["device_power_usage_sum_A"];
	    }
	    return $device_power_usage_sum_A;
	} else {
	    return device_power_usage_sum_A;
	}     
}
function power_usage_B() { 
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$device_power_usage_sum_B = 0;
	$sql = "SELECT SUM(device_power_usage) AS `device_power_usage_sum_B` FROM `devices` WHERE `device_power_feed2`!=''";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	            $device_power_usage_sum_B = $row["device_power_usage_sum_B"];
	    }
	    return $device_power_usage_sum_B;
	} else {
	    return device_power_usage_sum_B;
	}     
}
function rack_power_total($rackid) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$rackid = mysqli_real_escape_string($conn, $rackid);
	$sql = "SELECT SUM(feed_power) AS `feed_power_sum` FROM `power_feeds` WHERE `rackid`='$rackid'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	            $feed_power_sum = $row["feed_power_sum"];
	    }
	    return $feed_power_sum;
	} else {
	    return 0;
	}
}

function rack_voltage($rackid) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$rackid = mysqli_real_escape_string($conn, $rackid);
	$sql = "SELECT * FROM `power_feeds` WHERE `rackid`='$rackid'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	            $feed_voltage = $row["feed_voltage"];
	    }
	    return $feed_voltage;
	} else {
	    return 0;
	}
}

function rack_feed_count($rackid) {
	include realpath(dirname(__FILE__)).'/../config/db.php';
	$rackid = mysqli_real_escape_string($conn, $rackid);
	$sql = "SELECT * FROM `power_feeds` WHERE `rackid`='$rackid'";
	$result = $conn->query($sql);
	return $result->num_rows;
}
?>