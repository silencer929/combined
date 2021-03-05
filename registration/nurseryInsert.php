
<?php 
session_start();
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'Nurseries');
if (!$db) {
    die('could not connect to database' . mysqli_connect_error());
}
   //check for duplicates
   if (isset($_POST['reg_nursery'])) {
            // $kefris_num = mysqli_real_escape_string($db, $_REQUEST['kefris_num']);
        $kfsreg_num = strtoupper(mysqli_real_escape_string($db, $_REQUEST['kfsreg_num']));
        $nurseryname = mysqli_real_escape_string($db, $_REQUEST['nurseryname']);
        $manager =mysqli_real_escape_string($db, $_REQUEST['manager']);
        $address = mysqli_real_escape_string($db, $_REQUEST['address']);
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];
        $Y_o_E = mysqli_real_escape_string($db, $_REQUEST['YoE']);
        $county = mysqli_real_escape_string($db, $_REQUEST['county']);
        $subcounty = mysqli_real_escape_string($db, $_REQUEST['subcounty']);
        $ward = mysqli_real_escape_string($db, $_REQUEST['ward']);
        $seedsource = mysqli_real_escape_string($db, $_REQUEST['seedsource']);
        // $capacity = mysqli_real_escape_string($db, $_REQUEST['capacity']);
        $category = mysqli_real_escape_string($db, $_POST['category']);
        $capacity = mysqli_real_escape_string($db, $_POST['capacity']);
        

        $nursery_check_query = "SELECT * FROM nursery WHERE kfsreg_num = '$kfsreg_num'";
        $result = $db->query($nursery_check_query);
        
        //validation
        if ($app = $result->fetch_assoc()) {
            if ($kfsreg_num === $app['kfsreg_num']) {
                 array_push($errors, 'You are re-applying nursery <span style="color: green; font-weight: bold;">' . strtoupper($kfsreg_num) . '</span> for certification. Please use reapply button on your profile.');    
            } 
        }
        // if ($app = $result->fetch_assoc()) {
        //     if ($kfsreg_num === $app['kfsreg_num']) {
        //         if ($app['status'] === 'pending') {
        //             array_push($errors, 'The nursery <span style="color: green; font-weight: bold;">' . strtoupper($kfsreg_num) . '</span> certification is in process. Cannot proceeed.');
        //         } else if ($app['status'] === 'certified') {
        //             array_push($errors, 'The nursery <span style="color: green; font-weight: bold;">' . strtoupper($kfsreg_num) . '</span> has already been certified! Cannot proceed.');
        //         } else {
        //             array_push($errors, 'You are reapplying nursery <span style="color: green; font-weight: bold;">' . strtoupper($kfsreg_num) . '</span> for certification. Please use the \'Re-apply\' button in your profile page!');
        //         } 
        //     }
        // }
     
        //insert data to database
        if (count($errors) == 0) {
                /* insert into nursery table the permanent details */
                $sql = "INSERT INTO nursery (kfsreg_num, established, county, subcounty, ward) 
                        VALUES ('$kfsreg_num', '$Y_o_E', '$county', '$subcounty', '$ward')";
                mysqli_query($db, $sql);
                
                /* fetch autogenerated primary key 'KEFRI Num' */
                $fetch_kefri_num = "SELECT * FROM nursery WHERE kfsreg_num = '$kfsreg_num'";
                $fetch_result = $db->query($fetch_kefri_num);
 
                if ($app_2 = $fetch_result->fetch_assoc()) {
                    $kefri_num_fetched = $app_2['kefri_num'];

                    /* insert to nursery_details table */
                    $sql_details = "INSERT INTO `nursery_details` (`nursery_id`, `nursery_name`, `manager`, `address`, `email`, `phone`, `seedsource`, `category`, `capacity`, `kefri_num`) 
                                    VALUES (NULL, '$nurseryname', '$manager', '$address', '$email', '$phone', '$seedsource', '$category', '$capacity', '$kefri_num_fetched')";
                    $db->query($sql_details);
                    

                    /* insert a new application every time a user registers for certification */
                    $status = 'pending';
                    $eval_id = 0;

                    $sql_insert_to_app = "INSERT INTO applications (status, evaluator_id, kefri_num) VALUES ('$status', '$eval_id', '$kefri_num_fetched')";
                    if ($db->query($sql_insert_to_app)) {
                        header('location:../userProfileV2.php');
                    } else {
                        header('location:../errorPage.php');
                    }              
                  
                }
            }   
               
             }  
    mysqli_close($db);

?>