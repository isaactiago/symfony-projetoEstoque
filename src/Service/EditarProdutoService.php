<?php 
namespace App\Service;

use App\Entity\Produto;

use Doctrine\ORM\EntityManagerInterface;

class EditarProdutoService 
{
    private EntityManagerInterface $em;

   public function __construct(
    EntityManagerInterface $em,
 
   )
   {
        $this->em = $em;
   }
    public function editar( Produto $produto,array $dados ): void
    {
        
         $produto->setNome($dados['nome']);
         $produto->setDescricao($dados['descricao']);
         $produto->setQuantidadeInicial((float)$dados['quantidadeInicial']);
         $produto->setQuantidadeDisponivel((float)$dados['quantidadeDisponivel']);
         $produto->setValor((float)$dados['valor']);
 
         
         $this->em->persist($produto); // Isso garante que o produto existente será atualizado
         $this->em->flush(); // Salva as mudanças no banco de dados
    }
}
?>