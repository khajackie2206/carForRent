<?php

namespace Khanguyennfq\CarForRent\tests\app;

use Khanguyennfq\CarForRent\app\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testRedirect()
    {
        View::redirect('/');
        $this->assertContains('location: /', xdebug_get_headers());
    }
}
