<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckBookingRequest;
use App\Http\Requests\StoreCustomerDataRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\StoreRatingRequest;
use App\Models\ProductTransaction;
use App\Models\Shoe;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function saveOrder(StoreOrderRequest $request, Shoe $shoe)
    {
        $validated = $request->validated();
        $validated['shoe_id'] = $shoe->id;
        $this->orderService->beginOrder($validated);

        return redirect()->route('front.booking', $shoe->slug);
    }

    public function booking()
    {
        $data = $this->orderService->getOrderDetails();
        // dd($data);
        return view('order.order', $data);
    }

    public function customerData()
    {
        $data = $this->orderService->getOrderDetails();
        // dd($data);
        return view('order.customer_data', $data);
    }

    public function saveCustomerData(StoreCustomerDataRequest $request)
    {
        $validated = $request->validated();
        $this->orderService->updateCustomerData($validated);

        return redirect()->route('front.payment');
    }

    public function payment()
    {
        $data = $this->orderService->getOrderDetails();
        // dd($data);
        return view('order.payment', $data);
    }

    public function paymentConfirm(StorePaymentRequest $request)
    {
        $validated = $request->validated();
        $productTransactionId = $this->orderService->paymentConfirm($validated);
        if($productTransactionId){
            return redirect()->route('front.order_finished', $productTransactionId);
        }

        return redirect()->route('front.index')->withErrors(['error' => 'Payment failep please try again']);
    }

    public function orderFinished(ProductTransaction $productTransaction)
    {
        return view('order.order_finished',compact('productTransaction'));
    }

    
    public function checkBooking()
    {
        return view('order.my_order');
    }

    public function checkBookingDetails(StoreCheckBookingRequest $request)
    {
        $validated = $request->validated();

        $orderDetails = $this->orderService->getMyOrderDetails($validated);
        // dd($orderDetails);
        if($orderDetails){
            return view('order.my_order_details', compact('orderDetails'));
        }
        return redirect()->route('front.index')->withErrors(['error' => 'Order not found']);
    }
    public function saveRating(StoreRatingRequest $request)
    {
        $validated = $request->validated();
        $validated['product_transaction_id'] = $request->product_transaction_id;
        $validated['shoe_id'] = $request->shoe_id;

        $rating = $this->orderService->saveRating($validated);
        
        if (!$rating) {
            return redirect()->route('front.index')->withErrors(['error' => 'Rating failed']);
        }

        return redirect()->route('front.check_booking')->with('success', 'Rating saved successfully');
    }
}   
