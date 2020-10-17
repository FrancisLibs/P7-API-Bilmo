<?php

namespace App\UserExtension;

use App\Entity\User;
use App\Entity\Customer;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;

class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    /**
     * Permet la récupération de l'utilisateur courant
     *
     * @var Security
     */
    private $security;

    /**
     * Permet la récupération du rôle de l'utiisateur courant
     *
     * @var AuthorizationCheckerInterface
     */
    private $authCheck;

    public function __construct(Security $security, AuthorizationCheckerInterface $authCheck)
    {
        $this->security = $security;
        $this->authCheck = $authCheck;
    }
    
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, 
        string $resourceClass, string $operationName = null)
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, 
        string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass)
    {
        $user = $this->security->getUser();

        // Si la resource est le client et pas un administrateur on ajoute un "where user" dans la requête
        if (
            $resourceClass === Customer::class 
            && 
            !$this->authCheck->isGranted('ROLE_ADMIN')
            &&
            $user instanceof User
        ) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere("$rootAlias.user = :user");
            $queryBuilder->setParameter("user", $user);
        }
    }

}