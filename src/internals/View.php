<?php

class View
{
    protected function render_page(array $data, string $page_name)
    {
        require_once __DIR__ . '/../views/index.php';
    }
}
