<?php
/**
 * Created by PhpStorm.
 * User: nguyennghi
 * Date: 5/9/18
 * Time: 11:20 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/model/Function.php');
$func = new Functions();
if(isset($_GET['option']))
{
    $option = $_GET['option'];
    if($option=="movie")
    {
        $header_1 = "Danh Sách Phim";
        $header_2 = "Chọn Rạp";
        $header_3 = "Chọn Suất Chiếu";

    }

    if($option=="cinema")
    {
        $header_1 = "Chọn Rạp";
        $header_2 = "Chọn Phim";
        $header_3 = "Chọn Xuất Chiếu";
    }
}

 function drawData1($option)
{
    $funct = new Functions();
    if($option=='movie') {
        $movies = $funct->get_all_movies();

        foreach ($movies as $movie) {
            $data = json_decode(json_encode($movie), true);
            ?>
            <li class="movie-item">
                <img src="<?= "admin/" . $data['cover_image'] ?>" height="50px" width="80px"
                     style="margin: 10px 10px 10px 10px">
                <span><a href="booking-ticket.php?movie=<?= $data['id'] ?>&option=movie"><?= $data['movie_name'] ?></a>
                </span>
            </li>
            <?php
        }
    }
    else
    {
        $ci = $funct->get_all_cinema();

        foreach ($ci as $cinema)
        {
            $data = json_decode(json_encode($cinema), true);
            ?>
            <li class="cinema-item">

            <span><a href="booking-ticket.php?&option=cinema&cinema=<?=$cinema['id']?>"><?= $funct->get_cinema_name($data['id']) ?></a></span>
            </li>
            <?php


        }
    }
}

function drawData2($option)
{
    $funct = new Functions();
    if ($option == "movie") {
        if (isset($_GET['movie'])) {
            $schedule = $funct->get_available_movie_from_id($_GET['movie']);

            foreach ($schedule as $cinema) {
                $data = json_decode(json_encode($cinema), true);
                ?>
                <li class="movie-item">
                <span><a href="booking-ticket.php?movie=<?= $_GET['movie'] ?>&option=movie&cinema=<?= $data['cinema'] ?>"><?= $funct->get_cinema_name($data['cinema']) ?></a>
                </span>
                </li>
                <?php
            }
        }
    } else {

        if (isset($_GET['cinema'])) {
            $movies = $funct->get_current_movie_from_cinema($_GET['cinema']);

                foreach ($movies as $movie) {
                    $data = json_decode(json_encode($movie), true);
                    ?>
                    <li class="movie-item">
                        <img src="<?= "admin/" . $funct->get_movie_from_id($data['movie_id'])->cover_image ?>"
                             height="50px" width="80px"
                             style="margin: 10px 10px 10px 10px">
                        <span><a href="booking-ticket.php?movie=<?= $data['movie_id'] ?>&option=cinema&cinema=<?= $_GET['cinema'] ?>"><?= $funct->get_movie_from_id($data['movie_id'])->movie_name ?></a>
                </span>
                    </li>
                    <?php
                }
        }
    }
}


function drawData3($option)
{
    $funct = new Functions();
    if($option=="movie")
    {
        if(isset( $_GET['cinema'])) {
            $schedule = $funct->get_current_movie_from_id_cinema($_GET['movie'], $_GET['cinema']);

            foreach ($schedule as $shift) {
                $data = json_decode(json_encode($shift), true);
                ?>
                <li class="date-item">
                    <div>
                        <p style="font-size: 25px" href="booking_location.php"><?= "Ngày: " . $data['date'] ?></p>
                        <p>Thời gian: <?= $data['shift'] ?></p>
                        <button class="form-control"><a
                                    href="booking_location.php?movie_id=<?= $_GET['movie'] ?>&cinema=<?= $_GET['cinema'] ?>&date=<?= $data['date'] ?>&time=<?= $data['shift'] ?>">Đặt
                                Chổ</a></button>
                    </div>
                </li>
                <?php
            }
        }
    }
    else{
        if (isset($_GET['movie']) ) {
            $schedule = $funct->get_current_movie_from_cinema_movie($_GET['cinema'], $_GET['movie']);

            foreach ($schedule as $shift)
            {
                $data = json_decode(json_encode($shift), true);
                ?>
                <li class="date-item">
                    <div>
                        <p style="font-size: 25px" href="booking_location.php"><?="Ngày: ".$data['date']?></p>
                        <p>Thời gian: <?=$data['shift']?></p>
                        <button class="form-control"><a href="booking_location.php?movie_id=<?= $_GET['movie'] ?>&cinema=<?= $_GET['cinema'] ?>&date=<?= $data['date'] ?>&time=<?= $data['shift'] ?>">Đặt Chổ</a></button>
                    </div>
                </li>
                <?php
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

    <title>HiHiHi Cinema.vn</title>

    <!-- Loading third party fonts -->
    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
    <link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Loading main css file -->
    <link rel="stylesheet" href="style.css">

    <!--[if lt IE 9]>
    <script src="js/ie-support/html5.js"></script>
    <script src="js/ie-support/respond.js"></script>
    <![endif]-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/app.js"></script>
    <script>
        $(function(){
            $("#header").load("header.php");
            $("#footer").load("footer.php");
        });

    </script>
        <style>
            #LI_2 ,#LI_4, #LI_6{
                margin-left: 10px;
            }
        #UL_1{

            padding: 20px 20px 20px 20px;
        }
        .date-item p{
            margin: 4px 4px 4px 4px;
        }
        .date-item button
        {
            background-color: #555;
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
        }

        li{
            text-decoration: none;
            list-style-type: none;
            float: left;
        }
        .panel-heading{
            background: #ff9b26;
            height: 40px;
        }
        .list-group{
            height: max-content;
            solid-color: #ffa349;
            stroke: #ff7691;
            background: goldenrod;
        }
    </style>



</head>


<body>

<div id="header"></div>
<div id="site-content">


    <main class="main-content">


        <div class="container">
            <ul id="UL_1" style="text-decoration: none solid">
                <li id="LI_2">
                    <a href="booking-ticket.php?option=movie" id="A_3">Theo phim</a>
                </li>
                <li id="LI_4">
                    <a href="booking-ticket.php?option=cinema" id="A_5">Theo rạp</a>

                <br>
            </ul>

            <div class="row">

                <!-- cột 1 -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="panel-heading">
                        <p style="text-align: center"><?=$header_1?></p>
                    </div>
                    <ul class="list-group">
                        <?php
                        drawData1($option);
                        ?>
                    </ul>
                </div>

                <!-- cột 2 -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="panel-heading">
                        <p style="text-align: center"><?=$header_2?></p>
                    </div>

                    <ul class="list-group">
                        <?php
                            drawData2($option);
                        ?>
                    </ul>
                </div>
                <!-- cột 3 -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="panel-heading">
                        <p style="text-align: center"><?=$header_3?></p>
                    </div>

                    <ul class="list-group">
                        <?php
                            drawData3($option);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
</div> <!-- .container -->

<!-- Default snippet for navigation -->

<div id="footer"></div>
</body>

</html>