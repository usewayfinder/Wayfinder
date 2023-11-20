<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

$unitTestPathPrefix = '../../';
if ($_ENV['TEST_NAME'] === 'GitHubActions') {
    $unitTestPathPrefix = '';
}

require_once($unitTestPathPrefix.'framework/Wayfinder.php');

final class WayfinderTest extends TestCase
{

    protected function setUp(): void
    {
    }

    protected function tearDown(): void
    {
    }

/*    public function testRealFilePathIsCorrect():void
    {
        $w = new Wayfinder;
        $filePath = $w->realFilePath();
        $this->assertStringEndsWith('Wayfinder/framework/', $filePath);
    }

    public function testWayfinderLoadsTheDefaultRoute(): void
    {
        $w = new Wayfinder;
        $w->setRequestUri('/');
        ob_start();
        $w->init();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder</h1>', $output);
    }

    public function testWayfinderCanUseBasicCustomRoutesForExamples(): void
    {
        $w = new Wayfinder;
        $w->setRequestUri('/examples');
        ob_start();
        $w->init();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder examples</h1>', $output);
    }

    public function testWayfinderCanUseControllerAndMethodFromUriEvenWhenRouteIsDefined(): void
    {
        $w = new Wayfinder;
        $w->setRequestUri('/documentation/examples');
        ob_start();
        $w->init();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder examples</h1>', $output);
    }

    public function testWayfinderCanReturnJsonOutput():void
    {
        $w = new Wayfinder;
        $w->setRequestUri('/foo/first/second/third/fourth.json');
        ob_start();
        $w->init();
		$output = json_decode(ob_get_clean(), true);
        $this->assertEquals($output['controllerMethod'], 'test/third');
    }

    public function testWayfinderWithOnlyTheControllerSpecified(): void
    {
        $w = new Wayfinder;
        $w->setRequestUri('/documentation');
        ob_start();
        $w->init();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder documentation</h1>', $output);
    }

    public function testWayfinderWithBothTheControllerAndMethodSpecified(): void
    {
        $w = new Wayfinder;
        $w->setRequestUri('/documentation/routes');
        ob_start();
        $w->init();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Routes in Wayfinder</h1>', $output);
    }

    public function testWayfinderCanUnderstandNumericMethodsInRoutes():void
    {
        $w = new Wayfinder;
        $w->setRequestUri('/foo/first/second/third/fourth.json');
        ob_start();
        $w->init();
		$output = json_decode(ob_get_clean(), true);
        $this->assertEquals($output['params'][0], 'first');
        $this->assertEquals($output['params'][1], 'second');
        $this->assertEquals($output['params'][2], 'fourth');
    }

    public function testWayfinderPassesPredefinedParamsFirst():void
    {
        $w = new Wayfinder;
        $w->setRequestUri('/bar/first/second/third/fourth/.json');
        ob_start();
        $w->init();
		$output = json_decode(ob_get_clean(), true);
        $this->assertEquals($output['params'][0], 'predefinedparam');
        $this->assertEquals($output['params'][1], 'first');
        $this->assertEquals($output['params'][2], 'second');
        $this->assertEquals($output['params'][3], 'fourth');
    }

    public function testWayfinderPassesPredefinedParamsFirstExtended():void
    {
        $w = new Wayfinder;
        $w->setRequestUri('/bar/first/second/third/fourth/fifth.json');
        ob_start();
        $w->init();
		$output = json_decode(ob_get_clean(), true);
        $this->assertEquals($output['params'][0], 'predefinedparam');
        $this->assertEquals($output['params'][1], 'first');
        $this->assertEquals($output['params'][2], 'second');
        $this->assertEquals($output['params'][3], 'fourth');
        $this->assertEquals($output['params'][4], 'fifth');
    }

    public function testWayfinderCanUnderstandControllerMethodParamsRoute():void
    {
        $w = new Wayfinder;
        $string = 'foobar';
        $w->setRequestUri('/test/fourth/'.$string.'.json');
        ob_start();
        $w->init();
		$output = json_decode(ob_get_clean(), true);
        $this->assertEquals($output['p1'], $string);
    }

    public function testWayfinderInterpretsJsonFileType():void
    {
        $w = new Wayfinder;
        $string = 'foobar';
        $w->setRequestUri('/test/fifth/'.$string.'.json');
        $w->init();
        $mimeType = $w->getMimeType();
        $this->assertEquals($mimeType, 'json');
    }

    public function testWayfinderInterpretsTxtFileType():void
    {
        $w = new Wayfinder;
        $string = 'foobar';
        $w->setRequestUri('/test/fifth/'.$string.'.txt');
        $w->init();
        $mimeType = $w->getMimeType();
        $this->assertEquals($mimeType, 'txt');
    }

    public function testWayfinderInterpretsXmlFileType():void
    {
        $w = new Wayfinder;
        $string = 'foobar';
        $w->setRequestUri('/test/fifth/'.$string.'.xml');
        $w->init();
        $mimeType = $w->getMimeType();
        $this->assertEquals($mimeType, 'xml');
    }

    public function testWayfinderInterpretsHtmlFileType():void
    {
        $w = new Wayfinder;
        $string = 'foobar';
        $w->setRequestUri('/test/fifth/'.$string.'.html');
        $w->init();
        $mimeType = $w->getMimeType();
        $this->assertEquals($mimeType, 'html');
    }

    public function testWayfinderInterpretsRssFileType():void
    {
        $w = new Wayfinder;
        $string = 'foobar';
        $w->setRequestUri('/test/fifth/'.$string.'.rss');
        $w->init();
        $mimeType = $w->getMimeType();
        $this->assertEquals($mimeType, 'rss');
    }

    public function testWayfinderInterpretsAtomFileType():void
    {
        $w = new Wayfinder;
        $string = 'foobar';
        $w->setRequestUri('/test/fifth/'.$string.'.atom');
        $w->init();
        $mimeType = $w->getMimeType();
        $this->assertEquals($mimeType, 'atom');
    }*/

}
