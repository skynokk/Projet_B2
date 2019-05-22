<?php
/**
 * Created by PhpStorm.
 * User: Nolwenn MYRAN
 * Date: 27/03/2019
 * Time: 11:54
 */

namespace App\CRUD;

use App\Entity\TypeTelephone;
use Doctrine\ORM\EntityManagerInterface;


class TelephoneTypeCRUD
{
    protected $em;
    protected $typeTelephoneRepository;

    /**
     * @param EntityManagerInterface $em
     */
    public function __create(EntityManagerInterface $em){
        $this->em = $em;
        $this->typeTelephoneRepository = $this->em->getRepository(TypeTelephone::class);
    }

    /**
     * @return object []
     */
    public function getAllTypesTelephone(){
        $types = $this->typeTelephoneRepository->findAll();
        return $types;
    }
}