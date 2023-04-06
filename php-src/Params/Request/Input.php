<?php

namespace kalanis\kw_paths\Params\Request;


use kalanis\kw_input\Interfaces\IEntry;
use kalanis\kw_input\Interfaces\IFiltered;
use kalanis\kw_paths\Params\Request;


/**
 * Class Input
 * @package kalanis\kw_paths\Params\Request
 * Input source is Request Uri in IInputs datasource which provides the path data
 * This one is for accessing with url rewrite engines
 * @codeCoverageIgnore access external variable
 * @deprecated since 2023-04-04
 */
class Input extends Request
{
    public function set(IFiltered $inputs, ?string $virtualDir = null): parent
    {
        $requestUri = $inputs->getInArray('REQUEST_URI', [IEntry::SOURCE_SERVER, ] );
        $entry = reset($requestUri);
        return $this->setData($entry ? strval($entry) : '', $virtualDir);
    }
}
