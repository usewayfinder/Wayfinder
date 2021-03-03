<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once(getcwd().'/../../framework/Wayfinder.php');

final class WayfinderTest extends TestCase
{

    public function testWayfinderLoadsTheDefaultRoute(): void
    {
        $_SERVER['REQUEST_URI'] = '/';
        ob_start();
        $w = new Wayfinder;
		$output = ob_get_clean();
        $this->assertStringContainsString('<h1>Wayfinder</h1>', $output);
    }

}
