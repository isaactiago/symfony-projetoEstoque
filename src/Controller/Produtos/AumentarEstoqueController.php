<?php 

namespace App\Controller\Produtos;

use App\Repository\ProdutoRepository;
use App\Service\AumentarEstoqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AumentarEstoqueController extends AbstractController
{

    #[Route("produtos/adicionar/{id}" ,name:"produto_adicionar")]
    public function aumentarEstoque(
        int $id,
        ProdutoRepository $produtoRepository,
        AumentarEstoqueService $aumentarEstoqueService,
    ) : Response 
    {
        $produto = $produtoRepository->find($id);
        $aumentarEstoqueService->aumentarEstoque(produto: $produto);
        return $this->redirectToRoute("listar_produtos");
    }
}
?>