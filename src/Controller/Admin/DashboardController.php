<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Slave;
use App\Entity\Work;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Slave Exchange');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Главная', 'fa fa-home');
        yield MenuItem::linkToCrud('Категории', 'fas fa-list', Work::class);
        yield MenuItem::linkToCrud('Рабы', 'fas fa-list', Slave::class);
        yield MenuItem::linkToCrud('Клиенты', 'fas fa-list', Client::class);
    }
}
