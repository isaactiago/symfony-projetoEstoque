<?php

namespace App\Controller\Produtos;

use App\Repository\ProdutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExcluirController extends AbstractController
{
    #[Route('categorias/excluir/{id}', name: 'produto_excluir')]
    public function excluir(
        int $id,
        EntityManagerInterface $em,
        ProdutoRepository $produtoRepository,
    ): Response 
    {
        $produto = $produtoRepository->find($id);

     
        $em->remove($produto);
        $em->flush();

        return $this->redirectToRoute("listar_produtos");
    }
}
?>