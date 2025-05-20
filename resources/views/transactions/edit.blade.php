<x-app-layout>

    
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Transactions</h1>
        
        <!-- Menampilkan error validasi jika ada -->
        @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <!-- Form untuk mengedit kategori -->
        <form method="POST" action="{{ route('transactions.update', $transaction->id) }}" class="space-y-6 bg-white p-6 rounded-lg shadow">
            @csrf
        @method('PUT')

        <div>
            <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer Name</label>
            <select id="customer_id" name="customer_id" required
            class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">-- Choose Customer --</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
            </select>
        </div>

        <div>
            <label for="product_id" class="block text-sm font-medium text-gray-700">Product Name</label>
            <select id="product_id" name="product_id" required
            class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">-- Choose product --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ old('product_id', $transaction->product_id) == $product->id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
            </select>
        </div>
        
        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $transaction->quantity) }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="transaction_date" class="block text-sm font-medium text-gray-700">Transaction Date</label>
            <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', $transaction->transaction_date) }}" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('transaction_date') }}</textarea>
        </div>
            
            <div class="flex justify-end">
                <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Update
            </button>
        </div>
    </form>
</div>

</x-app-layout>    