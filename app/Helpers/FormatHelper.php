<?php

namespace App\Helpers;

class FormatHelper
{
    public static function maskCpf($val)
    {
        return substr($val, 0, 3) . '.' . substr($val, 3, 3) . '.' . substr($val, 6, 3) . '-' . substr($val, 9, 2);
    }


    public static function maskRg($val)
    {
        return substr($val, 0, 1) . '.' . substr($val, 1, 3) . '.' . substr($val, 4, 3) . '-' . substr($val, 7, 1);
    }
}
