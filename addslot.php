<?php
include("auth.php");

if(isset($_POST['submit'])){
    $name = $_FILES['file']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    $prize_name = $_POST['prize_name'];
    $slot_type = $_POST['slot_type'];
    $amount = $_POST['amount'];

    // Check extension
    if( in_array($imageFileType,$extensions_arr) )
    {
        // Convert to base64
        $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
        // Insert record
        $query = "insert into rl_slots(slot_type,name,amount,image) values('".$slot_type."','".$prize_name."','0','".$image."')";
        mysqli_query($conn,$query);
        echo mysqli_error($conn);

        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
    }
    else
    {
        if($slot_type == "mop")
        {
            $query = "insert into rl_slots(slot_type,name,amount) values('".$slot_type."','".$prize_name."','".$amount."')";
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
                <input type="text" name="prize_name"><br />
                Select Gift Image File to Upload:<br />
                <input type="file" accept="image/*" name="file">
        </div>
        <div class="mop z">
                Name:<br />
                <input type="text" name="prize_name"><br />
                Prize price: <br />
                Amount:
                <input type="text" name="amount" value="0">
                <label>
                    <input type="checkbox" name="is_money"
                           value="money"> is money</label>
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
