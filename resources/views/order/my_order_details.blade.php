<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('output.css') }}" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div
      class="relative flex flex-col w-full max-w-[640px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]"
    >
      <div
        id="top-bar"
        class="flex justify-between items-center px-4 mt-[60px]"
      >
        <a href="{{ route('front.check_booking') }}">
          <img
            src="{{ asset('assets/images/icons/back.svg')}}"
            class="w-10 h-10"
            alt="icon"
          />
        </a>
        <p class="font-bold text-lg leading-[27px]">Booking Details</p>
        <div class="dummy-btn w-10"></div>
      </div>
      <section
        id="your-order"
        class="accordion flex flex-col rounded-[20px] p-4 pb-5 gap-5 mx-4 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px]"
      >
        <label class="group flex items-center justify-between">
          <h2 class="font-bold text-xl leading-[30px]">Your Order</h2>
          <img
            src="{{ asset('assets/images/icons/arrow-up.svg')}}"
            class="w-7 h-7 transition-all duration-300 group-has-[:checked]:rotate-180"
            alt="icon"
          />
          <input type="checkbox" class="hidden" />
        </label>
        <div class="flex items-center gap-[14px]">
          <div
            class="flex shrink-0 w-20 h-20 rounded-[20px] bg-[#D9D9D9] p-1 overflow-hidden"
          >
            <img
              src="{{ Storage::disk('s3')->url($orderDetails->shoe->photos()->latest()->first()->photo ) }}"
              class="w-full h-full object-contain"
              alt=""
            />
          </div>
          <h3 class="font-bold text-lg leading-6">
            {{ $orderDetails->shoe->name }}
          </h3>
        </div>
        <hr class="border-[#EAEAED]" />
        <div class="flex items-center justify-between">
          <p class="font-semibold">Brand</p>
          <p class="font-bold">{{ $orderDetails->shoe->brand->name }}</p>
        </div>
        <div class="flex items-center justify-between">
          <p class="font-semibold">Price</p>
          <p class="font-bold">Rp {{ number_format($orderDetails->shoe->price, 0,',','.') }}</p>
        </div>
        <div class="flex items-center justify-between">
          <p class="font-semibold">Quantity</p>
          <p class="font-bold">{{ $orderDetails->quantity }}</p>
        </div>
        <div class="flex items-center justify-between">
          <p class="font-semibold">Shoe Size</p>
          <p class="font-bold">{{ $orderDetails->shoeSize->size }}</p>
        </div>
        <div class="flex items-center justify-between">
          <p class="font-semibold">Grand Total</p>
          <p class="font-bold text-2xl leading-9 text-[#07B704]">
            Rp {{ number_format($orderDetails->grand_total_amount, 0,',','.') }}
          </p>
        </div>
        <div class="flex items-center justify-between">
          <p class="font-semibold">Checkout At</p>
          <p class="font-bold">{{ \Carbon\Carbon::parse($orderDetails->created_at)->format('d F Y') }}</p>
        </div>
        <div class="flex items-center justify-between">
          <p class="font-semibold">Status</p>
          @if ($orderDetails->is_paid)
          <p
          class="rounded-full p-[6px_14px] bg-[#07B704] font-bold text-sm leading-[21px] text-white"
        >
          SUCCESS
        </p>
          @else
          <p
          class="rounded-full p-[6px_14px] bg-[#2A2A2A] font-bold text-sm leading-[21px] text-white"
        >
          PENDING
        </p>
          @endif
          
        </div>
      </section>
      <section
        id="customer"
        class="accordion flex flex-col rounded-[20px] p-4 pb-5 gap-5 mx-4 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px] mb-10"
      >
        <label class="group flex items-center justify-between">
          <h2 class="font-bold text-xl leading-[30px]">Customer</h2>
          <img
            src="{{ asset('assets/images/icons/arrow-up.svg')}}"
            class="w-7 h-7 transition-all duration-300 group-has-[:checked]:rotate-180"
            alt="icon"
          />
          <input type="checkbox" class="hidden" />
        </label>
        <div class="flex items-center gap-5">
          <img
            src="{{ asset('assets/images/icons/delivery.svg')}}"
            class="w-6 h-6 flex shrink-0"
            alt="icon"
          />
          <div class="flex flex-col gap-[6px]">
            <p class="font-semibold">Booking ID</p>
            <p class="font-bold">{{ $orderDetails->booking_trx_id }}</p>
          </div>
        </div>
        <div class="flex items-center gap-5">
          <img
            src="{{ asset('assets/images/icons/user.svg')}}"
            class="w-6 h-6 flex shrink-0"
            alt="icon"
          />
          <div class="flex flex-col gap-[6px]">
            <p class="font-semibold">Name</p>
            <p class="font-bold">{{ $orderDetails->name }}</p>
          </div>
        </div>
        <div class="flex items-center gap-5">
          <img
            src="{{ asset('assets/images/icons/call.svg')}}"
            class="w-6 h-6 flex shrink-0"
            alt="icon"
          />
          <div class="flex flex-col gap-[6px]">
            <p class="font-semibold">Phone No.</p>
            <p class="font-bold">{{ $orderDetails->phone }}</p>
          </div>
        </div>
        <div class="flex items-center gap-5">
          <img
            src="{{ asset('assets/images/icons/sms.svg')}}"
            class="w-6 h-6 flex shrink-0"
            alt="icon"
          />
          <div class="flex flex-col gap-[6px]">
            <p class="font-semibold">Email</p>
            <p class="font-bold">{{ $orderDetails->email }}</p>
          </div>
        </div>
        <div class="flex items-center gap-5">
          <img
            src="{{ asset('assets/images/icons/house-2.svg')}}"
            class="w-6 h-6 flex shrink-0"
            alt="icon"
          />
          <div class="flex flex-col gap-[6px]">
            <p class="font-semibold">Delivery to</p>
            <p class="font-bold">
              {{ $orderDetails->address }}, {{ $orderDetails->city }}, {{ $orderDetails->post_code }}
            </p>
          </div>
        </div>
        <hr class="border-[#EAEAED]" />
        @if (!$orderDetails->rating)
        <button
        onclick="showRatingModal()"
        class="rounded-full p-[12px_20px] text-center w-full bg-[#C5F277] font-bold"
      >
        Rate Your Experience
      </button>
        @endif
        
        <a
          href="#"
          class="rounded-full p-[12px_20px] text-center w-full bg-[#C5F277] font-bold"
          >Call Customer Service</a
        >
        <hr class="border-[#EAEAED]" />
        <div class="flex items-center gap-[10px]">
          <img
            src="{{ asset('assets/images/icons/shield-tick.svg')}}"
            class="w-8 h-8 flex shrink-0"
            alt="icon"
          />
          <p class="leading-[26px]">
            Kami melindungi data privasi anda dengan baik.
          </p>
        </div>
      </section>
    </div>

    <!-- Rating Modal -->
    <div
      id="ratingModal"
      class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center"
    >
      <div class="bg-white rounded-[20px] p-6 w-[90%] max-w-[400px]">
        <form action="{{ route('front.rating', ['shoe_id' => $orderDetails->shoe, 'product_transaction_id' => $orderDetails]) }}" method="POST" class="flex flex-col items-center gap-4" id="ratingForm">
          @csrf
          <h3 class="font-bold text-xl">Rate Your Experience</h3>
          <div class="flex gap-2">
            <label class="cursor-pointer">
              <input type="radio" name="rating" value="1" class="hidden" required>
              <span class="star text-3xl text-gray-300 hover:text-yellow-400">★</span>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="rating" value="2" class="hidden" required>
              <span class="star text-3xl text-gray-300 hover:text-yellow-400">★</span>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="rating" value="3" class="hidden" required>
              <span class="star text-3xl text-gray-300 hover:text-yellow-400">★</span>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="rating" value="4" class="hidden" required>
              <span class="star text-3xl text-gray-300 hover:text-yellow-400">★</span>
            </label>
            <label class="cursor-pointer">
              <input type="radio" name="rating" value="5" class="hidden" required>
              <span class="star text-3xl text-gray-300 hover:text-yellow-400">★</span>
            </label>
          </div>
          <textarea
            name="comment"
            class="w-full p-3 border rounded-lg"
            rows="4"
            placeholder="Share your feedback (optional)"
          ></textarea>
          <div class="flex gap-3 w-full">
            <button
              type="button"
              onclick="closeRatingModal()"
              class="flex-1 py-2 px-4 rounded-full border border-gray-300"
            >
              Cancel
            </button>
            <button
              type="submit"
              class="flex-1 py-2 px-4 rounded-full bg-[#C5F277]"
              id="submitRating"
            >
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>    
    <script src="{{ asset("js/accordion.js") }}"></script>
    <script src="{{ asset('js/rating.js') }}"></script>
  </body>
</html>
