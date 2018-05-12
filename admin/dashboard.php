<?php
/**
 * Created by PhpStorm.
 * User: nguyennghi
 * Date: 5/7/18
 * Time: 6:29 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/model/Function.php');
$func = new Functions();
if(isset($_COOKIE['admin_email']))
{
    $admin_email = $_COOKIE['admin_email'];
    $manager_name = $func->get_staff_name($admin_email);
    $in_cinema = $func->get_staff_cinema($admin_email);
    $cinema_name = $func->get_cinema_name($in_cinema);

    echo "<p>'$admin_email'</p>";
    echo "<p>'$manager_name'</p>";
    echo "<p>'$in_cinema'</p>";
    echo "<p>'$cinema_name'</p>";
}
else{
    header('Location: /admin/admin-login.php');
}

?>

