<?php

namespace App\Controller\Categoria;

use App\Entity\Categoria;
use App\Repository\CategoriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CadastrarController extends AbstractController
{
    public function __construct(
        private CategoriaRepository $categoriaRepository
    )
    {
        
    }

    #[Route('categorias/cadastrar', name: 'cadastrar_categoria_show', methods: 'GET')]
    public function show(): Response
    {
        return $this->render('app/categoria/cadastrar.html.twig');
    }

    #[Route('categorias/cadastrar', name: 'cadastrar_categoria_salvar', methods: 'POST')]
    public function salvar(Request $request): Response
    {
        $nomeCategoria = $request->request->get('nome');

        // verifico se o nome da categoria é maior do que 50 
        if(strlen($nomeCategoria) > 50){
            $this->addFlash('danger','Nome deve ter no maximo 50 caracteres!');
            return $this->redirectToRoute('cadastrar_categoria_show');
        }

        // verifico se tem categorias com o mesmo nome
        $categoriaExistente = $this->categoriaRepository->findBy(['nome' => $nomeCategoria]);
        if($categoriaExistente){
            $this->addFlash('danger', "Categoria com nome \"{$nomeCategoria}\" já existe!");

            return $this->redirect('cadastrar_categoria_show');
        }

        $categoria = new Categoria();
        $categoria->setNome($nomeCategoria);

        $this->categoriaRepository->salvar($categoria);
           
        return $this->redirectToRoute("listar_categorias");

       
    }
    
}

?>