<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class InvoiceService
{
    /**
     * Generate a PDF invoice for a payment
     *
     * @param Client $client
     * @param Payment $payment
     * @return string Path to the generated PDF file
     */
    public function generateInvoice(Client $client, Payment $payment): string
    {
        $data = [
            'client' => $client,
            'payment' => $payment,
            'invoiceNumber' => 'FACT-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT),
            'invoiceDate' => $payment->updated_at->format('d/m/Y'),
            'amount' => $payment->amount / 100,
        ];

        $pdf = Pdf::loadView('emails.invoice_pdf', $data);

        // Generate filename
        $filename = 'facture_CINFr_' . $payment->id . '_' . time() . '.pdf';

        // Save to storage/app/public/invoices
        $path = storage_path('app/public/invoices/' . $filename);

        // Ensure directory exists
        $directory = dirname($path);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Save PDF
        $pdf->save($path);

        return $path;
    }
}
