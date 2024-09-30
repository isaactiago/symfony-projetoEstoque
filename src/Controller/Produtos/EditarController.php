<?php

namespace App\Controller\Produtos;

use App\Repository\ProdutoRepository;
use App\Service\EditarProdutoService;
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
        EditarProdutoService $editarProdutoService,
    ): Response {
        // Encontra o produto pelo ID
        $produto = $produtoRepository->find($id);
    
        // Verifica se a requisição é POST para processar os dados
        if ($request->isMethod('POST')) {
            $nome = $request->request->get('nome');
            $descricao = $request->request->get('descricao');
            $qtInicial = $request->request->get('quantidadeInicial');
            $qtDisponivel = $request->request->get('quantidadeDisponivel');
            $valor = $request->request->get('valor');
    
            // Verifica se todos os valores foram recebidos
            if ($nome && $descricao && $qtInicial && $qtDisponivel && $valor) {
                $dados = [
                    "nome" => $nome,
                    "descricao" => $descricao,
                    'quantidadeInicial' => $qtInicial,
                    "quantidadeDisponivel" => $qtDisponivel,
                    'valor' => $valor,
                ];
    
                // Chama o serviço de edição, passando o produto existente
                $editarProdutoService->editar(produto : $produto, dados : $dados);
    
                // Redireciona para outra página
                return $this->redirectToRoute('listar_produtos');
            }
        }
    
        
        $data['titulo'] = "Editar produto";
        $data['produto'] = $produto; // Exibe os dados atuais do produto no formulário
    
        return $this->render("app/produto/novoProduto.html.twig", $data);
    }
    
}
?>



<!-- 
 $produto = $produtoRepository->find($id);

        if ($request->isMethod('POST')) {
            // Atualizar os campos do produto
            $produto->setNome($request->request->get('nome'));
            $produto->setDescricao($request->request->get('descricao'));
            $produto->setQuantidadeInicial($request->request->get('quantidadeInicial'));
            $produto->setQuantidadeDisponivel($request->request->get('quantidadeDisponivel'));
            $produto->setValor($request->request->get('valor'));
        }
        $em->flush();
           
      
        
        $data['titulo'] = "Editar produto";
        $data['produto'] = $produto;
        
        
        return $this->render("app/produto/novoProduto.html.twig",$data);
        return new Response();
-->