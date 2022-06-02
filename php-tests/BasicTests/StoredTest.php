<?php

namespace BasicTests;


use CommonTestClass;
use kalanis\kw_paths\Path;
use kalanis\kw_paths\Stored;


class StoredTest extends CommonTestClass
{
    public function testBasic(): void
    {
        $path = new Path();
        $path->setDocumentRoot('/tmp/none');

        Stored::init($path);
        $xPath = Stored::getPath();
        $xPath->setPathToSystemRoot('sdfgsdfgt/');
        $this->assertNotEquals(Stored::getOriginalPath(), $xPath);
    }
}
