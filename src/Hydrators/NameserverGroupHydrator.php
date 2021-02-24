<?php

namespace LJPcHosting\v1\Hydrators;

use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use LJPcHosting\v1\Models\Nameserver;
use LJPcHosting\v1\Models\NameserverGroup;
use RuntimeException;

class NameserverGroupHydrator extends NameserverGroup {
    public static function hydrate(array $data, NameserverGroup $nameserverGroup): void {
        $nameserverGroup->reference = $data['reference'];
        $nameserverGroup->owner     = $data['owner'];

        $nameserverGroup->name = $data['name'];

        $nameserverGroup->nameservers = [];
        foreach ($data['nameservers'] as $nameserver) {
            if (empty($nameserver['ipv6'])) {
                $nameserverGroup->nameservers[] = new Nameserver($nameserver['hostname'], $nameserver['ipv4']);
            } else {
                $nameserverGroup->nameservers[] = new Nameserver($nameserver['hostname'], $nameserver['ipv4'],
                    $nameserver['ipv6']);
            }
        }

        $nameserverGroup->createdAt = DateTime::createFromFormat(DATE_ATOM, $data['createdAt']);
        $nameserverGroup->updatedAt = DateTime::createFromFormat(DATE_ATOM, $data['updatedAt']);
    }

    #[ArrayShape([
        'reference'   => "string",
        'owner'       => "string",
        'name'        => "string",
        'nameservers' => "array",
        'createdAt'   => "string",
        'updatedAt'   => "string",
    ])] public static function extract(
        NameserverGroup $nameserverGroup
    ): array {

        return [
            'reference' => $nameserverGroup->reference,
            'owner'     => $nameserverGroup->owner,

            'name'        => $nameserverGroup->name,
            'nameservers' => self::nameserversToArray($nameserverGroup->nameservers),

            'createdAt' => $nameserverGroup->createdAt->format(DATE_ATOM),
            'updatedAt' => $nameserverGroup->updatedAt->format(DATE_ATOM),
        ];
    }

    /**
     * @param Nameserver[] $nameservers
     *
     * @return array
     */
    public static function nameserversToArray(array $nameservers): array {
        $nameserversArr = [];
        foreach ($nameservers as $nameserver) {
            if ( ! ($nameserver instanceof Nameserver)) {
                throw new RuntimeException('Provided value is not an instance of Nameserver');
            }
            $nameserversArr[] = $nameserver->toArray();
        }

        return $nameserversArr;
    }
}