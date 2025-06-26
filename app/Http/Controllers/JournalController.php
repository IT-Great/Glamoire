<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice_Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function indexJournal()
    {
        // Get transactions for journal entries
        $transactions = Transaction::with(['kreditCoa', 'debitCoa'])
            ->orderBy('date', 'desc')
            ->get();

        // Get all invoice supplier transactions (both paid and unpaid)
        $invoiceSuppliers = Invoice_Supplier::with(['kreditCoa', 'debitCoa', 'supplier', 'payments'])
            ->orderBy('date', 'desc')
            ->get();

        return view('accounting.journal.index', compact('transactions', 'invoiceSuppliers'));
    }
}
