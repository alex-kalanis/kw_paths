<?php

namespace ProcessingTests;


use CommonTestClass;
use kalanis\kw_paths\Extras\PathTransform;
use kalanis\kw_paths\PathsException;


class PathTest extends CommonTestClass
{
    /**
     * @param array<string> $to
     * @param string $from
     * @throws PathsException
     * @dataProvider transformProvider
     */
    public function testExpandFrom(array $to, string $from): void
    {
        $lib = new PathTransform();
        $this->assertEquals($to, $lib->expandName($from));
    }

    public function transformProvider(): array
    {
        return [
            [['okmijnuhb', ], 'okmijnuhb', ],
            // just dirs
            [['wsx', 'edc', 'rfv', ], 'wsx' . DIRECTORY_SEPARATOR . 'edc' . DIRECTORY_SEPARATOR . 'rfv', ],
            // dir slash
            [['wsx/', 'edc', 'r f v', ], 'wsx\/' . DIRECTORY_SEPARATOR . 'edc' . DIRECTORY_SEPARATOR . 'r f v', ],
            // too many slashes
            [['wsx\\', 'e-dc', 'r&f&v', ], 'wsx\\\\' . DIRECTORY_SEPARATOR . 'e-dc' . DIRECTORY_SEPARATOR . 'r&f&v', ],
            // empty path
            [['', ], '', ],
        ];
    }

    /**
     * @throws PathsException
     */
    public function testEmptyCompact(): void
    {
        $lib = new PathTransform();
        $this->expectException(PathsException::class);
        $lib->compactName(['any', 'where'], '');
    }

    /**
     * @throws PathsException
     */
    public function testEmptyExpand(): void
    {
        $lib = new PathTransform();
        $this->expectException(PathsException::class);
        $lib->expandName('any/where', '');
    }
}
