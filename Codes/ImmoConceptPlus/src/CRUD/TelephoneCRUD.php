<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn MYRAN
 * Date: 27/03/2019
 * Time: 11:54
 */

namespace App\CRUD;

use App\Entity\Telephone;
use Doctrine\ORM\EntityManagerInterface;


class TelephoneCRUD
{
    protected $em;
    protected $TelephoneRepository;

    /**
     * @param EntityManagerInterface $em
     */
    public function __create(EntityManagerInterface $em){
        $this->em = $em;
        $this->TelephoneRepository = $this->em->getRepository(Telephone::class);
    }

    /**
     * @param $numero
     * @param $idProprietaire
     * @param $idType
     */
    public  function createTelephone($numero, $idProprietaire, $idType){
        $myTelephone = new Telephone();
        $myTelephone->setNumero($numero);
        $myTelephone->setIdPersonne($idProprietaire);
        $myTelephone->setIdType($idType);
    }

    /**
     * @return object
     */
    public function getTelephone($numeroTelephone){
        $tel = $this->TelephoneRepository->find($numeroTelephone);
        return $tel;
    }

    /**
     * @param $numeroTelephone
     */
    public function deleteTelephone($numeroTelephone){
        $tel = $this->TelephoneRepository->find($numeroTelephone);
        $this->em->remove($tel);
        $this->em->flush();
    }
}