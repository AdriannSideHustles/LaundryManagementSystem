<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with(['billing.booking']) // Load both billing and booking relationships
            ->whereHas('billing.booking', function($query) {
                $query->whereIn('transaction_status', ["For Payment Approval"]); // Check transaction_status in the booking
            })
            ->whereHas('billing.booking', function($query) {
                $query->where('staff_user_id', auth()->id()); // Check the staff_user_id in the booking
            })
            ->orderBy('created_at', 'desc')
            ->get(); 

        return view('staff.payment.index', compact('payments'));
    }

    public function completedTransactions()
    {
        $payments = Payment::with(['billing.booking'])
            ->whereHas('billing.booking', function($query) {
                $query->whereIn('transaction_status', ["Complete"]); 
            })
            ->whereHas('billing.booking', function($query) {
                $query->where('staff_user_id', auth()->id());
            })
            ->orderBy('created_at', 'desc')
            ->get(); 

        return view('staff.payment.completed', compact('payments'));
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
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);        

        // Add the price of the service to the response
        return response()->json([
            'id' => $payment->id,
            'price' => $payment->billing->booking->service->price, // Service price from the related models
            'image_url' => $payment->receipt_proof_imgUrl,
            'payment_method' => $payment->payment_method
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        $payment->billing->booking->update([
            'transaction_status' => "Complete",
        ]);

        return redirect()->route('staffPaymentApproval.index');
        return response()->json(['success' => 'Payment Approved successfully.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, $id)
    {
        $payment = Payment::find($id);
        $payment->billing->booking->update([
            'transaction_status' => "Ready For Pickup/Payment",
        ]);
        if ($payment->receipt_proof_imgUrl && Storage::disk('public')->exists($payment->receipt_proof_imgUrl)) {
            Storage::disk('public')->delete($payment->receipt_proof_imgUrl);
        }

        return redirect()->route('staffPaymentApproval.index');
        return response()->json(['success' => 'Payment Rejected successfully.']);
    }
}
