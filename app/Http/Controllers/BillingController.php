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
                      ->whereIn('transaction_status', ["Ready For Pickup/Payment","For Payment Approval"]); // Correctly checking transaction_status here
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

   public function update(Request $request, $id)
{
    $billing = Billing::find($id);

    if (!$billing) {
        return response()->json(['success' => false, 'message' => 'Billing record not found'], 404);
    }

    $billing->booking->update([
        'transaction_status' => "For Payment Approval",
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
