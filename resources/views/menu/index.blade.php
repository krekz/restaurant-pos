@extends("layouts.app")

@section("content")
    <div class="container">
    <div>
        @if (session()->has('message1'))
            <div id="flashmessage" class="p-4 bg-green-500 font-semibold text-white rounded-lg">
                {{ session('message1') }}
            </div>
        @endif
        @if (session()->has('message2'))
            <div id="flashmessage" class="p-4 bg-red-500 font-semibold text-white rounded-lg">
                {{ session('message2') }}
            </div>
        @endif
    </div>
        <h1 class="p-4 text-2xl font-black">All Menu</h1>
        <div class="grid grid-cols-1 gap-3 py-5 md:grid-cols-3 xl:grid-cols-4">
            @foreach ($menuItems as $item)
                <div
                    class="flex flex-col justify-between overflow-hidden rounded-md bg-orange-50 p-3"
                >
                    @if ($item->image_path)
                        <img
                            src="{{ asset('storage/' . $item->image_path) }}"
                            class="h-52 transform overflow-hidden rounded-lg object-cover transition duration-300 ease-in-out hover:scale-105"
                        />
                    @endif

                    <div class="flex justify-between p-3">
                        <div class="flex flex-col">
                            <h4 class="max-w-36 font-semibold">
                                {{ $item->name }}
                            </h4>
                            <p>RM{{ $item->price }}</p>
                        </div>
                        <p class="text-xs">{{ $item->description }}</p>
                    </div>

                    <form
                        action="{{ route('orders.store') }}"
                        method="POST"
                        class="mt-3"
                    >
                        @csrf
                        <input
                            type="number"
                            name="items[{{ $item->id }}]"
                            class='form-control p-1 rounded-lg border w-full'
                            placeholder="Quantity"
                        />
                        <input type="hidden" name="total_price" id="total_price" value="0">
                </div>
            @endforeach
            
        </div>
        <button
        type="submit"
        class="w-full font-medium cursor-pointer rounded-lg bg-orange-400 p-3 text-center hover:bg-orange-400/70">
        Place order
        </button>
        </form>
    </div>

    

@yield("scripts")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function(){
        // Hide session message after 3 seconds
        setTimeout(function(){
            $('#flashmessage').fadeOut('slow');
        }, 3000); // 3000ms = 3 seconds
        setInterval(function(){
        location.reload();
        }, 5000); // Refresh page every 5 seconds
});
    </script>
@endsection


