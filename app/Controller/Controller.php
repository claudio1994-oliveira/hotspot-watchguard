<?php

namespace App\Controller;

abstract class Controller
{
    public function render(string $pathTemplate, array $data): void
    {
        extract($data);
        ob_start();

        // definir um base_path no .Env
        require __DIR__ . '/../../views/' . $pathTemplate;
        $html = ob_get_clean();
        echo $html;
    }
}