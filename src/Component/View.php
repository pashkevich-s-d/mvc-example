<?php

namespace PashkevichSD\MvcExample\Component;

class View
{
    public static function build(string $tempalte, string $page, array $data = []): void
    {
        $tempate = TEMPLATES_PATH . DIRECTORY_SEPARATOR . $tempalte . '.php';
        $page = PAGES_PATH . DIRECTORY_SEPARATOR . $page . '.php';

        $data['pagePath'] = $page;

        extract($data);

        require ($tempate);
    }
}
