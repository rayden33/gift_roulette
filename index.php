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

    .wraper {
        position: relative;
        margin: auto;
        margin-top: 250px;
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
    .list li h4{
        width: 130px;
        height: 130px;
    }
    .list li img{
        width: 130px;
        height: 130px;
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
<div class="wraper">
    <div class="arrowup"></div>
    <div class="arrowdown"></div>
    <div class="window">
        <ul class="list">

        </ul>
        <ul class="list">
            <?php
            while($row = mysqli_fetch_array($sql))
            {

                if(isset($row['image'])) {
                    $image = $row['image'];
                    $image_src = "upload/".$image;
                    echo "<li><img src=" . $image . "></li>";
                } else {
                    $amount = $row['amount'];
                    echo "<li><h4>" . $amount . "</h4></li>";
                }
            }
            ?>
<!--            <li><img src="https://cdn0.iconfinder.com/data/icons/fruits/128/Strawberry.png" alt=""></li>-->
<!--            <li><img src="https://cdn0.iconfinder.com/data/icons/fruits/128/Cherry.png" alt=""></li>-->
<!--            <li><img src="https://cdn0.iconfinder.com/data/icons/fruits/128/Apple.png" alt=""></li>-->
<!--            <li><img src="https://cdn0.iconfinder.com/data/icons/fruits/128/Lemon.png" alt=""></li>-->
<!--            <li><img src="https://cdn0.iconfinder.com/data/icons/fruits/128/Kiwi.png" alt=""></li>-->
<!--            <li><img src="https://cdn0.iconfinder.com/data/icons/fruits/128/Pear.png" alt=""></li>-->
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
            $('.list li:eq('+x+')').css({
                border:'4px solid #00ba00'
            })
            $('.window').animate({
                right: ((x*130)+(x*8-12)-119)
            }, 10000);
        });
    });
</script>

<a href="logout.php">Logout (<?php echo $_SESSION['LOGIN']; ?>)</a>