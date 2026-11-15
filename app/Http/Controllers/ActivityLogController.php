<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        // Filter berdasarkan jenis aktivitas
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Pencarian aktivitas
        if ($request->filled('search')) {
            $query->where(
                'description',
                'like',
                '%' . $request->search . '%'
            );
        }

        $logs = $query->paginate(15)->withQueryString();

        return view('activity_logs.index', compact('logs'));
    }

    public function show(ActivityLog $activityLog)
    {
        $activityLog->load('user');

        return view('activity_logs.show', compact('activityLog'));
    }
}