<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

function setActive($uri, $output = 'active')
{
    if (is_array($uri)) {
        foreach ($uri as $u) {
            if (Route::is($u)) {
                return $output;
            }
        }
    } else {
        if (Route::is($uri)) {
            return $output;
        }
    }
}

function setActive_($uri, $output = 'active')
{
    if (is_array($uri)) {
        foreach ($uri as $u) {
            if (URL::current($u)) {
                return $output;
            }
        }
    } else {
        if (URL::current($uri)) {
            return $output;
        }
    }
}