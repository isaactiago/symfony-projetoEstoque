<?php

namespace App\Controller\Produtos;

use App\Repository\ProdutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditarController extends AbstractController
{
    #[Route('produtos/editar/{id}', name: 'produto_editar')]
    public function editar(
        int $id,
        Request $request,
        ProdutoRepository $produtoRepository,
        EntityManagerInterface $em,
        ): Response
    {
     
        $produto = $produtoRepository->find($id);

       
       
        $em->flush();
           
      
        
        $data['titulo'] = "Editar produto";
     
        
        
        return $this->render("app/produto/novoProduto.html.twig",$data);
        return new Response();
    }
}
?>