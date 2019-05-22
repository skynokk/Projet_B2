<?php
/**
 * Created by PhpStorm.
 * User: Anton MYRAN
 * Date: 27/03/2019
 * Time: 12:28
 */

namespace App\CRUD;

use App\Entity\BienImmobilier;
use Doctrine\Common\Persistence\ObjectManager;

class BienImmobilierCRUD 
{
    protected $em;
    protected $BienImmobilierRepository;

    /**
     * @param ObjectManager $em
     */
    public function __construct(ObjectManager $em){

        $this->em = $em;
        $this->BienImmobilierRepository = $this->em->getRepository(BienImmobilier::class);
    }


    public function createBienImmobilier($superficie, $nbPieces, $etage, $prixMiseEnVente, $prixMin, $dateMiseEnVente){
        $monBien = new BienImmobilier();
        $monBien->setSuperficie($superficie);
        $monBien->setNbPieces($nbPieces);
        $monBien->setEtage($etage);
        $monBien->setPrixMiseEnVente($prixMiseEnVente);
        $monBien->setPrixMin($prixMin);
        $monBien->setDateMiseEnVente($dateMiseEnVente);

        $this->em->persist($monBien);

        $this->em->flush();

        return $monBien;
    }

    /**
     * @return object []
     */
    public function getAll(){
        $biens = $this->BienImmobilierRepository->findAll();
        return $biens;
    }

    /**
     * @param $idBien
     * @return object
     */
    public function getById($idBien)
    {
        $bien = $this->BienImmobilierRepository->find($idBien);
        return $bien;
    }
}