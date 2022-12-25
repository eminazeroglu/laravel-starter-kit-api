<?php

function helper(): \App\Helpers\Helper
{
    return (new \App\Helpers\Helper);
}

function translate($key = null, $search = null, $replace = null)
{
    return helper()->translate($key, $search, $replace);
}
