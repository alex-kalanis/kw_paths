<?php

namespace kalanis\kw_paths\Params\Request;


use kalanis\kw_paths\Params\Request;


/**
 * Class Server
 * @package kalanis\kw_paths\Params\Request
 * Input source is Request Uri in _SERVER variable
 * This one is for accessing with url rewrite engines
 * @codeCoverageIgnore access external variable
 * @deprecated since 2023-04-04
 */
class Server extends Request
{
    public function set(?string $virtualDir = null): parent
    {
        return $this->setData($_SERVER['REQUEST_URI'], $virtualDir);
    }
}
