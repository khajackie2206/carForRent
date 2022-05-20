<?php

namespace Khanguyennfq\CarForRent\core;

class Application
{

    /**
     * @return void
     */
    public function run(): void
    {
        print_r(Route::handle());
    }
}
