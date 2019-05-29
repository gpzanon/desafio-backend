<?php

    function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = str_replace('-', '', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', trim($string)); // Removes special chars.
    }

    function connectionApi()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/api/public/usuario/']);
        return $client;        
    }
