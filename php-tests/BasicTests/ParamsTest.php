<?php

namespace BasicTests;


use CommonTestClass;
use kalanis\kw_paths\Params;


class ParamsTest extends CommonTestClass
{
    public function testBasic(): void
    {
        $params = new Params\Arrays();
        $params->setData(['abc'=>'def','ghi'=>'jkl','mno'=>'pqr',]);
        $this->assertEquals(['abc'=>'def','ghi'=>'jkl','mno'=>'pqr',], $params->process()->getParams());
    }

    /**
     * @param string $uri
     * @param string|null $virtualDir
     * @param string $key
     * @param bool $exists
     * @param string|null $value
     * @dataProvider requestProvider
     */
    public function testRequest(string $uri, ?string $virtualDir, string $key, bool $exists, ?string $value)
    {
        $params = new Params\Request();
        $result = $params->setData($uri, $virtualDir)->process()->getParams();
        $this->assertEquals($exists, isset($result[$key]));
        if ($exists) {
            $this->assertEquals($value, $result[$key]);
        }
    }

    public function requestProvider(): array
    {
        return [
            ['/Sources/Request.php?abc=def&ghi[]=jkl&ghi[]=mno&pqr', null, 'abc', true, 'def'],
            ['/Sources/Request.php?abc=def&ghi[]=jkl&ghi[]=mno&pqr', null, 'lang', false, null],
            ['/web/ms:dfhfdh/l:fdgh/g:/definite/unknown/?abc=def&ghi[]=jkl&ghi[]=mno&pqr&vars=1', null, 'lang', false, null],
            ['/web/ms:dfhfdh/l:fdgh/g:/definite/unknown/?abc=def&ghi[]=jkl&ghi[]=mno&pqr&vars=1&lang=rrr', 'web/', 'abc', true, 'def'],
            ['/web/ms:dfhfdh/l:fdgh/g:/definite/unknown/?abc=def&ghi[]=jkl&ghi[]=mno&pqr&vars=1&lang=rrr', 'web/', 'lang', true, 'rrr'],
            ['/web/definite/unknown/?abc=def&ghi[]=jkl&ghi[]=mno&pqr&vars=1&lang=rrr', 'web/', 'pqr', true, ''],
            ['/web/definite/unknown/?abc=def&ghi[]=jkl&ghi[]=mno&pqr&vars=1&lang=rrr', 'web/', 'path', true, 'definite/unknown/'],
            ['/web/m:stgs/u:gnfnj/g:/definite/unknown/?abc=def&ghi[]=jkl&ghi[]=mno&pqr', 'web/', 'module', true, 'stgs'],
            ['/web/m:stgs/u:gnfnj/g:/definite/unknown/?abc=def&ghi[]=jkl&ghi[]=mno&pqr&vars=1&lang=rrr', 'system/', 'staticalPath', true, '/web/m:stgs/u:gnfnj/g:/definite/unknown/'],
            ['/web/m:stgs/u:gnfnj/g:/definite/unknown/?abc=def&ghi[]=jkl&ghi[]=mno&pqr&vars=1&lang=rrr', 'system/', 'path', false, null],
        ];
    }
}
