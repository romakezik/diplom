<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class PhoneController extends Controller
{
    /**
     * Update the user's phone number.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatephone_number', [
            'current_phone_number' => ['required', 'numeric'],
            'phone_number' => ['required', 'numeric'],
        ]);

        $request->user()->update([
            'phone_number' => $validated['phone_number'],
        ]);

        return back()->with('status', 'phone-number-updated');
    }
}
