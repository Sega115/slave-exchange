<?php


namespace App\AppService;


class RenderMenu implements RenderMenuInterface
{

    private $menuBuilder;

    public function __construct(TreeMenuInterface $menuBuilder)
    {
        $this->menuBuilder = $menuBuilder;
    }

    public function render(string $baseUrl): string
    {
        $data = $this->menuBuilder->build();
        return $this->buildMenu($data, $baseUrl);
    }

    private function buildMenu($data, $baseUrl): string {
        $result = '';
        if (count($data) == 0){
            return $result;
        }
        $result .= '<ul>';
        foreach ($data as $datum){
            $children = $datum['children'] ?: [];
            $child = $this->buildMenu($children, $baseUrl);
            $result .= '<li><a href="'.$baseUrl.'/'.$datum['id'].'">'.$datum['title'].'</a>'.$child.'</li>';
        }
        $result .= '</ul>';
        return $result;
    }
}