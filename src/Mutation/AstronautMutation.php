<?php

namespace App\Mutation;

use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use App\Entity\Astronaut;

final class AstronautMutation implements MutationInterface, AliasedInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function resolve(string $pseudo): array
    {
        $astronaute = new Astronaut();
        $astronaute->setPseudo($pseudo);

        $this->em->persist($astronaute);
        $this->em->flush();

        return ['content' => 'ok'];
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'NewAstronaut',
        ];
    }
}