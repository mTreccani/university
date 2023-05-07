<?php

use Carbon\Carbon;

function format_date($date): string
    {
        if (!isset($date)) {
            return '';
        }
        return Carbon::parse($date)->format('d/m/Y');
    }

    function format_time($date): string
    {
        if (!isset($date)) {
            return '';
        }
        return Carbon::parse($date)->format('H:i');
    }

    function format_date_time($date): string
    {
        if (!isset($date)) {
            return '';
        }
        return Carbon::parse($date)->format('d/m/Y H:i');
    }

    function tomorrow(): string
    {
        return Carbon::now()->addDay()->format('Y-m-d');
    }

    function isBeforeOrEqualNow($date): bool
    {
        return Carbon::parse($date)->gte(Carbon::now());
    }

