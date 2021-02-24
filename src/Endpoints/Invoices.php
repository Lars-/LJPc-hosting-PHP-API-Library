<?php

namespace LJPcHosting\v1\Endpoints;

use JsonException;
use LJPcHosting\v1\Exceptions\APICallException;
use LJPcHosting\v1\Hydrators\InvoiceHydrator;
use LJPcHosting\v1\Models\Invoice;

class Invoices extends EndpointInterface {
    /**
     * @return Invoice[]
     * @throws JsonException
     * @throws APICallException
     */
    public function all(): array {
        $invoices         = $this->call('GET', '/invoices');
        $hydratedInvoices = [];
        foreach ($invoices as $invoice) {
            $newInvoice = new Invoice();
            InvoiceHydrator::hydrate($invoice, $newInvoice);
            $hydratedInvoices[] = $newInvoice;
        }

        return $hydratedInvoices;
    }
}