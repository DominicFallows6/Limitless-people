<?php

//Helper file created to mimic future version of laravel encrypt helpers

function encrypt($string)
{
    return Illuminate\Support\Facades\Crypt::encrypt($string);
}

function decrypt($string)
{
    return Illuminate\Support\Facades\Crypt::decrypt($string);
}