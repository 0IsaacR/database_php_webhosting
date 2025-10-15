


<?php
//setting header to json
//header('Content-Type: application/json');

//database
    $servername = "localhost";
    $username = "u212152591_db_IsaacR";
    $password = "!AFqhecYg0S";
    $dbname = "u212152591_IsaacR";
    $enableTemp = 'T';
    $enableTime = 'T';
    $test = key($_REQUEST);
    //echo json_encode($_REQUEST);

    if ($test != 'nodeId')
    {
         parse_str(base64_decode(key($_REQUEST)) , $output);
         $_REQUEST = $output;
         print "decoded :" . json_encode($_REQUEST) . "\n" ;
     }
        
   
    if ($_REQUEST['nodeTemp'] >= 110){
        $enableTemp = 'F';
    }
    if (30 >= $_REQUEST['nodeTemp']){
        $enableTemp = 'F';
    }
    
    if ($_REQUEST['timeReceived'] == '') {
        $enableTime = 'F';
    } 
    if ($enableTemp == 'T'){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    $nodeId = "somename";
    $nodeTemp = "sometemp";
    if ($enableTime == 'T'){
        $timeReceived = "sometime";
    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO sensor_data (node_name, temperature, time_received) SELECT :nodeId, :nodeTemp, :timeReceived WHERE NOT EXISTS( SELECT 1 FROM sensor_data WHERE node_name = :nodeId AND time_received = :timeReceived);");
     }elseif($enableTime == 'F') {
      $stmt = $conn->prepare("INSERT INTO sensor_data (node_name, temperature) VALUES (:nodeId, :nodeTemp);");}
    
    //VALUES (:nodeId, :nodeTemp, :timeReceived)");

    // Bind parameters
    $stmt->bindParam(':nodeId', $_REQUEST['nodeId']);
    $stmt->bindParam(':nodeTemp', $_REQUEST['nodeTemp']);
    if ($enableTime == 'T'){
    $stmt->bindParam(':timeReceived', $_REQUEST['timeReceived']);
    }
    $stmt->execute();

    //echo "New record created successfully";

    // Close connection (optional, PDO connection closes automatically when script ends)
    $conn = null;}

    

?>
