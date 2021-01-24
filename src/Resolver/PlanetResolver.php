<?php

namespace App\Resolver;

use App\Entity\Astronaut;
use App\Entity\Planet;
use App\Repository\PlanetRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;


final class PlanetResolver implements ResolverInterface, AliasedInterface
{

    private PlanetRepository $planetRepository;

    /**
     *
     * @param PlanetRepository $planetRepository
     */
    public function __construct(PlanetRepository $planetRepository)
    {
        $this->planetRepository = $planetRepository;
    }

    /**
     * @param int $id
     * @return Planet|null
     */
    public function resolve(int $id): ?Planet
    {
        return $this->planetRepository->find($id);
    }


    public function resolveInAstronaut(Astronaut $astronaut)
    {
        return $this->planetRepository->findByAstronaut($astronaut->getId());
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Planet',
        ];
    }
}