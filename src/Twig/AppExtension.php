<?php

namespace App\Twig;

use App\AppService\RenderMenuInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $renderMenu;


    public function __construct( RenderMenuInterface $renderMenu)
    {
        $this->renderMenu = $renderMenu;
    }

    public function getFilters(): array
    {
        return [];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('renderMenu', [$this, 'renderMenu']),
        ];
    }

    public function renderMenu($baseUrl)
    {
        echo $this->renderMenu->render($baseUrl);
    }
}
