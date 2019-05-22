<?php
/**
 * Created by PhpStorm.
 * User: Anton MYRAN
 * Date: 27/03/2019
 * Time: 09:42
 */

namespace App\CRUD;

use App\Entity\Agent;
use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;

class AgentCRUD
{

    protected $em;
    protected $agentRepository;
    protected $personneRepository;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
        $this->agentRepository = $this->em->getRepository(Agent::class);
        $this->personneRepository = $this->em->getRepository(Personne::class);
    }

    /**
     * @param $idAgence
     * @param $idPersonne
     * @param $email
     * @param $photo
     * @return object
     */
    public function createAgent($idAgence, $idPersonne, $email, $photo){
        $newAgent = new Agent();
        $newAgent->setIdAgence($idAgence);
        $newAgent->setIdPersonne($idPersonne);
        $newAgent->setAdresseMail($email);
        $newAgent->setPhoto($photo);

        $this->em->persist($newAgent);

        $this->em->flush();

        return $newAgent;
    }

    /**
     * @param $idAgent
     * @param $idAgence
     * @param $email
     * @param $photo
     * @return object|null
     */
    public function updateAgent($idAgent, $idAgence, $email, $photo){
        $myAgent = $this->agentRepository->find($idAgent);

        if(!$myAgent){
            return null;
        }
        else{
            if ($idAgence != null){
                $myAgent->setIdAgence($idAgence);
            }
            if ($email != null){
                $myAgent->setAdresseMail($email);
            }
            if ($photo != null){
                $myAgent->setPhoto($photo);
            }
            return $myAgent;
        }
    }

    /**
     * @param $idAgent
     */
    public function deleteAgent($idAgent){
        $myAgent = $this->agentRepository->find($idAgent);
        $this->em->remove($myAgent);
        $this->em->flush;
    }

    /**
     * @return object[]
     */
    public function getAgents(){
        $agents = $this->agentRepository->findAll();
        return $agents;
    }

    /**
     * @param $idAgent
     * @return object
     */
    public function getAgentById($idAgent){
        $myAgent = $this->agentRepository->find($idAgent);
        return $myAgent;
    }

    public function getProfilData($idAgent){
        $myAgent = $this->agentRepository->find($idAgent);
        $idPersonne = $myAgent->getIdPersonne();
        return $this->personneRepository->find($idPersonne);
    }

}