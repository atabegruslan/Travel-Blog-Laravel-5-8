<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Events\ActionLogEvent;

class ActionLogController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('log.read')) 
        {
            abort(403);
        }

        $logs = ActionLog::orderBy('time', 'ASC')->get()->all();

        foreach($logs as $log)
        {
            $log['params'] = unserialize($log['params']);
        }

        return view('log.index', ['logs' => $logs]);
    }

    public function restore(Request $request)
    {
        if (!auth()->user()->hasRole('Admin')) 
        {
            abort(403);
        }

        $logId         = $request->input('log_id');
        $log           = ActionLog::where('id', $logId)->first()->getAttributes();
        $log['params'] = unserialize($log['params']);

        switch ($log['method']) 
        {
            case 'update_pivot':
                $entry    = $log['model']::where($log['params']['parent_key_name'], $log['record_id'])->first();
                $syncData = [];

                foreach ($log['params']['before'] as $relation) 
                {
                    $relatedKeyName       = $log['params']['related_key_name'];
                    $relatedId            = $relation->$relatedKeyName;
                    $syncData[$relatedId] = (array) $relation;
                }

                $relation = $log['params']['relation'];
                $entry->$relation()->sync($syncData);

                $newBefore               = $log['params']['after'];
                $newAfter                = $log['params']['before'];
                $log['params']['before'] = $newBefore;
                $log['params']['after']  = $newAfter;
                $entry                   = new ActionLog;
                $entry->user_id          = $log['user_id'];
                $entry->user_name        = $log['user_name'];
                $entry->model            = $log['model'];
                $entry->table_name       = $log['table_name'];
                $entry->method           = $log['method'];
                $entry->record_key_name  = $log['record_key_name'];
                $entry->record_id        = $log['record_id'];
                $entry->params           = serialize($log['params']);

                $entry->save();

                break;
            case 'create':
                $entry = $log['model']::where($log['record_key_name'], $log['record_id'])->first();

                $entry->delete();

                break;
            case 'update':
                $entry   = $log['model']::where($log['record_key_name'], $log['record_id'])->first();
                $updates = array();

                foreach ($log['params']['before'] as $key => $value) 
                {
                    if ($key !== $log['record_key_name'])
                    {
                        $updates[$key] = $value;
                    }
                }

                $entry->update($updates);

                break;
            case 'delete':
                $entry = new $log['model'];

                foreach ($log['params']['before'] as $key => $value) 
                {
                    if ($key !== $log['record_key_name'])
                    {
                        $entry->$key = $value;
                    }
                }

                $entry->save();

                break;
            case 'soft_delete':
                $entry = $log['model']::onlyTrashed()->where($log['record_key_name'], $log['record_id'])->first();

                DB::table($log['table_name'])
                    ->where($log['record_key_name'], $log['record_id'])
                    ->update([$entry->getDeletedAtColumn() => null]);

                $newBefore               = $log['params']['after'];
                $newAfter                = $log['params']['before'];
                $log['params']['before'] = $newBefore;
                $log['params']['after']  = $newAfter;

                event(new ActionLogEvent($log['model'], $log['table_name'], 'create', $log['record_key_name'], $log['record_id'], $log['params']));

                break;
            default:
                
        }

        DB::table('action_log')
            ->where('id', $logId)
            ->update(['is_restored' => 1]);

        return redirect('log');
    }
}
