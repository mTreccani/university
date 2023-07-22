<?php

use Carbon\Carbon;


    if (!function_exists('format_date')) {
        function format_date($date): string
        {
            if (!isset($date)) {
                return '';
            }
            return Carbon::parse($date)->format('d/m/Y');
        }
    }

    if (!function_exists('format_time')) {
        function format_time($date): string
        {
            if (!isset($date)) {
                return '';
            }
            return Carbon::parse($date)->format('H:i');
        }
    }

    if (!function_exists('format_date_time')) {
        function format_date_time($date): string
        {
            if (!isset($date)) {
                return '';
            }
            return Carbon::parse($date)->format('d/m/Y H:i');
        }
    }

    if (!function_exists('tomorrow')) {
        function tomorrow(): string
        {
            return Carbon::now()->addDay()->format('Y-m-d');
        }
    }

    if (!function_exists('isBeforeOrEqualNow')) {
        function isBeforeOrEqualNow($date): bool
        {
            return Carbon::parse($date)->lte(Carbon::now());
        }
    }

    if (!function_exists('remove_date_seconds')) {
        function remove_date_seconds($date): ?string
        {
            if (!isset($date)) {
                return null;
            }
            return Carbon::parse($date)->format('Y-m-d H:i');
        }
    }

    if (!function_exists('remove_time_seconds')) {
        function remove_time_seconds($date): ?string
        {
            if (!isset($date)) {
                return null;
            }
            return Carbon::parse($date)->format('H:i');
        }
    }

