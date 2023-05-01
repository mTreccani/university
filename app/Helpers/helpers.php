<?php

    use Carbon\Carbon;

    function format_date($date) {
        return Carbon::parse($date)->format('d/m/Y');
    }

    function format_time($date) {
        return Carbon::parse($date)->format('H:i');
    }

    function format_date_time($date) {
        return Carbon::parse($date)->format('d/m/Y H:i');
    }
