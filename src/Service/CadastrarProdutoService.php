<?php

namespace App\Service;

use App\Entity\Produto;
use App\Repository\CategoriaRepository;
use App\Repository\ProdutoRepository;
use DateTime;

class CadastrarProdutoService 
{

    private ProdutoRepository $produtoRepository;
    private CategoriaRepository $categoriaRepository;

   public function __construct(
    ProdutoRepository $produtoRepository,
    CategoriaRepository $categoriaRepository
   )
   {
        $this->produtoRepository = $produtoRepository;
        $this->categoriaRepository = $categoriaRepository;
   }

    public function salvar( array $dados ): void
    {
        $categoriaId = $this->categoriaRepository->find($dados['categoriaId']);
     
        $produto = new Produto();
        $produto->setNome($dados['nome']);
        $produto->setDescricao($dados['descricao']);
        $produto->setQuantidadeInicial($dados['quantidade']);
        $produto->setQuantidadeDisponivel($dados['quantidade']);
        $produto->setDataCadastro(new DateTime());
        $produto->setCategoriaId($categoriaId);
        $produto->setValor($dados['valor']);

        $this->produtoRepository->salvar($produto);
           
    }
}
?>