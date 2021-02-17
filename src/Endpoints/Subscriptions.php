<?php

namespace LJPcHosting\v1\Endpoints;

use LJPcHosting\v1\Hydrators\SubscriptionHydrator;
use LJPcHosting\v1\Models\Subscription;

class Subscriptions extends EndpointInterface {
    /**
     * @return Subscription[]
     */
    public function all(): array {
        $subscriptions         = $this->call('GET', '/subscriptions');
        $hydratedSubscriptions = [];
        foreach ($subscriptions as $subscription) {
            $newSubscription = new Subscription();
            SubscriptionHydrator::hydrate($subscription, $newSubscription);
            $hydratedSubscriptions[] = $newSubscription;
        }

        return $hydratedSubscriptions;
    }

    public function get(string $reference): Subscription {
        $subscriptionResponse = $this->call('GET', "/subscriptions/$reference");

        $newSubscription = new Subscription();
        SubscriptionHydrator::hydrate($subscriptionResponse, $newSubscription);

        return $newSubscription;
    }
}