<?php

    use Carbon\Carbon;

    function format_date($date, $format = 'd/m/Y')
    {
        return Carbon::parse($date)->format($format);
    }
