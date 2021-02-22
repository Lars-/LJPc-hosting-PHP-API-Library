<?php

namespace LJPcHosting\v1\Models;

use DateTime;

class Invoice {
    protected string $invoiceNumber;
    protected int $profile;
    protected string $email;
    protected DateTime $sent;
    protected float $open;
    protected DateTime $paidDate;
    protected string $paymentUrl;
    protected DateTime $dueDate;
    protected array $history;
    protected float $total;
    protected float $tax;

    public function getInvoiceNumber(): string {
        return $this->invoiceNumber;
    }

    public function getProfile(): int {
        return $this->profile;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getSent(): DateTime {
        return $this->sent;
    }

    public function getOpen(): float {
        return $this->open;
    }

    public function getPaidDate(): DateTime {
        return $this->paidDate;
    }

    public function getPaymentUrl(): string {
        return $this->paymentUrl;
    }

    public function getDueDate(): DateTime {
        return $this->dueDate;
    }

    public function getHistory(): array {
        return $this->history;
    }

    public function getTotal(): float {
        return $this->total;
    }

    public function getTax(): float {
        return $this->tax;
    }
}