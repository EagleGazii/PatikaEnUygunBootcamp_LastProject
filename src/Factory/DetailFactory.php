<?php

namespace App\Factory;

use App\Entity\Detail;
use App\Repository\DetailRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Detail>
 *
 * @method static Detail|Proxy createOne(array $attributes = [])
 * @method static Detail[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Detail|Proxy find(object|array|mixed $criteria)
 * @method static Detail|Proxy findOrCreate(array $attributes)
 * @method static Detail|Proxy first(string $sortedField = 'id')
 * @method static Detail|Proxy last(string $sortedField = 'id')
 * @method static Detail|Proxy random(array $attributes = [])
 * @method static Detail|Proxy randomOrCreate(array $attributes = [])
 * @method static Detail[]|Proxy[] all()
 * @method static Detail[]|Proxy[] findBy(array $attributes)
 * @method static Detail[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Detail[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static DetailRepository|RepositoryProxy repository()
 * @method Detail|Proxy create(array|callable $attributes = [])
 */
final class DetailFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'firstName' => self::faker()->firstName(),
            'lastName' => self::faker()->lastName(),
            'birthday' => self::faker()->dateTimeBetween('-30 years','-18 years'),
            'phoneNo' => self::faker()->phoneNumber(),
            'address' => self::faker()->address(),
            'createdAt' => self::faker()->dateTimeBetween('-30 days','now')
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Detail $detail): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Detail::class;
    }
}
