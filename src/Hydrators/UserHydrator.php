<?php

namespace LJPcHosting\v1\Hydrators;

use DateTime;
use LJPcHosting\v1\Models\User;

class UserHydrator extends User {
    public static function hydrate(array $data, User $user): void {
        $user->reference   = $data['reference'];
        $user->email       = $data['email'];
        $user->company     = $data['company'] ?? null;
        $user->firstName   = $data['firstName'];
        $user->lastName    = $data['lastName'];
        $user->phoneNumber = $data['phoneNumber'];
        $user->street      = $data['street'];
        $user->number      = $data['number'];
        $user->suffix      = $data['suffix'] ?? null;
        $user->zipcode     = $data['zipcode'];
        $user->city        = $data['city'];
        $user->country     = $data['country'];
        $user->role        = $data['role'];
        $user->apiKey      = $data['apiKey'];
        $user->lastLogin   = DateTime::createFromFormat(DATE_ATOM, $data['lastLogin']);
        $user->createdAt   = DateTime::createFromFormat(DATE_ATOM, $data['createdAt']);
        $user->updatedAt   = DateTime::createFromFormat(DATE_ATOM, $data['updatedAt']);
    }

    public static function extract(User $user): array {
        return [
            'reference'   => $user->reference,
            'email'       => $user->email,
            'company'     => $user->company,
            'firstName'   => $user->firstName,
            'lastName'    => $user->lastName,
            'phoneNumber' => $user->phoneNumber,
            'street'      => $user->street,
            'number'      => $user->number,
            'suffix'      => $user->suffix,
            'zipcode'     => $user->zipcode,
            'city'        => $user->city,
            'country'     => $user->country,
            'role'        => $user->role,
            'apiKey'      => $user->apiKey,
            'lastLogin'   => $user->lastLogin->format(DATE_ATOM),
            'createdAt'   => $user->createdAt->format(DATE_ATOM),
            'updatedAt'   => $user->updatedAt->format(DATE_ATOM),
        ];
    }
}