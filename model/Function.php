<?php
/**
 * Created by PhpStorm.
 * User: nguyennghi
 * Date: 5/6/18
 * Time: 7:00 PM
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/model/DbHelper.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/Model.php');



class Functions
{
    public $dbHelper;

    public function __construct()
    {
        $this->dbHelper = new DbHelper();
    }

    public function write_cookie($name, $value, $lifetime)
    {
        setcookie($name, $value, time() + $lifetime);
    }

    public function delete_cookie($name)
    {
        setcookie($name, "", time());
    }


    function insert_user($email, $phone, $name, $pass)
    {
        $pass = hash('ripemd160', $pass);
        $query = "INSERT INTO USER VALUES ('$email', '$phone', '$name', '$pass')";
        $res = $this->dbHelper->set($query, array());
        return $res;
    }

    public function insert_movie($id, $movie_name, $country, $producer, $cast, $type, $show_date, $plot, $status, $trailer_url, $cover_image, $poster)
    {
        // $query = "INSERT INTO movie VALUES (id = '$id', movie_name = '$movie_name', country = '$country', producer = '$producer', cast = '$cast', type = '$type',show_date = '$show_date', plot = '$plot', status = '$status', trailer_url = '$trailer_url', cover_image = '$cover_image', poster = '$poster')";
        $query = "INSERT INTO movie VALUES ('$id', '$movie_name','$country', '$producer', '$cast', '$type','$show_date', '$plot', '$status', '$trailer_url', '$cover_image', '$poster')";
        echo $query;
        $res = $this->dbHelper->set($query, array());
        return $res;
    }

    public function insert_schedule($movie, $date, $cinema, $shift, $booking_located, $format, $price)
    {
        $query = "INSERT INTO schedule VALUES ('$movie', '$date', '$cinema', '$shift', '$booking_located', '$format', '$price')";
        $res = $this->dbHelper->set($query, array());
        return $res;
    }

    public function insert_cinema($id, $name)
    {
        $query = "INSERT INTO cinema VALUES ('$id', '$name')";
        $res = $this->dbHelper->set($query, array());
        return $res;
    }


    public function insert_staff($email, $name, $pass, $in_cinema, $role)
    {
        $pass = hash('ripemd160', $pass);
        $query = "INSERT INTO staff VALUES ('$email', '$name', '$pass', '$in_cinema', '$role')";
        $res = $this->dbHelper->set($query, array());
        return $res;
    }

    function check_login($email, $pass)
    {
        $pass = hash('ripemd160', $pass);
        $query = "SELECT * FROM USER WHERE email = '$email' and password = '$pass'";
        $res = $this->dbHelper->get($query, array());
        if ($res != Response::$FAILED)
            //TODO return what?
            return true;
        else
            return false;
    }

    function staff_login($email, $pass)
    {
        $pass = hash('ripemd160', $pass);
        $query = "SELECT * FROM staff WHERE email = '$email' and pass = '$pass'";
        $res = $this->dbHelper->get($query, array());
        if ($res != Response::$FAILED)
            //TODO return what?
            return true;
        else
            return false;
    }


    public function get_all_movies()
    {
        $query = "SELECT * FROM movie";
        return $this->dbHelper->get($query, array());
    }

    public function get_current_movies()
    {
        $query = "SELECT * FROM movie where status = 0";
        return $this->dbHelper->get($query, array());
    }

    /**
     * @param $id
     * @return Movie
     */
    public function get_movie_from_id($id)
    {
        $query = "SELECT * FROM movie WHERE id = '$id'";
        $movie = $this->dbHelper->get($query, array());
        $data = json_decode(json_encode($movie[0]), true);
        $movieObj = new Movie($data['id'], $data['movie_name'], $data['country'], $data['producer'], $data['cast'], $data['type'], $data['show_date'], $data['plot']
            , $data['status'], $data['trailer_url'], $data['cover_image'], $data['poster']);

        return $movieObj;

    }

    public function remove_schedule($cinema, $date, $time)
    {
        $query = "delete from schedule where cinema = '$cinema' and date = '$date' and shift = '$time'";
        $this->dbHelper->set($query, array());

    }


    public function get_all_cinema()
    {
        $query = "SELECT * FROM cinema";
        return $this->dbHelper->get($query, array());
    }

    public function get_available_movie_from_id($id)
    {
        $query = "SELECT distinct cinema FROM schedule WHERE movie_id = '$id' ";
        return $this->dbHelper->get($query, array());
    }


     //ID
     public function get_current_movie_from_id($id)
     {
         $query = "SELECT * FROM schedule WHERE movie_id = '$id' ";
         return $this->dbHelper->get($query, array());
     }
    public function get_current_movie_from_id_cinema($id, $cinema)
    {
        $query = "SELECT * FROM schedule WHERE movie_id = '$id' and cinema = '$cinema' ";
        return $this->dbHelper->get($query, array());
    }
    public function get_current_movie_from_id_cinema_date($id, $cinema, $date)
    {
        $query = "SELECT * FROM schedule WHERE movie_id = '$id' and cinema = '$cinema' and date = '$date'";
        return $this->dbHelper->get($query, array());
    }


     //CINEMA
    public function get_current_movie_from_cinema($cinema)
    {
        $query = "SELECT distinct movie_id FROM schedule WHERE cinema = '$cinema' ";
        return $this->dbHelper->get($query, array());
    }
    public function get_current_movie_from_cinema_movie($cinema, $movie)
    {
        $query = "SELECT * FROM schedule WHERE movie_id = '$movie' and cinema = '$cinema'";
        return $this->dbHelper->get($query, array());
    }
    public function get_current_movie_from_cinema_date_id($cinema, $date, $id)
    {
        $query = "SELECT * FROM schedule WHERE cinema = '$cinema' and date = '$date' and movie_id = '$id'";
        return $this->dbHelper->get($query, array());
    }


    //DATE
    public function get_current_movie_from_date($date)
    {
        $query = "SELECT * FROM schedule WHERE date = '$date' ";
        return $this->dbHelper->get($query, array());
    }
    public function get_current_movie_from_date_cinema($date, $cinema)
    {
        $query = "SELECT * FROM schedule WHERE date = '$date' and cinema = '$cinema' ";
        return $this->dbHelper->get($query, array());
    }
    public function get_current_movie_from_date_cinema_id($date, $cinema, $id)
    {
        $query = "SELECT * FROM schedule WHERE date = '$date' and cinema = '$cinema' and movie_id = '$id' ";
        return $this->dbHelper->get($query, array());
    }


    public function get_staff_name($email)
    {
        $query = "SELECT * FROM staff WHERE email = '$email' ";
        $res = $this->dbHelper->get($query, array());
         if(is_array($res))
         {
            $staff =  json_decode(json_encode($res[0]), true);
            return $staff['name'];
         }
    }
    public function get_staff_cinema($email)
    {
        $query = "SELECT * FROM staff WHERE email = '$email' ";
        $res = $this->dbHelper->get($query, array());
        if(is_array($res))
        {
            $staff =  json_decode(json_encode($res[0]), true);
            return $staff['in_cinema'];
        }
    }

    public function get_cinema_name($cinema_id)
    {
        $query = "SELECT * FROM cinema WHERE id = '$cinema_id' ";

        $res = $this->dbHelper->get($query, array());
        if(is_array($res))
        {
            $staff =  json_decode(json_encode($res[0]), true);
            return $staff['name'];
        }
    }


    public function upload_image($name, $temp)
    {
        $upload_dir = 'images/';
        $upload_file = $upload_dir . basename($name);

        if (move_uploaded_file($temp, $upload_file)) {
            echo "File is valid, and was successfully uploaded.\n";
        } else {
            echo "Upload failed";
        }
        return $upload_file;
    }




}

