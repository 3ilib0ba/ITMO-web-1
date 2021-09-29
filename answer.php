<?php
require_once("json_encode.php");

session_start();

if (!isset($_SESSION['requests']) || !is_array($_SESSION['requests'])) {
    $_SESSION['requests'] = [];
}

function validateX($xVal)
{
    $xValArray = array("-3", "-2", "-1", "0", "1", "2", "3", '4', "5");
    if (isset($xVal)) {
        if (in_array($xVal, $xValArray))
            return true;
    }
    return false;
}

function validateY($yVal)
{
    if (!isset($yVal))
        return false;
    else {
        $numY = str_replace(',', '.', $yVal);
        return is_numeric($numY) && $numY > -5 && $numY < 3;
    }
}

function validateR($rVal)
{
    if (!isset($rVal))
        return false;
    else {
        // $rValArray = array(1, 1.5, 2, 2.5, 3);
        if ($rVal < 0)
            return false;
        else
            return true;
    }
}

function validateForm($xVal, $yVal, $rVal)
{
    return validateX($xVal) && validateY($yVal) && validateR($rVal);
}

function checkHit($xVal, $yVal, $rVal)
{
    $count = 0;
    if ($xVal >= 0 && $yVal >= 0) {
        if ($xVal <= $rVal / 2 && $yVal <= $rVal) {
            $count = $count + 1;
        }
    }
    if ($xVal > 0 && $yVal < 0) {
        if ($xVal - $yVal <= $rVal / 2) {
            $count = $count + 1;
        }
    }
    if ($xVal <= 0 && $yVal <= 0) {
        if ($xVal * $xVal + $yVal * $yVal <= $rVal * $rVal) {
            $count = $count + 1;
        }
    }

    return !($count == 0);
}

// main script logic

$xVal = $_POST['x'];
$yVal = $_POST['y'];
$rVal = $_POST['r'];

$timezone = $_POST['timezone'];
$results = array();

$isValid = validateForm($xVal, $yVal, $rVal);
$isHit = checkHit($xVal, $yVal, $rVal);
$currentTime = date('H:i:s', time() - $timezone * 60);
$executionTime = round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 7);

array_push($results, array(
    "validate" => $isValid,
    "x" => $xVal,
    "y" => $yVal,
    "r" => $rVal,
    "currentTime" => $currentTime,
    "execTime" => $executionTime,
    "isHit" => $isHit
));

if ($isValid) {
    array_unshift($_SESSION['requests'], [
        "x" => $xVal,
        "y" => $yVal,
        "r" => $rVal,
        "res" => $isHit,
        "date" => $currentTime,
        "runtime" => $executionTime
    ]);
}

echo toJSON($results);
?>