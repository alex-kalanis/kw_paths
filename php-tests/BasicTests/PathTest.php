<?php

namespace BasicTests;


use CommonTestClass;
use kalanis\kw_paths\ArrayPath;
use kalanis\kw_paths\Path;
use kalanis\kw_paths\PathsException;


class PathTest extends CommonTestClass
{
    public function testBasic(): void
    {
        $path = new Path();
        $path->setData(['user'=>'def','module'=>'jkl','mno'=>'pqr',]);
        $path->setDocumentRoot('/abc/def/ghi/jkl');
        $path->setPathToSystemRoot('../mno/pqr');
        $this->assertEquals(implode(DIRECTORY_SEPARATOR, ['', 'abc', 'def', 'ghi', 'jkl']), $path->getDocumentRoot());
        $this->assertEquals(implode(DIRECTORY_SEPARATOR, ['..', 'mno', 'pqr']), $path->getPathToSystemRoot());
        $this->assertEmpty($path->getStaticalPath());
        $this->assertEmpty($path->getVirtualPrefix());
        $this->assertEquals('def', $path->getUser());
        $this->assertEmpty($path->getLang());
        $this->assertEmpty($path->getPath());
        $this->assertEquals('jkl', $path->getModule());
        $this->assertEmpty($path->isSingle());
    }

    /**
     * @throws PathsException
     */
    public function testArrayPath1(): void
    {
        $path = new ArrayPath();
        $path->setString(implode(DIRECTORY_SEPARATOR, ['', 'abc', '..', 'def.ghi', '.', 'jkl', '', 'mno.pqr']));
        $this->assertEquals(implode(DIRECTORY_SEPARATOR, ['abc', 'def.ghi', 'jkl', 'mno.pqr']), (string) $path);
        $this->assertEquals('mno.pqr', $path->getFileName());
        $this->assertEquals(implode(DIRECTORY_SEPARATOR, ['abc', 'def.ghi', 'jkl']), $path->getStringDirectory());
        $this->assertEquals(implode(DIRECTORY_SEPARATOR, ['abc', 'def.ghi', 'jkl', 'mno.pqr']), $path->getString());
        $this->assertEquals(['abc', 'def.ghi', 'jkl'], $path->getArrayDirectory());
        $this->assertEquals(['abc', 'def.ghi', 'jkl', 'mno.pqr'], $path->getArray());
    }

    /**
     * @throws PathsException
     */
    public function testArrayPath2(): void
    {
        $path = new ArrayPath();
        $path->setArray(['', '.', '..', '.', '']); // content NOPE!
        $this->assertEquals('', (string) $path);
        $this->assertEquals('', $path->getFileName());
        $this->assertEquals('', $path->getStringDirectory());
        $this->assertEquals('', $path->getString());
        $this->assertEquals([], $path->getArrayDirectory());
        $this->assertEquals([], $path->getArray());
    }

    /**
     * @throws PathsException
     */
    public function testArrayPath3(): void
    {
        $path = new ArrayPath();
        $path->setString('abcdef');
        $this->assertEquals('abcdef', (string) $path);
        $this->assertEquals('abcdef', $path->getFileName());
        $this->assertEquals('', $path->getStringDirectory());
        $this->assertEquals('abcdef', $path->getString());
        $this->assertEquals([], $path->getArrayDirectory());
        $this->assertEquals(['abcdef'], $path->getArray());
    }
}
