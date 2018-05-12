<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/model/Function.php');
$func = new Functions();
    if(isset($_GET['movie_id']))
    {
        $id = $_GET['movie_id'];
    }

    $movie = $func->get_movie_from_id($id);
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

        .ctn {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        .ctn img {
            width: 100%;
            height: auto;
        }
        #get_ticket{

            background-color: #ff9b26;
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
        }
        .ctn .btn {
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: #555;
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;

        }

        .ctn .btn:hover {
            background-color: black;
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: transparent;
            margin: auto;

            padding: 20px;
            border: 1px solid #888;
            border-radius: 10px;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>


<body>

<div id="header"></div>
<div id="site-content">



    <main class="main-content">

        <div class="container">
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content" style="width: 740px; height: auto">
                    <span class="close">&times;</span>
                    <?php echo $movie->trailer_url?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8" >
                    <div class="col-md-4" style="width: auto">
                        <div class="ctn">
                            <img src="<?="admin/".$movie->poster?>">
                            <button class="btn" id="myBtn">Play Trailer</button>
                        </div>

                    </div>
                    <div class="col-md-4" style="float: left">
                        <p style="font-size: 25px"><?=$movie->movie_name?></p>
                        <p>Nhà Sản Xuất: <?=$movie->producer?></p>
                        <p>Diễn Viên: <?=$movie->cast?></p>
                        <p>Quốc Gia: <?=$movie->country?></p>
                        <p>Thể Loại: <?=$movie->type?></p>
                        <p>Ngày Phát Hành: <?=$movie->show_date?></p>
                        <p>Nhà Sản Xuất: <?=$movie->producer?></p>
                        <button class="btn"  id="get_ticket"><a style="color: white" href="booking-ticket.php?movie_id=<?=$_GET['movie_id']?>&option=movie">Mua Vé Ngay</a></button>

                    </div>

                </div>
                <div class="col-md-4">
                    <p>Có Thể Bạn Sẽ Thích</p>
                    <?php
                    $movies = $func->get_all_movies();
                    $random = rand(0, count($movies)-1);
                    $data = json_decode(json_encode($movies[$random]), true);
                    ?>
                    <p style="font-size: 25px"><?=$data['movie_name']?></p>
                    <br>
                    <img src="<?='admin/'.$data['poster']?>" href="movie-details.php?movie_id=<?=$data['id']?>" height="auto" width="300">


                </div>
            </div>
        </div>
</div> <!-- .container -->
<script>
    // Get the modal
    let modal = document.getElementById('myModal');

    // Get the button that opens the modal
    let btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    let span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    };

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>

<!-- Default snippet for navigation -->




<div id="footer"></div>
</body>

</html>

