<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/model/Function.php');
$func = new Functions();

    $id = $_GET['movie_id'];
    $cinema = $_GET['cinema'];
    $date = $_GET['date'];
    $time = $_GET['time'];
    $price = $func->get_current_movie_from_cinema_date_id($cinema,$date,$id);
    $data = json_decode(json_encode($price[0]), true);
    $price = $data['price'];

$movie = $func->get_movie_from_id($id);
$current_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
    </script>
    <script>
        $(function(){
            $("#header").load("header.php");
            $("#footer").load("footer.php");
            var count=0;
            $(".item").unbind("click").click(function(){
                if($(this).css('background-color')==="rgba(255, 178, 61, 0.56)");
                {
                    $(this).css('background-color',"rgba(255, 178, 61, 1)");
                    var cur = +parseInt($('#total').text().toString(), 10);
                    var pr = +parseInt($('#price').text().toString(), 10);

                    $("#total").text(cur + pr);
                    $("#hidPayment").val(cur+pr);
                }
                count++;
            });

            $("#btnpay").click()(function () {
                alert("Thanh Toán Thành Công - Sử dụng số điện thoại để lấy vé khi đến quầy!");
            });
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
        .item{
            background: rgba(255, 178, 61, 0.56);
            border-radius: 1px;
            width: 30px; height: 30px; font-size: 10px; margin-bottom: 2px
        }
        .side{
            width: 30px; height: 30px;
            font-size: 10px;
            margin-bottom: 2px;
        }
        #btn, #btnpay{
            background-color: #ffb23d;
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
        }

        .modal {
        <?php
        if(isset($_POST['payment_total']))
        {
            ?> display: block;
        <?php
        }
        else
            {
                ?> display: none;
        <?php
        }
    ?>

            /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            margin: auto;
            background: white;
            padding: 40px;
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

            <div class="container">
                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content" style="width: 740px; height: 500px">
                        <p style="font-size: 20px">Tổng Số Tiền Phải Thanh Toán</p>
                        <p style="color: #ec6f43; font-size: 25px"><?=$_POST['payment_total']?> VND</p>
                        <br>
                        <p>Lựa Chọn Hình Thức Thanh Toán</p>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Lựa Chọn Phương Thức
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Momo</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">123 Pay - ATM Card</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">123 Pay - Master/Visa/JCB</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">OnePay - ATM Card</a></li>
                            </ul>
                        </div>
                        <br>
                        <p>Họ Và Tên</p>
                        <input type="text" class="form-control" style="width: 200px" placeholder="Họ Tên">
                        <br>
                        <p>Số Điện Thoại</p>
                        <input type="text" class="form-control" style="width: 200px" placeholder="SĐT">
                        <br>
                        <button id="btnpay">Tiến Hành Thanh Toán</button>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-4" >

                    <?php
                    $movie = $func->get_movie_from_id($_GET['movie_id']);
                   // $data = json_decode(json_encode($movie), true);
                    ?>
                    <form action="<?=$current_link?>" method="post">
                    <p style="font-size: 25px"><?=$movie->movie_name?></p>
                    <br>
                    <img src="<?='admin/'.$movie->cover_image?>" height="auto" width="200">
                    <p><?="Ngày: ".$date?></p>
                    <p><?="Rạp: ".$func->get_cinema_name($cinema)?></p>
                    <p><?="Suất Chiếu: ".$time?></p>
                    <p>Giá Vé: </p>
                    <p id="price" style="font-size: 25px"><?=$price?></p>
                    <p>Tổng Số Tiền Thanh Toán</p>
                    <p id="total" style="font-size: 25px; color: #ec6f43">0</p>
                        <input type="text" id="hidPayment" name="payment_total" hidden="hidden">
                    <button id="btn" type="submit">Thanh Toán Ngay</button>
                    </form>


                </div>
                <div class="col-md-8" style="background: rgb(255,155,38); height: 500px;">
                    <div style="margin: 30px 30px 30px 30px;background: white; height: 430px; width: auto; padding-top: 10px; padding-bottom: 10px " >
                        <div style="height: auto">
                        <div class="col-md-1">
                            <button class="form-control side">A</button>
                            <button class="form-control side">B</button>
                            <button class="form-control side">C</button>
                            <button class="form-control side">C</button>
                            <button class="form-control side">D</button>
                            <button class="form-control side">E</button>
                            <button class="form-control side">F</button>
                            <button class="form-control side">G</button>
                            <button class="form-control side">H</button>
                            <button class="form-control side">I</button>
                        </div>
                        <div class="col-md-10">
                            <?php
                                for($i = 0; $i<10; $i++)
                                {
                                    for($j = 0; $j<15; $j++)
                                    {
                                        ?>
                                            <button class="form-control item" value ="<?=$i*15+$j?>"><?=$j?></button>
                                        <?php
                                    }
                                }
                            ?>
                            <br><br>
                            <div>
                            <button style="height: 15px; width: 10px;float: left; margin-right: 10px;background: #ec030f; "></button><p>Ghế Đã Được Chọn</p>
                            <button style="height: 15px; width: 10px; float:left;margin-right: 10px;background: #ffb23d;"></button><p>Ghế Có Thể Chọn</p>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <button class="form-control side">A</button>
                            <button class="form-control side">B</button>
                            <button class="form-control side">C</button>
                            <button class="form-control side">C</button>
                            <button class="form-control side">D</button>
                            <button class="form-control side">E</button>
                            <button class="form-control side">F</button>
                            <button class="form-control side">G</button>
                            <button class="form-control side">H</button>
                            <button class="form-control side">I</button>
                        </div>
                    </div>
                    </div>
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

