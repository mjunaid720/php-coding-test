<?php

require 'Database.php';
require 'lib/inc.php';
require 'helpers.php';
require 'Constants.php';

try {
    /*
     * get values from url
     */
    $debug = filter_input(INPUT_GET, 'debug', FILTER_SANITIZE_NUMBER_FLOAT);
    $site = filter_input(INPUT_GET, 'site', FILTER_SANITIZE_NUMBER_FLOAT);

    if ($debug === Constants::PHP_INFO) {
        phpinfo();
    } elseif ($debug === Constants::ERROR_REPORTING_ALL) {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

    $paramList = [];
    $data = [];
    $db = new Database();
    ($site !== '' && $site !== null) ? $data = $db->getWebsiteById($site) : $data = $db->getWebsites();
    $result = domainStatus($data);
    $uuid = getMyUuid();
    echo $result;
    echo br() . "Your unique UUID is $uuid" . br();

} catch (Exception $e) {
    echo $sql . '<br>' . $e->getMessage();
    header("Location: error.php?msg=$message");
    die();
}



