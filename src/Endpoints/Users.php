<?php

namespace LJPcHosting\v1\Endpoints;

use JsonException;
use LJPcHosting\v1\Exceptions\APICallException;
use LJPcHosting\v1\Hydrators\UserHydrator;
use LJPcHosting\v1\Models\User;

class Users extends EndpointInterface {
    /**
     * @return User
     * @throws JsonException
     * @throws APICallException
     */
    public function me(): User {
        $userData = $this->call('GET', '/users/me');
        $user     = new User();
        UserHydrator::hydrate($userData, $user);

        return $user;
    }

    /**
     * @param string $reference
     *
     * @return User
     * @throws JsonException
     * @throws APICallException
     */
    public function get(string $reference): User {
        $userData = $this->call('GET', '/users/' . $reference);
        $user     = new User();
        UserHydrator::hydrate($userData, $user);

        return $user;
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws JsonException
     * @throws APICallException
     */
    public function update(User $user): User {
        $userData = UserHydrator::extract($user);
        unset($userData['reference'], $userData['email'], $userData['lastLogin'], $userData['role'], $userData['apiKey'], $userData['createdAt'], $userData['updatedAt']);
        $this->call('PUT', '/users/' . $user->getReference(), $userData);

        return $user;
    }
}