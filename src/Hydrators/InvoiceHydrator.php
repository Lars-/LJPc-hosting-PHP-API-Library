<?php

namespace LJPcHosting\v1\Hydrators;

use DateTime;
use LJPcHosting\v1\Models\Invoice;

class InvoiceHydrator extends Invoice {
    public static function hydrate(array $data, Invoice $invoice): void {
        $invoice->invoiceNumber = $data['invoiceNumber'];
        $invoice->profile       = $data['profile'];
        $invoice->email         = $data['email'];
        $invoice->sent          = $data['sent'] === null ? null : DateTime::createFromFormat(DATE_ATOM, $data['sent']);
        $invoice->open          = $data['open'];
        $invoice->paidDate      = $data['paidDate'] === null ? null : DateTime::createFromFormat(DATE_ATOM,
            $data['paidDate']);
        $invoice->paymentUrl    = $data['paymentUrl'];
        $invoice->dueDate       = $data['dueDate'] === null ? null : DateTime::createFromFormat(DATE_ATOM,
            $data['dueDate']);
        $invoice->history       = $data['history'];
        $invoice->total         = $data['total'];
        $invoice->tax           = $data['tax'];
    }

    public static function extract(Invoice $invoice): array {
        return [
            'invoiceNumber' => $invoice->invoiceNumber,
            'profile'       => $invoice->profile,
            'email'         => $invoice->email,
            'sent'          => $invoice->sent->format(DATE_ATOM),
            'open'          => $invoice->open,
            'paidDate'      => $invoice->paidDate->format(DATE_ATOM),
            'paymentUrl'    => $invoice->paymentUrl,
            'dueDate'       => $invoice->dueDate->format(DATE_ATOM),
            'history'       => $invoice->history,
            'total'         => $invoice->total,
            'tax'           => $invoice->tax,
        ];
    }
}