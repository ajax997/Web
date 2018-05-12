<?php
/**
 * Created by PhpStorm.
 * User: nguyennghi
 * Date: 5/6/18
 * Time: 7:03 PM
*/

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Function.php');

$func = new Functions();

echo $func->get_staff_name('nguyennghi1997@outlook.com');


