<?php

namespace LJPcHosting\v1\Hydrators;

use DateTime;
use LJPcHosting\v1\Models\Subscription;

class SubscriptionHydrator extends Subscription {
    public static function hydrate(array $data, Subscription $subscription): void {
        $subscription->reference = $data['reference'];
        $subscription->owner     = $data['owner'];

        $subscription->name             = $data['name'];
        $subscription->frequency        = $data['frequency'];
        $subscription->initialDate      = DateTime::createFromFormat(DATE_ATOM, $data['initialDate']);
        $subscription->validUntil       = $data['validUntil'] === null ? null : DateTime::createFromFormat(DATE_ATOM,
            $data['validUntil']);
        $subscription->price            = (float)$data['price'];
        $subscription->originalPrice    = (float)$data['originalPrice'];
        $subscription->active           = (bool)$data['active'];
        $subscription->productType      = $data['productType'];
        $subscription->productReference = $data['productReference'];
        $subscription->payments         = $data['payments'];
        foreach ($subscription->payments as &$payment) {
            if (isset($payment['createdAt'])) {
                $payment['createdAt'] = DateTime::createFromFormat(DATE_ATOM, $payment['createdAt']);
            }
            if (isset($payment['validUntil'])) {
                $payment['validUntil'] = DateTime::createFromFormat(DATE_ATOM, $payment['validUntil']);
            }
        }
        unset($payment);

        $subscription->createdAt = DateTime::createFromFormat(DATE_ATOM, $data['createdAt']);
        $subscription->updatedAt = DateTime::createFromFormat(DATE_ATOM, $data['updatedAt']);
    }

    public static function extract(Subscription $subscription): array {
        return [
            'reference'        => $subscription->reference,
            'owner'            => $subscription->owner,
            'name'             => $subscription->name,
            'frequency'        => $subscription->frequency,
            'initialDate'      => $subscription->initialDate->format(DATE_ATOM),
            'validUntil'       => $subscription->validUntil === null ? null : $subscription->validUntil->format(DATE_ATOM),
            'price'            => $subscription->price,
            'originalPrice'    => $subscription->originalPrice,
            'active'           => $subscription->active,
            'productType'      => $subscription->productType,
            'productReference' => $subscription->productReference,
            'payments'         => $subscription->payments,
            'createdAt'        => $subscription->createdAt->format(DATE_ATOM),
            'updatedAt'        => $subscription->updatedAt->format(DATE_ATOM),
        ];
    }
}