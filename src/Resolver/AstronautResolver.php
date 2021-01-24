<?php

namespace App\Resolver;

use App\Entity\Astronaut;
use App\Repository\AstronautRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;


final class AstronautResolver implements ResolverInterface, AliasedInterface
{

    private AstronautRepository $astronautRepository;


    public function __construct(AstronautRepository $astronautRepository)
    {
        $this->astronautRepository = $astronautRepository;
    }

    /**
     * @param int $id
     * @return Astronaut|null
     */
    public function resolve(int $id): Astronaut
    {
        return $this->astronautRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Astronaut',
        ];
    }
}