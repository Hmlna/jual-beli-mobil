<x-app-layout>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Customer</h1>

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

    <!-- Form Tambah Customer -->
    <form method="POST" action="{{ route('customers.store') }}" class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Customer Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Customer Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Customer Phone</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Customer Address</label>
            <textarea id="address" name="address" required rows="4"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('address') }}</textarea>
        </div>
        
        <div class="flex justify-end">
            <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Save
            </button>
        </div>
    </form>
</div>

</x-app-layout>