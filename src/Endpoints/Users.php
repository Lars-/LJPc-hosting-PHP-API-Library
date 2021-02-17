<?php

namespace LJPcHosting\v1\Endpoints;

use LJPcHosting\v1\Hydrators\UserHydrator;
use LJPcHosting\v1\Models\User;

class Users extends EndpointInterface {
    public function me(): User {
        $userData = $this->call('GET', '/users/me');
        $user     = new User();
        UserHydrator::hydrate($userData, $user);

        return $user;
    }

    public function get(string $reference): User {
        $userData = $this->call('GET', '/users/' . $reference);
        $user     = new User();
        UserHydrator::hydrate($userData, $user);

        return $user;
    }

    public function update(User $user): User {
        $userData = UserHydrator::extract($user);
        unset($userData['reference'], $userData['email'], $userData['lastLogin'], $userData['createdAt'], $userData['updatedAt']);
        $this->call('PUT', '/users/' . $user->getReference(), $userData);

        return $user;
    }
}