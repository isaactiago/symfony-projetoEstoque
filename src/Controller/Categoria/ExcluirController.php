<?php 


namespace App\Controller\Categoria;


use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExcluirController extends AbstractController
{
    #[Route('categorias/excluir/{id}', name: 'categoria_excluir')]
    public function excluir(
        int $id, 
        EntityManagerInterface $em,
        CategoriaRepository $categoriaRepository
        ): Response
    {
      
        $categoria = $categoriaRepository->find($id);

        $em->remove($categoria);//excluir a categoria a nivel de memoria
        $em->flush();//efetivamente excluir do bd

       return $this->redirectToRoute("listar_categorias");
    }
}
?>