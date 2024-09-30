<?php

namespace App\Controller\Produtos;

use App\Service\CadastrarProdutoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CadastrarController extends AbstractController
{
    
    #[Route('produtos/cadastrar', name:"cadastrar_produto_show", methods: 'GET')]
    public function show(): Response
    {
        return $this->render('app/produto/cadastrar.twig');
    }

    #[Route('produtos/cadastrar', name:"cadastrar_produto_salvar",methods: 'POST')]
    public function salvar(Request $request, CadastrarProdutoService $cadastrarProdutoService): Response
    {
        $dados = $request->request->all();//pegar todos os campos da requisição
        $cadastrarProdutoService->salvar(dados : $dados);
       
        return $this->redirectToRoute("listar_produtos");
    }
} 
?>