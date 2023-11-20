<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

$unitTestPathPrefix = '/../../../..';
if ($_ENV['TEST_NAME'] === 'GitHubActions') {
    $unitTestPathPrefix = '../../../../..';
}

require_once $unitTestPathPrefix.'/framework/Wayfinder.php';
require_once $unitTestPathPrefix.'/app/controllers/documentation.php';

final class DocumentationTest extends TestCase
{

    private $w;

    function setUp():void {
        $this->w = new Documentation;
    }

    public function testDocumentationHomepageIsCreated(): void
    {
        ob_start();
        $this->w->home();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder</h1>', $output);
    }

    public function testDocumentationOverviewIsCreated(): void
    {
        ob_start();
        $this->w->index();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder documentation</h1>', $output);
    }

    public function testRoutesDocumentationIsCreated(): void
    {
        ob_start();
        $this->w->routes();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Routes in Wayfinder</h1>', $output);
    }

    public function testModelsDocumentationIsCreated(): void
    {
        ob_start();
        $this->w->models();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Models in Wayfinder</h1>', $output);
    }

    public function testViewsDocumentationIsCreated(): void
    {
        ob_start();
        $this->w->views();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Views in Wayfinder</h1>', $output);
    }

    public function testControllersDocumentationIsCreated(): void
    {
        ob_start();
        $this->w->controllers();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Controllers in Wayfinder</h1>', $output);
    }

    public function testDatabaseDocumentationIsCreated(): void
    {
        ob_start();
        $this->w->database();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Databases in Wayfinder</h1>', $output);
    }

    public function testLibrariesDocumentationIsCreated(): void
    {
        ob_start();
        $this->w->libraries();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Libraries in Wayfinder</h1>', $output);
    }

    public function testCLIDocumentationIsCreated(): void
    {
        ob_start();
        $this->w->cli();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>The Wayfinder CLI</h1>', strip_tags($output, '<h1>'));
    }

    public function testErrorsDocumentationIsCreated(): void
    {
        ob_start();
        $this->w->errors();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Errors in Wayfinder</h1>', $output);
    }

    public function testPageLoaded(): void
    {
        ob_start();
        $this->w->home();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder</h1>', $output);
        ob_start();
        $this->w->errors();
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Errors in Wayfinder</h1>', $output);
    }

}
