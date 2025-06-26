<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function indexTransaction(Request $request)
    {
        $query = Transaction::with(['kreditCoa', 'debitCoa']);

        // Filter by date
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        // Filter by transaction type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by kredit COA
        if ($request->filled('kredit_coa_id')) {
            $query->where('kredit_coa_id', $request->kredit_coa_id);
        }

        // Filter by debit COA
        if ($request->filled('debit_coa_id')) {
            $query->where('debit_coa_id', $request->debit_coa_id);
        }

        // Filter by recipient
        if ($request->filled('recipient_name')) {
            $query->where('recipient_name', 'like', '%' . $request->recipient_name . '%');
        }

        // Filter by amount range
        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->min_amount);
        }

        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->max_amount);
        }

        // Filter by transaction number
        if ($request->filled('no_transaction')) {
            $query->where('no_transaction', 'like', '%' . $request->no_transaction . '%');
        }

        // Get filtered transactions
        $transactions = $query->latest()->get();

        // Stats
        $total_transactions = $transactions->count();
        $total_amount = $transactions->sum('amount');
        $today_transactions = $transactions->where('date', \Carbon\Carbon::today()->toDateString())->count();

        // Get COA data for dropdowns
        $coas = \App\Models\Coa::orderBy('name')->get();

        return view('accounting.transaction.index', compact(
            'transactions',
            'coas',
            'total_transactions',
            'total_amount',
            'today_transactions'
        ));
    }


    public function createTransaction(Request $request)
    {
        $type = $request->query('type'); // dapatkan tipe dari query string (?type=transfer / ?type=receive)
        $coas = Coa::all(); // atau apapun variabel yang kamu perlukan di view

        if ($type === 'transfer') {
            return view('accounting.transaction.create-transfer', compact('type', 'coas'));
        } elseif ($type === 'receive') {
            return view('accounting.transaction.create-receive', compact('type', 'coas'));
        } else {
            abort(404); // kalau tidak sesuai
        }
    }

    public function storeTransactionTransfer(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'no_transaction'    => 'required|string|unique:transactions,no_transaction',
            'debit_coa_id'      => 'required|exists:coas,id',
            'kredit_coa_id'     => 'required|exists:coas,id',
            'amount'            => 'required|numeric|min:1',
            'type'              => 'required|in:transfer,receive',
            'description'       => 'nullable|string|max:1000',
            'date'              => 'required|date',
        ]);

        try {
            // Simpan ke database
            Transaction::create([
                'no_transaction' => $validated['no_transaction'],
                'debit_coa_id'   => $validated['debit_coa_id'],
                'kredit_coa_id'  => $validated['kredit_coa_id'],
                'amount'         => $validated['amount'],
                'type'           => $validated['type'],
                'description'    => $validated['description'] ?? null,
                'date'           => $validated['date'],
            ]);

            return redirect()->route('index-transaction')->with('success', 'Transaction created successfully.');
        } catch (\Exception $e) {
            // Log error jika terjadi masalah
            Log::error('Error storing transaction: ' . $e->getMessage(), [
                'data_input' => $request->all(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Failed to create transaction. Please check the logs.');
        }
    }

    public function storeTransactionReceive(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'no_transaction'    => 'required|string|unique:transactions,no_transaction',
            'debit_coa_id'      => 'required|exists:coas,id',
            'kredit_coa_id'     => 'required|exists:coas,id',
            'recipient_name'    => 'required|string|max:255',
            'amount'            => 'required|numeric|min:1',
            'type'              => 'required|in:transfer,receive',
            'description'       => 'nullable|string|max:1000',
            'date'              => 'required|date',
        ]);

        try {
            // Simpan ke database
            Transaction::create([
                'no_transaction' => $validated['no_transaction'],
                'debit_coa_id'   => $validated['debit_coa_id'],
                'kredit_coa_id'  => $validated['kredit_coa_id'],
                'recipient_name' => $validated['recipient_name'] ?? null,
                'amount'         => $validated['amount'],
                'type'           => $validated['type'],
                'description'    => $validated['description'] ?? null,
                'date'           => $validated['date'],
            ]);

            return redirect()->route('index-transaction')->with('success', 'Transaction created successfully.');
        } catch (\Exception $e) {
            // Log error jika terjadi masalah
            Log::error('Error storing transaction: ' . $e->getMessage(), [
                'data_input' => $request->all(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Failed to create transaction. Please check the logs.');
        }
    }

    public function editTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $coas = Coa::all();
        $type = $transaction->type;

        if ($type === 'transfer') {
            return view('accounting.transaction.edit-transfer', compact('transaction', 'coas', 'type'));
        } elseif ($type === 'receive') {
            return view('accounting.transaction.edit-receive', compact('transaction', 'coas', 'type'));
        } else {
            abort(404);
        }
    }

    public function updateTransactionTransfer(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'no_transaction'    => 'required|string|unique:transactions,no_transaction,' . $id,
            'debit_coa_id'      => 'required|exists:coas,id',
            'kredit_coa_id'     => 'required|exists:coas,id',
            'amount'            => 'required|numeric|min:1',
            'description'       => 'nullable|string|max:1000',
            'date'              => 'required|date',
        ]);

        try {
            // Update transaksi
            $transaction->update([
                'no_transaction' => $validated['no_transaction'],
                'debit_coa_id'   => $validated['debit_coa_id'],
                'kredit_coa_id'  => $validated['kredit_coa_id'],
                'amount'         => $validated['amount'],
                'description'    => $validated['description'] ?? null,
                'date'           => $validated['date'],
            ]);

            return redirect()->route('index-transaction')->with('success', 'Transaction updated successfully.');
        } catch (\Exception $e) {
            // Log error jika terjadi masalah
            Log::error('Error updating transaction: ' . $e->getMessage(), [
                'data_input' => $request->all(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Failed to update transaction. Please check the logs.');
        }
    }

    public function updateTransactionReceive(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'no_transaction'    => 'required|string|unique:transactions,no_transaction,' . $id,
            'debit_coa_id'      => 'required|exists:coas,id',
            'kredit_coa_id'     => 'required|exists:coas,id',
            'recipient_name'    => 'required|string|max:255',
            'amount'            => 'required|numeric|min:1',
            'description'       => 'nullable|string|max:1000',
            'date'              => 'required|date',
        ]);

        try {
            // Update transaksi
            $transaction->update([
                'no_transaction' => $validated['no_transaction'],
                'debit_coa_id'   => $validated['debit_coa_id'],
                'kredit_coa_id'  => $validated['kredit_coa_id'],
                'recipient_name' => $validated['recipient_name'],
                'amount'         => $validated['amount'],
                'description'    => $validated['description'] ?? null,
                'date'           => $validated['date'],
            ]);

            return redirect()->route('index-transaction')->with('success', 'Transaction updated successfully.');
        } catch (\Exception $e) {
            // Log error jika terjadi masalah
            Log::error('Error updating transaction: ' . $e->getMessage(), [
                'data_input' => $request->all(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Failed to update transaction. Please check the logs.');
        }
    }

    public function getTransaction($id)
    {
        $transaction = Transaction::with(['kreditCoa', 'debitCoa'])->findOrFail($id);
        return response()->json($transaction);
    }


    public function deleteTransaction($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();

            return response()->json(['message' => 'Transaction deleted successfully.'], 200);
        } catch (\Exception $e) {
            $transaction = Transaction::find($id); // coba ambil datanya

            Log::error('Error deleting transaction.', [
                'transaction' => $transaction,
                'user_id' => auth()->id(),
                'url' => request()->fullUrl(),
                'message' => $e->getMessage(),
            ]);

            return response()->json(['message' => 'Failed to delete transaction.'], 500);
        }
    }
}
