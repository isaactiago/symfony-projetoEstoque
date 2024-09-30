<?php 

namespace App\Service;

use App\Entity\Produto;
use Doctrine\ORM\EntityManagerInterface;

class AumentarEstoqueService
{
    private EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em
    )
    {
       $this->em = $em; 
    }

    public function aumentarEstoque(Produto $produto): void
    {
        if($produto && $produto->getQuantidadeDisponivel() > 0)
        {
            $novaQt = $produto->getQuantidadeDisponivel() + 1;
            $produto->setQuantidadeDisponivel($novaQt);

            $this->em->persist($produto);
            $this->em->flush();
        }
    }
}
?>