<?php


namespace App\Controller;


use App\Entity\Slave;
use App\Repository\SlaveRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SlaveController extends AbstractController
{
    /**
     * @Route("slave-list/{workID}", name="slave-list")
     * @param SlaveRepository $repository
     * @param int|null $workID
     * @return Response
     */
    public function slaveList(SlaveRepository $repository, int $workID = null): Response
    {
        return $this->render('slaveList/list.html.twig', [
            'slaves' => $repository->findByWorkId($workID)->getQuery()->getResult()
        ]);
    }


    /**
     * @Route("slave-info/{slaveID}", name="slave-info")
     * @ParamConverter("slave", options={"id" = "slaveID"})
     * @param Slave $slave
     * @return Response
     */
    public function salveInfo(Slave $slave): Response
    {
        return $this->render('slaveList/info.html.twig', [
            'slave' => $slave
        ]);
    }

}