<?php

namespace App\Livewire;

use App\Models\Shoe;
use App\Services\OrderService;
use Livewire\Component;

class OrderForm extends Component
{
    public Shoe $shoe;
    public $orderData;
    public $subTotalAmount;
    public $promoCode = null;
    public $promoCodeId = null;
    public $quantity = 1;
    public $discount = 0;
    public $grandTotalAmount = 0;
    public $totalDiscountAmount = 0;
    public $name;
    public $email;

    protected $orderService;

    public function boot(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function mount(Shoe $shoe, $orderData)
    {
        $this->shoe = $shoe;
        $this->orderData = $orderData;
        $this->subTotalAmount = $shoe->price;
        $this->grandTotalAmount = $shoe->price;
    }

    public function updatedQuantity()
    {
        $this->validateOnly('quantity',[
            'quantity' => 'required|numeric|min:1|max:'.$this->shoe->stock,
        ],[
            'quantity.max' => 'Stock Tidak Tersedia!',
        ]);
        $this->calculateTotal();
    }

    protected function calculateTotal()
    {
        $this->subTotalAmount = $this->shoe->price * $this->quantity;
        $this->grandTotalAmount = $this->subTotalAmount - $this->discount;
    }

    
    public function incrementQuantity()
    {
        if ($this->quantity < $this->shoe->stock) {
            $this->quantity++;
            $this->calculateTotal();
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->calculateTotal();
        }
    }


    public function updatedPromoCode()
    {
        $this->applyCodePromo();
    }

    protected function applyCodePromo()
    {
        if(!$this->promoCode){
            $this->resetDiscount();
            return;
        }

        $result = $this->orderService->applyPromoCode($this->promoCode, $this->subTotalAmount);

        if(isset($result['error'])){
            session()->flash('error', $result['error']);
            $this->resetDiscount();
        } else{
            session()->flash('message', 'Kode Promo Berhasil Diterapkan!');
            $this->discount = $result['discount'];
            $this->promoCodeId = $result['promoCodeId'];
            $this->calculateTotal();
            $this->totalDiscountAmount = $result['discount'];
        }
    }

    protected function resetDiscount()
    {
        $this->discount = 0;
        $this->calculateTotal();
        $this->promoCodeId = null;
        $this->totalDiscountAmount = 0;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|numeric|min:1|max:'.$this->shoe->stock,
        ];
    }

    protected function getterBookingData(array $validatedData): array
    {
        return [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'grand_total_amount' => $this->grandTotalAmount,
            'sub_total_amount' => $this->subTotalAmount,
            'discount' => $this->discount,
            'total_discount_amount' => $this->totalDiscountAmount,
            'promo_code' => $this->promoCode,
            'promo_code_id' => $this->promoCodeId,
            'quantity' => $this->quantity,
        ];
    }

    public function submit()
    {
        $validatedData = $this->validate();

        $bookingData = $this->getterBookingData($validatedData);
        $this->orderService->updateCustomerData($bookingData);

        return redirect()->route('front.customer_data');
    }


    public function render()
    {
        return view('livewire.order-form');
    }
}
