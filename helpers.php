<?php

function newLine()
{
    return '';
}

function br()
{
    return '<br>';
}

function checkStatus($url)
{
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/cer/cacert.pem");
        $response =  curl_exec($ch);
        // Close curl handle
        curl_close($ch);
        return $response;
    } catch (Exception $e) {
        trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
    }
}

function getMyUuid()
{
    $uuid = Rhumsaa\Uuid\Uuid::uuid1();
    return $uuid->toString();
}

function domainStatus($data)
{
    $html = '';
    $arrLength = count($data);
    for ($i = 0; $i < $arrLength; ++$i) {
        if (checkStatus($data[$i]['url'])) {
            $html .= $data[$i]['url'] . ' <span style="color:green">&check;</span><br>';
        } else {
            $html .= $data[$i]['url'] . ' <span style="color:red">&cross;</span><br>';
        }
    }
    return $html;
}