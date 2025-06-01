<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionApiController extends Controller
{
    // Menampilkan daftar transaksi dengan relasi customer dan product (paginate 10)
    public function index()
    {
        $transactions = Transaction::with(['customer', 'product'])->paginate(10);
        return response()->json($transactions);
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            // 'total_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date|after_or_equal:today',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $totalPrice = $product->price * $quantity;

        $transaction = Transaction::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'transaction_date' => $request->transaction_date,
        ]);

        return response()->json([
            'message' => 'Transaction successfully added.',
            'transaction' => $transaction->load(['customer', 'product']),
        ], 201);
    }

    // Menampilkan detail transaksi berdasarkan ID
    public function show($id)
    {
        $transaction = Transaction::with(['customer', 'product'])->findOrFail($id);
        return response()->json($transaction);
    }

    // Update transaksi berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            // 'total_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date|after_or_equal:today',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $totalPrice = $product->price * $quantity;

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'transaction_date' => $request->transaction_date,
        ]);

        return response()->json([
            'message' => 'Transaction successfully updated.',
            'transaction' => $transaction->load(['customer', 'product']),
        ]);
    }

    // Hapus transaksi berdasarkan ID
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json(['message' => 'Transaction successfully deleted.']);
    }
}