<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Payment;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billings = Billing::with(['booking'])
            ->whereHas('booking', function($query) {
                $query->where('customer_user_id', auth()->id())
                      ->whereIn('transaction_status', [4,5]); // Correctly checking transaction_status here
            })
            ->orderBy('created_at', 'desc')
            ->get(); 
    
        return view('customer.billing.index', compact('billings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function show(Billing $billing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $billing = Billing::find($id);
        return response()->json($billing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Billing  $billing
     * @return \Illuminate\Http\Response
     */

    // public function update(Request $request,$id)
    // {
    //     $billing = Billing::find($id);
    //     $billing->booking->update([
    //         'transaction_status' => 5,
    //     ]);

    //     $payment = Payment::where('billing_id', $id)->first();

    //     // If payment record does not exist, create a new payment record
    //     if ($payment === null) {
    //         // Payment::create([
    //         //     'billing_id' => $id,
    //         //     'payment_date' => now()->subHours(7), // Adjust the date as necessary
    //         //     'payment_method' => $request->payment_method,
    //         //     'receipt_proof_imgUrl' => null // Set this according to your requirement
    //         // ]);
    //         $payment = new Payment();
    //         $payment->billing_id = $request->billing_id;
    //         $payment->payment_date = $request->now()->subHours(7);
    //         $payment->payment_method = $request->payment_method;

    //         if ($request->hasFile('image_url')) {
    //             $image_url = $request->file('image_url');
    //             $imageName = time() . '_' . uniqid() . '.' . $image_url->getClientOriginalExtension();
                
    //             $imagePath = $image_url->storeAs('rewards', $imageName, 'public');
    //             $payment->receipt_proof_imgUrl = $imagePath;
    //         }

    //         $payment->save();
    //     } else {
    //         // If the payment record exists, you may want to update it instead
    //         $payment->update([
    //             'payment_method' => $request->payment_method,
    //             'payment_date' => now()->subHours(7) 
    //         ]);
    //     }

    // }
public function update(Request $request, $id)
{
    $billing = Billing::find($id);

    if (!$billing) {
        return response()->json(['success' => false, 'message' => 'Billing record not found'], 404);
    }

    $billing->booking->update([
        'transaction_status' => 5,
    ]);

    $payment = Payment::where('billing_id', $id)->first();

    if ($payment === null) {
        $payment = new Payment();
        $payment->billing_id = $id; 
        $payment->payment_date = now()->subHours(7);
        $payment->payment_method = $request->payment_method;

        if ($request->hasFile('image_url')) {
            $image_url = $request->file('image_url');
            $imageName = time() . '_' . uniqid() . '.' . $image_url->getClientOriginalExtension();
            $imagePath = $image_url->storeAs('receipts', $imageName, 'public');
            $payment->receipt_proof_imgUrl = $imagePath;
        }

        $payment->save();
    } else {
        $payment->payment_method = $request->payment_method;
        $payment->payment_date = now()->subHours(7);

        if ($request->hasFile('image_url')) {
            $image_url = $request->file('image_url');
            $imageName = time() . '_' . uniqid() . '.' . $image_url->getClientOriginalExtension();
            $imagePath = $image_url->storeAs('receipts', $imageName, 'public');
            $payment->receipt_proof_imgUrl = $imagePath;
        }

        $payment->save(); 
    }

    return response()->json(['success' => true, 'message' => 'Billing updated successfully']);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billing $billing)
    {
        //
    }
}
