<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Milestone;
use App\Models\Payment;



class PaymentController extends Controller
{
    public function create(Milestone $milestone)
    {
        // Check status before showing payment form
        if ($milestone->status !== 'approved') {
            return redirect()
                ->back()
                ->with('error', 'Cannot process payment: Milestone must be in "approved" status');
        }

        return view('payments.create', ['milestone' => $milestone]);
    }

    public function store(Request $req, Milestone $milestone)
    {

        if ($milestone->status !== 'approved') {
        return back()->with('error', 'Payment can only be made for approved milestones');
    }
        // Logic to process the payment for the milestone
        // Validate and process payment here
        $incomingFields = $req->validate([
        'name' => ['required', 'string', 'max:255'],
        'card_number' => ['required', 'string', 'regex:/^\d{16}$/'],
        'expiry_month' => 'required|digits:2|min:1|max:12',
        'expiry_year' => 'required|digits:4|integer|min:' . date('Y'),
        'cvv' => ['required', 'string', 'regex:/^\d{3,4}$/'],
        'amount' => ['required', 'numeric', 'min:1'],
        ]);
        

        // Assuming payment processing is successful
        // $milestone->update(['status' => 'paid', 'paid_at' => now()]);
        $milestone->status = 'paid';
        $milestone->paid_at = now();
        $milestone->save();
        
        // Store payment details in the databases
        $incomingFields['milestone_id'] = $milestone->id;
        Payment::create($incomingFields);
        
        $project = $milestone->project;
        return response()->view('payments.success', ['projectId' => $milestone->project_id]);

        return redirect()->route('projects.show', $project)->with('success', "Payment successful!");
    }

    public function show(Milestone $milestone)
    {
        // Logic to show payment details for the milestone
        return view('payments.show', compact('milestoneId'));
    }
}
