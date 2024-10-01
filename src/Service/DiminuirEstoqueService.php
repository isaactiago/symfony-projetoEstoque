<?php 
namespace App\Service;

use App\Entity\Produto;
use App\Repository\ProdutoRepository;
use Doctrine\ORM\EntityManagerInterface;

class  DiminuirEstoqueService 
{
  
   private EntityManagerInterface $em;
  
   public function __construct(
        EntityManagerInterface $em,
   )
   {
        $this->em = $em;
   }
  
   public function diminuirEstoque(Produto $produto): void
   {
        // Verificar se o produto foi encontrado e se a quantidade disponível é maior que zero
        if ($produto && $produto->getQuantidadeDisponivel() > 0) {
            // Diminuir a quantidade disponível
            $novaQt = $produto->getQuantidadeDisponivel() - 1;
            $produto->setQuantidadeDisponivel($novaQt);

            // Persistir as alterações no banco de dados
            $this->em->persist($produto);
            $this->em->flush();
        }
   }
}
?>