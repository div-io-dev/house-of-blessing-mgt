<?php


namespace App\Helpers;

use App\Models\ActivityLog as ActivityLogModel;

class ActivityLog
{
    public static function addToLog($request, $action, $subject_id = null, $loggable_type = null)
    {
        $log = [];

        $log['action'] = $action;

        $log['url'] = $request->fullUrl();

        $log['subject_id'] = $subject_id;

        $log['loggable_type'] = $loggable_type;

        $log['method'] = $request->method();

        $log['ip'] = $request->ip();

        $log['agent'] = $request->header('user-agent');

        $log['user_id'] = auth()->check() ? auth()->user()->id : null;

        ActivityLogModel::create($log);
    }


    public static function logActivityLists()
    {
        return ActivityLogModel::latest()->get();
    }
}
