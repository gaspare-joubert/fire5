<?php

namespace App\CSP\Policies;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;

class LocalDevelopmentPolicy extends Basic
{
    public function configure():void
    {
        parent::configure();

        // Allow 'unsafe-inline' and 'unsafe-eval' for local development
        $this->addDirective(Directive::SCRIPT, [
            'self',
            'unsafe-inline',
            'unsafe-eval'
        ]);

        $this->addDirective(Directive::STYLE, [
            'self',
            'unsafe-inline'
        ]);

        // Allow loading images from data URLs
        $this->addDirective(Directive::IMG, [
            'self',
            'data:'
        ]);

        // For local Vite development server
        if (app()->environment('local')) {
            $this->addDirective(Directive::CONNECT, [
                'self',
                'ws:',
                'http://localhost:5173', // Default Vite port
            ]);

            $this->addDirective(Directive::SCRIPT, [
                'http://localhost:5173'
            ]);

            $this->addDirective(Directive::STYLE, [
                'http://localhost:5173'
            ]);
        }

        // Use report-only mode in local development by default
        // This logs violations without blocking resources
        $this->reportOnly();
    }
}
