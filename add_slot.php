<?php
include("admin_auth.php");

if(isset($_POST['submit'])){
    $name = $_FILES['file']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $extensions_arr = array("jpg","jpeg","png","gif");

    $slot_type = $_POST['slot_type'];
    $min_amount = $_POST['min_amount'];
    $max_amount = $_POST['max_amount'];

    if( in_array($imageFileType,$extensions_arr) && $slot_type == "gift")
    {
        $prize_name = $_POST['gift_name'];
        $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
        $query = "insert into rl_slots(slot_type,name,min_amount,max_amount,image) 
                    values('".$slot_type."','".$prize_name."','0','0','".$image."')";
        mysqli_query($conn,$query);
        echo mysqli_error($conn);

        move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
    }
    else
    {
        if($slot_type == "mop")
        {
            $prize_name = $_POST['prize_name'];
            $is_money = $_POST['is_money'];
            $is_money = isset($is_money) ? $is_money : 'N';

            $query = "insert into rl_slots(slot_type,name,min_amount,max_amount,is_money) 
                        values('".$slot_type."','".$prize_name."','".$min_amount."','".$max_amount."','".$is_money."')";
            mysqli_query($conn,$query);
        }
    }
}

?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<style type="text/css">
    .z {
        display: none;
    }

    label {
        margin-right: 20px;
    }
</style>

<head>
    <title>Add slot</title>

</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label>
                <input type="radio" name="slot_type"
                       value="gift"> Gift</label>
            <label>
                <input type="radio" name="slot_type"
                       value="mop"> Money or points</label>
        </div>
        <div class="gift z">
                Name:<br />
                <input type="text" name="gift_name"><br />
                Select Gift Image File to Upload:<br />
                <input type="file" accept="image/*" name="file">
        </div>
        <div class="mop z">
                Name:<br />
                <input type="text" name="prize_name"><br />
                Prize price: <br />
                Amount:
                <input type="text" name="min_amount" value="0">
                <input type="text" name="max_amount" value="0">
                <label>
                    <input type="checkbox" name="is_money"
                           value="Y"> is money</label>
        </div>
        <input type="submit" name="submit" value="Add">
    </form>
</body>


<script type="text/javascript">
    $(document).ready(function() {
        $('input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".z").not(targetBox).hide();
            $(targetBox).show();
        });
    });
</script>

<a href="logout.php">Logout (<?php echo $_SESSION['LOGIN']; ?>)</a><br />
<a href="index.php">Main menu</a>