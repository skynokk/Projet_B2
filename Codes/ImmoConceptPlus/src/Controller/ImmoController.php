<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use App\Entity\BienImmobilier;
use App\Entity\TypeBien;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Client;
use App\Entity\Commenter;
use App\Entity\Photo;

//CRUD
use App\CRUD\BienImmobilierCRUD;
use phpDocumentor\Reflection\Types\Null_;

class ImmoController extends AbstractController
{
 
    /**
     * @Route("/", name="immo")
     * 
     */
    public function index()
    {   
   
        $repo = $this->getDoctrine()->getRepository(BienImmobilier::class);
        //$cataloge = $BICRUD->findAll();
        $cataloge = $repo->findAll();
       
    
        $rep = $this->getDoctrine()->getRepository(TypeBien::class);
        $typez = $rep->findAll(0);
        
      

        return $this->render('immo/index.html.twig', [
            'controller_name' => 'ImmoController',
            'cataloges' => $cataloge,
            'typezs' => $typez,
 
              
        ]);
    }

    /**
     * @Route("/achat",name="achat")
     * 
     */
    public function acheter(){
        $repo = $this->getDoctrine()->getRepository(BienImmobilier::class);
        $cataloge = $repo->findAll();
        return $this->render('immo/acheter.html.twig',[
            'cataloges' => $cataloge,
        ]);
    }

    /**
     * @Route("/catalogue/{id}",name="show")
     */
        public function show($id/*,Request $request, $idClient*/){
        $repo = $this->getDoctrine()->getRepository(BienImmobilier::class);
        $nom = $repo->find($id);
        $lienbien = $nom->getCommentaires();
        $photo = $nom->getPhotos();
        /*
        $repoClient=$this->getDoctrine()->getRepository(Client::class);
        $client = $repoClient->find($idClient);

        $client->addFavoriser($nom);
        $entityManager->flush(); */

        
        $lienbien = $nom->getCommentaires();
        $photo = $nom->getPhotos();
        return $this->render('immo/seul.html.twig',[
            'noms'=> $nom,
            'lienbiens' => $lienbien,
            'photos' => $photo
        ]);
    }

    /**
     * @Route("/profil/{id}",name="profil_show")
     */
    public function profil_show($id){
        $repo = $this->getDoctrine()->getRepository(Personne::class);
        $information = $repo->find($id);

        return $this->render('immo/profil.html.twig',[
            'information'=> $information,
        ]);
    }

        /**
     * @Route("/agent/{id}",name="agent_show")
     */
    public function agent_show($id){
        $repo = $this->getDoctrine()->getRepository(Personne::class);
        $information = $repo->find($id);

        return $this->render('immo/agent.html.twig',[
            'information'=> $information,
        ]);
    }

    public function findAllBienImmobilier(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT i.id, i.nb_pieces, i.description, t.libelle 
            FROM BienImmobilier i, TypeBien t
            WHERE i.type_bien_id = 
            ORDER BY p.price ASC
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['price' => $price]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

}
