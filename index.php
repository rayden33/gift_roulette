<?php
include("auth.php");
$sql = mysqli_query($conn,"SELECT * FROM rl_slots");
?>

<style>
    * {
        padding: 0;
        margin: 0;
    }
    li {
        list-style: none;
        display: inline-block;
        float: left;
    }

    .window {
        overflow: hidden;
        position: relative;
        width: 25000px;
        height: 143px;
        right: 0px;
    }

    .prize_list {
        position: relative;
        display: inline-block;
    }

    .prize_list li {
        width: 120px;
        height: 120px;
        border:  solid;
    }

    .prize_list li h4{
        text-align: center;
        width: 100px;
        height: 100px;
    }
    .prize_list li h6{
        text-align: center;
    }
    .prize_list li img{
        width: 100px;
        height: 100px;
    }

    .wraper {
        position: relative;
        margin: auto;
        margin-top: 50px;
        width: 408px;
        overflow-x: hidden;
        overflow-y: hidden;
        border: 4px solid #1a96b7;
        border-radius: 2px;
    }

    .list {
        position: relative;
        display: inline-block;
    }

    .list li {
        border: 4px solid transparent ;
    }

    .list li div{
        text-align: center;
        width: 130px;
        height: 130px;
    }

    .list li div img{
        width: 100px;
        height: 100px;
    }

    .arrowup {
        position: absolute;
        bottom: 0;
        right: 200px;
        z-index: 1;
        width: 0;
        height: 0;
        border-bottom: 20px solid #1a96bf;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
    }

    .arrowdown {
        position: absolute;
        top: 0;
        right: 200px;
        z-index: 1;
        width: 0;
        height: 0;
        border-top: 20px solid #1a96bf;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
    }
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="prizes">
    <H3 align="center">PRIZES</H3>
    <ul class="prize_list">
        <?php
        while($row = mysqli_fetch_array($sql))
        {
            if(isset($row['image'])) {
                $image = $row['image'];
                $image_src = "upload/".$image;
                echo "<li><img src=" . $image . "><h6>".$row['name']."</h6></li>";
            } else {
                $min_amount = $row['min_amount'];
                $max_amount = $row['max_amount'];
                echo "<li><h4>" . $min_amount."-". $max_amount . "" . ($row['is_money']=='Y'?'$':'Points')."</h4><h6>".$row['name']."</h6></li>";
            }
        }
        ?>
    </ul>
</div>
<div class="wraper">
    <div class="arrowup"></div>
    <div class="arrowdown"></div>
    <div class="window">
        <ul class="list">

        </ul>
        <ul class="list">
            <?php
            $sql = mysqli_query($conn,"SELECT * FROM rl_slots");
            while($row = mysqli_fetch_array($sql))
            {
                if(isset($row['image'])) {
                    $image = $row['image'];
                    $image_src = "upload/".$image;
                    echo "<li id='".$row['id']."'><div><img src=" . $image . "><h6>".$row['name']."</h6></div></li>";
                } else {
                    $min_amount = $row['min_amount'];
                    $max_amount = $row['max_amount'];
                    echo "<li id='".$row['id']."'><div><h4>" . $min_amount."-". $max_amount . "<br />" . ($row['is_money']=='Y'?'$':'Points')."</h4><br /><span id='amount'></span><br /><h6>".$row['name']."</h6></div></li>";
                }
            }
            ?>
        </ul>
    </div>
</div>
<p style="text-align: center">
    <button class="button">Кнопка</button>
<div class="win">
    <ul>

    </ul>
</div>

<script>
    $(document).ready(function () {
        for (i = 0; i < 3; i++) {
            $(".list li").clone().appendTo(".list");
        }
        $('.button').click(function () {
            $('.window').css({
                right: "0"
            })
            $('.list li').css({
                border: '4px solid transparent'
            })
            function selfRandom(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            var x = selfRandom(50, 100);
            var li_prize = $('.list li:eq('+x+')');
            li_prize.css({
                border:'4px solid #00ba00'
            });

            function getPrize(id) {
                //alert(id);
                $.post("getprize.php", {p_id: id},function(result){
                    $('.list li:eq('+x+') #amount')[0].innerHTML ="You win:<br />" + result;
                });
            }

            var p_id = li_prize[0].id;
            console.log(li_prize);
            //var prize_text = li_prize
            $('.window').animate({
                right: ((x*130)+(x*8-12)-119)
            }, 1000, function() {
                getPrize(p_id);
            });
        });
    });
</script>

<a href="logout.php">Logout (<?php echo $_SESSION['LOGIN']; ?>)</a><br />
<a href="add_slot.php">Add slot</a>