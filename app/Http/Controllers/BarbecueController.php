<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            'format' => 'required|string|max:255',
        ]);

        $date = Carbon::createFromFormat('d/m/Y H:i', $validated['date'])->format('Y-m-d H:i:s');

        try {
            // Criação do novo churrasco
            Barbecue::create([
                'participants' => $validated['participants'],
                'address' => $validated['address'],
                'date' => $date,
                'format' => $validated['format'],
                'user_id' => Auth::id(),
            ]);
            Log::info('Barbecue created successfully.');
            return redirect()->route('barbecues.index')->with('success', 'Churrasco criado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Error creating barbecue: ' . $e->getMessage());
            return redirect()->back()->withErrors('Ocorreu um erro ao criar o churrasco.')->withInput();
        }
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

        $validated = $request->validate([
            'address' => 'string|max:255',
            'date' => 'required|date_format:d/m/Y H:i',
            'format' => 'string|max:255',
        ]);

        Log::debug('Request data: ' . json_encode($validated));

        // Converte a data para o formato correto
        $validated['date'] = Carbon::createFromFormat('d/m/Y H:i', $validated['date'])->format('Y-m-d H:i:s');

        $barbecue->update($validated);

        Log::info('Barbecue updated successfully for ID ' . $barbecue->id);

        return redirect()->back()->with('success', 'Churrasco atualizado com sucesso!');
    }
}
