<?php

namespace App\Traits;

trait AuditTrait
{
    public static function bootAuditTrait(): void
    {
        static::creating(function ($model) {
            if (!auth()->check()) {
                return;
            }
            $model->created_by = auth()->user()->id;
            $model->updated_by = auth()->user()->id;
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->user()->id;
        });
    }
}
