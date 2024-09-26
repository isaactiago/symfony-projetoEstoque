<?php 

namespace App\Controller\Categoria;

use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 class EditarController extends AbstractController
{
     #[Route('categorias/editar/{id}', name: 'categoria_editar')]
    public function editar(
        int $id, Request $request,
        EntityManagerInterface $em,
        CategoriaRepository $categoriaRepository
        ): Response
    {
        $msg = "";
        $categoria = $categoriaRepository->find($id); //retorna a categoria pelo $id
        $form = $this->createForm(CategoriaType::class,$categoria);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $msg = 'Produto atualizadi';
        }

        $data['titulo'] = "Editar categoria";
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->render("app/categoria/novaCategoria.twig",$data);
    }
}
?> 