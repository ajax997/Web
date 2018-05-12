<?php



    class Movie{
        public $id;
        public $movie_name;
        public $country;
        public $producer;
        public $cast;
        public $type;
        public $show_date;
        public $plot;
        public $status;
        public $trailer_url;
        public $cover_image;
        public $poster;
        public $director;

        /**
         * Movie constructor.
         * @param $id
         * @param $movie_name
         * @param $country
         * @param $producer
         * @param $cast
         * @param $type
         * @param $show_date
         * @param $plot
         * @param $status
         * @param $trailer_url
         * @param $cover_image
         * @param $poster

         */
        public function __construct($id, $movie_name, $country, $producer, $cast, $type, $show_date, $plot, $status, $trailer_url, $cover_image, $poster)
        {
            $this->id = $id;
            $this->movie_name = $movie_name;
            $this->country = $country;
            $this->producer = $producer;
            $this->cast = $cast;
            $this->type = $type;
            $this->show_date = $show_date;
            $this->plot = $plot;
            $this->status = $status;
            $this->trailer_url = $trailer_url;
            $this->cover_image = $cover_image;
            $this->poster = $poster;

        }


    }

    class PlaySchedule{

        public $movie;
        public $date;
        public $cinema;
        public $shift;
        public $booking_located;
        public $format;
        public $price;

        /**
         * PlaySchedule constructor.
         * @param $movie
         * @param $date
         * @param $cinema
         * @param $shift
         * @param $booking_located
         * @param $format
         * @param $price
         */
        public function __construct($movie, $date, $cinema, $shift, $booking_located, $format, $price)
        {
            $this->movie = $movie;
            $this->date = $date;
            $this->cinema = $cinema;
            $this->shift = $shift;
            $this->booking_located = $booking_located;
            $this->format = $format;
            $this->price = $price;
        }


    }


    class Cinema{
        public $id;
        public $name;

        /**
         * Cinema constructor.
         * @param $id
         * @param $name
         */
        public function __construct($id, $name)
        {
            $this->id = $id;
            $this->name = $name;
        }


    }

    class Staff{
        public $phone;
        public $name;
        public $pass;
        public $in_cinema;
        public $role;

        /**
         * Staff constructor.
         * @param $name
         * @param $phone
         * @param $pass
         * @param $role
         * @param $in_cinema
         */
        public function __construct($name, $phone, $pass, $in_cinema, $role)
        {
            $this->name = $name;
            $this->phone = $phone;
            $this->pass = $pass;
            $this->in_cinema = $in_cinema;
            $this->role = $role;
        }
    }


    class User{
        public $email;
        public $phone;
        public $name;
        public $pass;

        public function __construct($email, $name,$phone,$pass)
        {
            $this->phone = $phone;
            $this->name = $name;
            $this->email = $email;
            $this->pass = $pass;
        }
    }
 
    class Response{

        public static $SUCCESS = 1;
        public static $FAILED = 0;
        public static $ERROR = -1;

        public $status;
        public $message;
        public $data;

        public function __construct()
        {
        }

    }

