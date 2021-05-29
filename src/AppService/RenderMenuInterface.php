<?php


namespace App\AppService;


interface RenderMenuInterface
{
    public function render(string $baseUrl): string ;
}