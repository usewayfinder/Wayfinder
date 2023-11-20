<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

$unitTestPathPrefix = '';
if ($_ENV['TEST_NAME'] === 'GitHubActions') {
    $unitTestPathPrefix = '';
}

require_once(getcwd().$unitTestPathPrefix.'framework/Wayfinder.php');

final class WayfinderTest extends TestCase
{

    private static $W = [],
            $i = 0;

    protected function setUp(): void
    {
        self::$W[self::$i] = new Wayfinder;
    }

    protected function tearDown(): void
    {
        self::$W[self::$i] = null;
        self::$i++;
    }

    public function testRealFilePathIsCorrect():void
    {
        $filePath = self::$W[self::$i]->realFilePath();
        $this->assertStringEndsWith('Wayfinder/framework/', $filePath);
    }

    public function testWayfinderLoadsTheDefaultRoute(): void
    {
        $_SERVER['REQUEST_URI'] = '/';
        ob_start();
        self::$W[self::$i]->init();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder</h1>', $output);
    }

    public function testWayfinderCanUseBasicCustomRoutesForExamples(): void
    {
        $_SERVER['REQUEST_URI'] = '/examples';
        ob_start();
        self::$W[self::$i]->init();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder examples</h1>', $output);
    }

    public function testWayfinderCanUseControllerAndMethodFromUriEvenWhenRouteIsDefined(): void
    {
        $_SERVER['REQUEST_URI'] = '/documentation/examples';
        ob_start();
        self::$W[self::$i]->init();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder examples</h1>', $output);
    }

    public function testWayfinderCanReturnJsonOutput():void
    {
        $_SERVER['REQUEST_URI'] = '/foo/first/second/third/fourth.json';
        ob_start();
        self::$W[self::$i]->init();
		$output = json_decode(ob_get_clean(), true);
        $this->assertEquals($output['controllerMethod'], 'test/third');
    }

    public function testWayfinderWithOnlyTheControllerSpecified(): void
    {
        $_SERVER['REQUEST_URI'] = '/documentation';
        ob_start();
        self::$W[self::$i]->init();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder documentation</h1>', $output);
    }

    public function testWayfinderWithBothTheControllerAndMethodSpecified(): void
    {
        $_SERVER['REQUEST_URI'] = '/documentation/routes';
        ob_start();
        self::$W[self::$i]->init();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Routes in Wayfinder</h1>', $output);
    }

    public function testWayfinderCanUnderstandNumericMethodsInRoutes():void
    {
        $_SERVER['REQUEST_URI'] = '/foo/first/second/third/fourth.json';
        ob_start();
        self::$W[self::$i]->init();
		$output = json_decode(ob_get_clean(), true);
        $this->assertEquals($output['params'][0], 'first');
        $this->assertEquals($output['params'][1], 'second');
        $this->assertEquals($output['params'][2], 'fourth');
    }

    public function testWayfinderPassesPredefinedParamsFirst():void
    {
        $_SERVER['REQUEST_URI'] = '/bar/first/second/third/fourth/.json';
        ob_start();
        self::$W[self::$i]->init();
		$output = json_decode(ob_get_clean(), true);
        $this->assertEquals($output['params'][0], 'predefinedparam');
        $this->assertEquals($output['params'][1], 'first');
        $this->assertEquals($output['params'][2], 'second');
        $this->assertEquals($output['params'][3], 'fourth');
    }

    public function testWayfinderPassesPredefinedParamsFirstExtended():void
    {
        $_SERVER['REQUEST_URI'] = '/bar/first/second/third/fourth/fifth.json';
        ob_start();
        self::$W[self::$i]->init();
		$output = json_decode(ob_get_clean(), true);
        $this->assertEquals($output['params'][0], 'predefinedparam');
        $this->assertEquals($output['params'][1], 'first');
        $this->assertEquals($output['params'][2], 'second');
        $this->assertEquals($output['params'][3], 'fourth');
        $this->assertEquals($output['params'][4], 'fifth');
    }

    public function testWayfinderCanUnderstandControllerMethodParamsRoute():void
    {
        $string = 'foobar';
        $_SERVER['REQUEST_URI'] = '/test/fourth/'.$string.'.json';
        ob_start();
        self::$W[self::$i]->init();
		$output = json_decode(ob_get_clean(), true);
        $this->assertEquals($output['p1'], $string);
    }

    public function testWayfinderInterpretsJsonFileType():void
    {
        $string = 'foobar';
        $_SERVER['REQUEST_URI'] = '/test/fifth/'.$string.'.json';
        self::$W[self::$i]->init();
        $mimeType = self::$W[self::$i]->getMimeType();
        $this->assertEquals($mimeType, 'json');
    }

    public function testWayfinderInterpretsTxtFileType():void
    {
        $string = 'foobar';
        $_SERVER['REQUEST_URI'] = '/test/fifth/'.$string.'.txt';
        self::$W[self::$i]->init();
        $mimeType = self::$W[self::$i]->getMimeType();
        $this->assertEquals($mimeType, 'txt');
    }

    public function testWayfinderInterpretsXmlFileType():void
    {
        $string = 'foobar';
        $_SERVER['REQUEST_URI'] = '/test/fifth/'.$string.'.xml';
        self::$W[self::$i]->init();
        $mimeType = self::$W[self::$i]->getMimeType();
        $this->assertEquals($mimeType, 'xml');
    }

    public function testWayfinderInterpretsHtmlFileType():void
    {
        $string = 'foobar';
        $_SERVER['REQUEST_URI'] = '/test/fifth/'.$string.'.html';
        self::$W[self::$i]->init();
        $mimeType = self::$W[self::$i]->getMimeType();
        $this->assertEquals($mimeType, 'html');
    }

    public function testWayfinderInterpretsRssFileType():void
    {
        $string = 'foobar';
        $_SERVER['REQUEST_URI'] = '/test/fifth/'.$string.'.rss';
        self::$W[self::$i]->init();
        $mimeType = self::$W[self::$i]->getMimeType();
        $this->assertEquals($mimeType, 'rss');
    }

    public function testWayfinderInterpretsAtomFileType():void
    {
        $string = 'foobar';
        $_SERVER['REQUEST_URI'] = '/test/fifth/'.$string.'.atom';
        self::$W[self::$i]->init();
        $mimeType = self::$W[self::$i]->getMimeType();
        $this->assertEquals($mimeType, 'atom');
    }

}
