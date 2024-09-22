<?php

namespace App\Repository;

use App\Entity\Categoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\VarDumper\Exception\ThrowingCasterException;

/**
 * @extends ServiceEntityRepository<Categoria>
 */
class CategoriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoria::class);
    }

    public function salvar(Categoria $categoria): void
    {
        $this->getEntityManager()->persist($categoria);
        $this->getEntityManager()->flush();
    }
}
