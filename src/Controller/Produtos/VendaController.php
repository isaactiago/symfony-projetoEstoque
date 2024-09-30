<?php

namespace App\Controller\Produtos;

use App\Repository\ProdutoRepository;
use App\Service\AumentarEstoqueService;
use App\Service\DiminuirEstoqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VendaController extends AbstractController
{
    #[Route('produtos/vender/{id}', name: 'produto_vender')]
    function diminuirEstoque(
        int $id,
        DiminuirEstoqueService $diminuirEstoqueService,
        ProdutoRepository $produtoRepository,
    ) : Response 
    {
        $produto = $produtoRepository->find($id);
        $diminuirEstoqueService->diminuirEstoque(produto : $produto);
        return $this->redirectToRoute("listar_produtos");
    }
}

?>