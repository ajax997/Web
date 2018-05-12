<?php
/**
 * Created by PhpStorm.
 * User: nguyennghi
 * Date: 5/7/18
 * Time: 11:06 PM
 */


require_once($_SERVER['DOCUMENT_ROOT'].'/model/Function.php');
$func = new Functions();
$current_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(!isset($_COOKIE['admin_email']))
    header('Location: /admin/admin-login.php');
else
{
    $admin_email = $_COOKIE['admin_email'];
}




if(isset($_POST['id']))
    $id = $_POST['id'];

if(isset($_POST['movie_name']))
    $movie_name = $_POST['movie_name'];

if(isset($_POST['country']))
    $country = $_POST['country'];

if(isset($_POST['producer']))
    $producer = $_POST['producer'];

if(isset($_POST['director']))
    $director = $_POST['director'];

if(isset($_POST['cast']))
    $cast = $_POST['cast'];

if(isset($_POST['type']))
    $type = $_POST['type'];

if(isset($_POST['show_date']))
    $show_date = $_POST['show_date'];

if(isset($_POST['plot']))
    $plot = $_POST['plot'];

if(isset($_POST['trailer_url']))
    $trailer_url = $_POST['trailer_url'];

if(isset($_FILES['cover_image']))
    $cover_image = $func->upload_image($_FILES["cover_image"]["name"], $_FILES["cover_image"]["tmp_name"]);

if(isset($_FILES['poster']))
   $poster =  $func->upload_image($_FILES["poster"]["name"],$_FILES["poster"]["tmp_name"]);


if(isset($_POST['status']))
    $status = $_POST['status'];

if(isset($_POST['id']))
    $res = $func->insert_movie($id, $movie_name, $country, $producer,$cast, $type, $show_date, $plot, $status, $trailer_url, $cover_image, $poster );

//echo $id;
//echo $movie_name;
//echo $country;
//echo $producer;
//echo $type;
//echo $cast;
//echo $plot;
//echo $trailer_url;
//echo $poster;
//echo $cover_image;

if(isset($res))
if($res == Response::$SUCCESS)
{
    header("Location: movie-schedule.php?movie='$id'");
}

if(isset($_GET['movie']))
    $movie_id = $_GET['movie'];

if(isset($_POST['new_datetime']) && isset($_POST['new_gia_ve']))
{
    $newdatetime = $_POST['new_datetime'];
    for($i = 0; $i< strlen($newdatetime); $i++)
    {
        if($newdatetime[$i] == ' ')
        {
            $newdate = substr($newdatetime, 0, $i);
            $newtime = substr($newdatetime, $i+1, strlen($newdatetime)-$i);
            break;

        }
    }

    $newgiave = $_POST['new_gia_ve'];

    $cinema = $func->get_staff_cinema($admin_email);

    $func->insert_schedule($movie_id,$newdate,$cinema, $newtime, "", "", $newgiave);


}

if(isset($_POST['deletedate']) && isset($_POST['deletetime']))
{
    $cinema = $func->get_staff_cinema($admin_email);
    $func->remove_schedule($cinema, $_POST['deletedate'], $_POST['deletetime']);

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manager Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <style>
        label{
            margin-left: 20px;
        }

        #datepicker > span:hover{
            cursor: pointer;
        }
        hr{
            border: 1px solid #ffb23d;
        }
        li{
            text-decoration: none;
            list-style-type: none;
        }
        .panel-heading{
            background: #ff9b26;
            height: 40px;

        }
        .movie-item{
            margin: 10px 10px 10px 10px;

            height: 70px;


        }
        .list-group{
            border: 1px solid #ffbe33;
            border-radius: 5px;
            padding: 10px 10px 10px 10px;

        }


        #list-movie li a{


            text-decoration: none !important;
            font-size: 20px;

        }
        #list-movie li:hover{
            background: rgba(255, 178, 61, 0.28);
        }
        #new_schedule{
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 5px;

            padding: 10px 10px 10px 10px;
            border: 1px solid rgba(255, 155, 38, 0.3)
        }
        #btn_delete{
            color: white;
            background-color: #555;
        }
        #btn_delete:hover{
            background-color: #ec5543;
        }

    </style>
</head>
<body>



<div class="container" style="padding: 20px 20px 20px 20px;">
    <div class="row">
        <!-- cột 1 -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="panel-heading">
                <p>Danh Sách Phim</p>
            </div>
            <ul class="list-group" id = "list-movie">
                <?php
                $movies = $func->get_all_movies();
                foreach ($movies as $movie) {
                    $data = json_decode(json_encode($movie), true);
                    ?>
                    <li class="movie-item">
                        <img src="<?=$data['cover_image']?>" height="50px" width="80px" style="margin: 10px 10px 10px 10px">
                        <span><a href="movie-schedule.php?movie=<?=$data['id']?>"><?=$data['movie_name']?></a>
                        </span>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>

        <!-- cột 2 -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="panel-heading">
                <p>Danh Sách Lịch Chiếu Phim</p>
            </div>
            <form action="<?=$current_link?>" method="post" id="new_schedule">
                <div class="add-new-time">
                    <div class='input-group date' style="margin-top: 10px">
                        <input type='text' placeholder="Chọn Ngày - Xuất Chiếu" name="new_datetime" class="form-control datetimepicker" />
                        <span class="input-group-addon datetimepicker-addon">
                        <span class="glyphicon glyphicon-calendar"></span>

                    </span>
                    </div>
                    <div class="input-group">
                        <input type="text" style="margin-bottom: 10px; margin-top: 10px" placeholder="Giá Vé" name="new_gia_ve" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Thêm Xuất Chiếu</button>
                        </span>
                    </div>
                    <script>
                        $(function() {
                             $('.datetimepicker').datetimepicker();

                            $('.datetimepicker-addon').on('click', function() {
                            $(this).prev('input.datetimepicker').data('DateTimePicker').toggle();
                            });
                        });
                </script>
            </div>
            </form>
            <ul class="list-group">
                <?php
                $schedule = $func->get_current_movie_from_id($movie_id);
                foreach ($schedule as $shift) {
                    $data = json_decode(json_encode($shift), true);
                    ?>
                    <li class="schedule-item">
                        <form action="<?=$current_link?>" method="post">
                            <input hidden="hidden" name="deletedate" value="<?=$data['date']?>">
                            <input hidden="hidden" name="deletetime" value="<?=$data['shift']?>">

                            <p style="font-size: 20px">Ngày: <?=$data['date']?></p>
                            <p>Thời Gian: <?=$data['shift']?></p>
                            <p>Giá Vé: <?=$data['price']?></p>
                            <button class="form-control" id="btn_delete" style="width: 100px">Xóa</button>
                            <hr>
                        </form>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
</div>
</div>
</body>