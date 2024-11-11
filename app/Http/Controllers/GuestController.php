<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Barbecue;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function show($id)
    {
        $barbecue = Barbecue::findOrFail($id);
        return view('guests.accept', compact('barbecue'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $barbecue = Barbecue::findOrFail($id);

        $existingGuest = $barbecue->guests()->where('email', $request->email)->first();
        if ($existingGuest) {
            return redirect()->back()->withErrors(['Este e-mail já está confirmado para este churrasco.'])->withInput();
        }

        Guest::create([
            'barbecue_id' => $barbecue->id,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('guests.confirmation', $barbecue->id)->with('success', 'Convidado confirmado com sucesso!');
    }

    public function destroy($guestId)
    {
        $guest = Guest::findOrFail($guestId);
        if ($guest->barbecue->user_id != Auth::id()) {
            return redirect()->route('barbecues.edit', $guest->barbecue->id)->withErrors('Você não tem permissão para remover este convidado.');
        }

        if ($guest->barbecue->payment_link_sent) {
            return redirect()->route('barbecues.edit', $guest->barbecue->id)->withErrors('Não é possível remover convidados de churrascos com convite já enviado.');
        }

        $guest->delete();

        return redirect()->route('barbecues.edit', $guest->barbecue->id)->with('success', 'Convidado removido com sucesso!');
    }
}
