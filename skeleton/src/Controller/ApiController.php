<?php

namespace App\Controller;

use App\Entity\History;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class ApiController extends AbstractFOSRestController
{
    /**
     * @Route("/exchange/values", methods={"POST"}, name="app_exchange_values")
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function exchange(ManagerRegistry $doctrine, Request $request): \FOS\RestBundle\View\View
    {
        $repository = $doctrine->getRepository(History::class);
        
        // Get JSON data
        $jsonData = json_decode($request->getContent(), true);

        // Check if mandatory variables are present
        if (!isset($jsonData['first']) || !isset($jsonData['second'])) {
            return $this->view('Mandatory variables are absent', 400);
        }
        $first = (int)$jsonData['first'];
        $second =  (int)$jsonData['second'];

        // Create a new History entity.
        $history = $this->createHistoryEntity($first,$second);              
        $repository->add($history, true);

        // Swap values
        $this->swap($first,$second);
        $history->setFirstIn($first);
        $history->setSecondIn($second);

        // Update a History entity.
        $this->updateHistoryEntity($doctrine, $history);

        return $this->view('Success', 201);
    }
    /**
     * Update a History entity.
     * @param ManagerRegistry $doctrine
     * @param History $history
     * @return void
     */
    protected function updateHistoryEntity(ManagerRegistry $doctrine, History $history): void
    {
        $history->setUpdateDate(new \DateTime());
        $doctrine->getManager()->flush();
    }
    /**
     * Create a new History entity.
     * @param int $first
     * @param int $second
     * @return History
     */
    protected function createHistoryEntity($first,$second): History
    {
        $history = new \App\Entity\History();
        $history->setFirstIn($first);
        $history->setSecondIn($second);
        $history->setFirstOut(0);
        $history->setSecondOut(0);
        $history->setCreationDate(new \DateTime());
        $history->setUpdateDate(new \DateTime());
        return $history;
    }

    /**
     * Method to swap values
     * @param int $first
     * @param int $second
     * @return void
     */
    protected function swap(&$first,&$second): void
    {
        list($first,$second) = array($second,$first);
    }
}
