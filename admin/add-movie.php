<?php
/**
 * Created by PhpStorm.
 * User: nguyennghi
 * Date: 5/7/18
 * Time: 9:12 PM
 */
if(!isset($_COOKIE['admin_email']))
    header('Location: /admin/admin-login.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manager Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->

    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!--===============================================================================================-->

    <style>
        .container{
            position: absolute;
            top: 15%;
            left: 30%;
            bottom: 10%;
            padding-bottom: 40px;
            width: 500px;
            height: auto;

        }
        input{
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            border-radius: 10px;
            border: 1px solid #ffb23d;
        }
        .pane-title{
            background: #ffb23d;
            height: 70px;
        }
        .title{
            text-align: center;
            font-size: 30px;
            padding-top:10px;
        }

        .detail{
            padding-top: 5px;
            padding-bottom: 5px;
        }
    </style>
</head>

<body >

<div class="pane-title">
<p class="title">THÊM BỘ PHIM MỚI</p>
</div>
<form action="movie-schedule.php"  method="post" enctype="multipart/form-data">
<div class="container">
    <div class="detail">
        <p>ID</p>
        <input name="id"  class="form-control">
    </div>
    <div class="detail">
        <p>Tên Phim</p>
        <input name="movie_name"  class="form-control">
    </div>

    <div class="detail">
        <p>Quốc Gia</p>
        <input name="country" class="form-control">
    </div>

    <div class="detail">
        <p>Nhà Sản Xuất</p>
        <input name="producer" class="form-control">
    </div>

    <div class="detail">
        <p>Đạo Diễn</p>
        <input name="director" class="form-control">
    </div>
    <div class="detail">
        <p>Diễn Viên</p>
        <input name="cast" class="form-control">
    </div>
    <div class="detail">
        <p>Thể Loại</p>
        <input name="type" class="form-control">
    </div>
    <div class="detail">
        <p>Ngày Phát Hành</p>
        <input name="show_date" class="form-control">
    </div>

    <div class="plot">
        <p>Nội Dung Phim</p>
        <input name="plot" class="form-control" style="height: 100px">
    </div>

    <div class="detail">
        <p>Trailer Phim (URL)</p>
        <input name="trailer_url" class="form-control">
    </div>

    <div class="detail">
        <p>Cover Image</p>
        <input  name="cover_image" type="file"  id='cover_image' class="form-control">
    </div>

    <div class="detail">
        <p>Poster</p>
        <input name="poster" type="file" id='poster' class="form-control">
    </div>

    <div class="detail">
        <input name="status" type="checkbox" class="form-control" style="width: 30px"/> <p>Đang Công Chiếu</p>
    </div>

    <input type="submit" value="Thêm Phim" class="form-control" style="background: #ffa349">


    <div style="height: 50px">

    </div>

</div>
</form>

</body>
</html>



