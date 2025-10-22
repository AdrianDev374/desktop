<?php

namespace Native\Desktop\Listeners;

use Native\Desktop\App;
use Throwable;

final readonly class ApplicationClosingListener
{
    public function __construct(private App $app) {}

    public function handle(): void
    {
        // Execute all registered closing actions
        collect(config('nativephp.closing_actions', []))->each($this->executeAction());

        // Notify Electron to quit the application
        $this->app->quit();
    }

    private function executeAction(): callable
    {
        return function (string $class) {
            if (! class_exists($class)) {
                return;
            }

            $action = app($class);

            try {
                if (is_callable($action)) {
                    $action();

                    return;
                }

                if (method_exists($action, 'handle')) {
                    $action->handle();

                    return;
                }

            } catch (Throwable) {
                // Silence the errors because we are closing the app
            }
        };
    }
}
