<?php

namespace LJPcHosting\v1\Endpoints;

use JsonException;
use LJPcHosting\v1\Exceptions\APICallException;
use LJPcHosting\v1\Hydrators\SubscriptionHydrator;
use LJPcHosting\v1\Models\Subscription;

class Subscriptions extends EndpointInterface {
    /**
     * @return Subscription[]
     * @throws JsonException
     * @throws APICallException
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

    /**
     * @param string $reference
     *
     * @return Subscription
     * @throws JsonException
     * @throws APICallException
     */
    public function get(string $reference): Subscription {
        $subscriptionResponse = $this->call('GET', "/subscriptions/$reference");

        $newSubscription = new Subscription();
        SubscriptionHydrator::hydrate($subscriptionResponse, $newSubscription);

        return $newSubscription;
    }
}