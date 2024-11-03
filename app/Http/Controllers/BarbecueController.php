<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import the Log facade
use App\Models\Barbecue;

class BarbecueController extends Controller
{
    public function index()
    {
        Log::info('BarbecueController: index method called.');

        $barbecues = Barbecue::where('user_id', Auth::id())->get();
        return view('barbecues.index', compact('barbecues'));
    }

    public function create()
    {
        Log::info('BarbecueController: create method called.');
        return view('barbecues.create');
    }

    public function store(Request $request)
    {
        Log::info('BarbecueController: store method called.');

        $validated = $request->validate([
            'participants' => 'required|integer|min:1',
            'address' => 'required|string|max:255',
            'date' => 'required|date_format:d/m/Y H:i',
            'radio-group' => 'required|string|max:255',
        ]);

        Log::info("Test  " . $request->input("radio-group"));

        try {
            // Criação do novo churrasco
            Barbecue::create([
                'participants' => $validated['participants'],
                'address' => $validated['address'],
                'date' => $validated['date'],
                'format' => $request->input('radio-group'),
                'user_id' => Auth::id(),
            ]);
            Log::info('Barbecue created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating barbecue: ' . $e->getMessage());
            return redirect()->back()->withErrors('Ocorreu um erro ao criar o churrasco.');
        }

        return redirect()->route('barbecues.index');
    }

    public function edit(Barbecue $barbecue)
    {
        Log::info('BarbecueController: edit method called for barbecue ID ' . $barbecue->id);

        if ($barbecue->user_id !== Auth::id()) {
            Log::warning('Unauthorized access attempt for barbecue ID ' . $barbecue->id);
            abort(403);
        }

        return view('barbecues.edit', compact('barbecue'));
    }

    public function update(Request $request, Barbecue $barbecue)
    {
        Log::info('BarbecueController: update method called for barbecue ID ' . $barbecue->id);

        if ($barbecue->user_id !== Auth::id()) {
            Log::warning('Unauthorized update attempt for barbecue ID ' . $barbecue->id);
            abort(403);
        }

        $request->validate([
            'participants' => 'required|integer|min:1',
            'address' => 'required|string|max:255',
            'date' => 'required|date',
            'radio-group' => 'required|string|max:255',
        ]);

        $barbecue->update($request->only(['participants', 'address', 'date', 'radio-group']));
        Log::info('Barbecue updated successfully for ID ' . $barbecue->id);

        return redirect()->route('barbecues.index');
    }
}
