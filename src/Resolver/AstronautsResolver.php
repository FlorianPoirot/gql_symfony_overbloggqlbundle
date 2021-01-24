<?php

namespace App\Resolver;

use App\Entity\Astronaut;
use App\Repository\AstronautRepository;
use Doctrine\Common\Collections\Collection;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;


final class AstronautsResolver implements ResolverInterface, AliasedInterface
{

    private AstronautRepository $astronautRepository;

    public function __construct(AstronautRepository $astronautRepository)
    {
        $this->astronautRepository = $astronautRepository;
    }

    /**
     * @return Collection|Astronaut[]
     */
    public function resolve(): array
    {
        return $this->astronautRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Astronauts',
        ];
    }
}