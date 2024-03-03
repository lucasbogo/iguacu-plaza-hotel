<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the logs with optional filters.
     */
    public function index(Request $request)
    {
        $query = Log::query();

        if ($request->filled('status')) {
            $query->status($request->status);
        }

        if ($request->filled('date')) {
            $query->date($request->date);
        }

        $logs = $query->with('receptionist')->latest()->get();

        return view('receptionist.logs.index', compact('logs'));
    }

    /**
     * Show the form for creating a new log.
     */
    public function create()
    {
        return view('receptionist.logs.create');
    }

    /**
     * Store a newly created log in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'status' => 'required|in:resolved,pending,cannot_be_resolved',
        ]);

        Log::create([
            'receptionist_id' => Auth::guard('receptionist')->id(),
            'message' => $request->message,
            'status' => $request->status,
        ]);

        return redirect()->route('receptionist.logs.index')->with('success', 'Log criado com successo.');
    }

    /**
     * Update the specified log in storage.
     */
    public function update(Request $request, Log $log)
    {
        $request->validate([
            'status' => 'required|in:resolved,pending,cannot_be_resolved',
        ]);

        $log->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Log atualizado com sucesso.');
    }

    public function edit(Log $log)
    {
        // Ensure the current receptionist can only edit their logs
        if ($log->receptionist_id != Auth::guard('receptionist')->id()) {
            return redirect()->route('receptionist.logs.index')->with('error', 'Acesso não autorizado.');
        }

        return view('receptionist.logs.edit', compact('log'));
    }
}
