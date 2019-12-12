<?php
include ("auth.php");
if (isset($_POST['p_id'])) {
    $p_id = $_POST['p_id'];
    $sql = mysqli_query($conn,"SELECT * FROM rl_slots where id='$p_id'");
    $row = mysqli_fetch_array($sql);
    $amount = rand($row['min_amount'], $row['max_amount']);

    $query = "SELECT * FROM `user_auth` WHERE `login` = '". $_SESSION['LOGIN'] . "' AND `uid` = '". $_SESSION['UID'] ."'";
    $result = mysqli_query($conn, $query);
    $user_id = 0;
    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_array($result);
        $user_id = $row['id'];

        $qry = "INSERT INTO `php_task`.`user_bag`(`user_id`, `prize_id`, `amount`) VALUES('$user_id','$p_id','$amount')";
        $result = mysqli_query($conn,$qry);

        if($result)
        {
            echo $amount;
        }
        else
        {
            echo "e" . mysqli_error($conn);
        }
    }
    else
    {
        echo "e";
    }



}
?>

