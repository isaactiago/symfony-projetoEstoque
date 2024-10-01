<?php 


namespace App\Controller\Categoria;


use App\Repository\CategoriaRepository;
use App\Repository\ProdutoRepository;
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
        CategoriaRepository $categoriaRepository,
        ProdutoRepository $produtoRepository,
        ): Response
    {
      
        $categoria = $categoriaRepository->find($id);
        //tenho q verificar se existe um produto criado

        $produtoExiste = $produtoRepository->findOneBy(['categoria_id' => $categoria]);

       
        if($produtoExiste)
        {
            $this->addFlash('danger','nao pode ser excluido');
            return $this->redirectToRoute("listar_categorias");
        }

        $em->remove($categoria);//excluir a categoria a nivel de memoria
        $em->flush();//efetivamente excluir do bd
       return $this->redirectToRoute("listar_categorias");
    }
}
?>