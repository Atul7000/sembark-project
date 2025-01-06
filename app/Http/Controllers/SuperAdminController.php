<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
    public function showInviteForm()
    {
        return view('superadmin.invite');
    }

    public function sendInvite(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:invitations',
            'client_name' => 'required|string|max:255',
        ]);

        $client = Client::firstOrCreate(['name' => $request->client_name]);

        $token = Str::random(32);
        $expiresAt = Carbon::now()->addMinutes(30);

        $invitation = Invitation::create([
            'email' => $request->email,
            'token' => $token,
            'role' => 'client_admin',
            'client_id' => $client->id,
            'expires_at' => $expiresAt,
        ]);

        Mail::to($request->email)->send(new \App\Mail\InviteMail($invitation));
        return redirect()->back()->with('success', 'Invitation sent successfully.');
    }

    public function viewClients()
    {
        $clients = Client::with('users')->get();
        return view('superadmin.clients', compact('clients'));
    }

    public function viewAllUrls()
    {
        $urls = \App\Models\Url::paginate(10);
        return view('superadmin.urls', compact('urls'));
    }
}
