<?php

namespace App\CSP\Policies;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;

class ProductionPolicy extends Basic
{
    // todo: add production CSP directives here
    public function configure():void
    {
        parent::configure();

        // Add your production CSP directives here
        // For example:
        $this->addDirective(Directive::SCRIPT, [
            'self',
            // Add any trusted script sources for production
        ]);

        // Other production-specific rules...
    }
}
