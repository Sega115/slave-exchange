<?php


namespace App\Controller;


use App\Repository\SlaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("slave-list/{workID}", name="slave-list")
     * @param SlaveRepository $repository
     * @param int|null $workID
     * @return Response
     */
    public function slaveList(SlaveRepository $repository, int $workID = null)
    {
        return $this->render('slaveList/list.html.twig', [
            'slaves' => $repository->findByWorkId($workID)->getQuery()->getResult()
        ]);
    }
}