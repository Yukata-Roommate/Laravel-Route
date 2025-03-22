<?php

namespace YukataRm\Laravel\Route;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

use YukataRm\Laravel\Route\Macros\RouterMacro;

/**
 * Route Service Provider
 *
 * @package YukataRm\Laravel\Route
 */
class ServiceProvider extends BaseServiceProvider
{
    /*----------------------------------------*
     * Boot
     *----------------------------------------*/

    /**
     * boot
     *
     * @return void
     */
    public function boot(): void
    {
        $this->bootMacros();
    }

    /**
     * boot macros
     *
     * @return void
     */
    protected function bootMacros(): void
    {
        $macro = new RouterMacro();

        $macroClass   = $macro->class();
        $macroMethods = $macro->methods();

        if (!class_exists($macroClass)) return;

        if (!method_exists($macroClass, "macro")) return;

        foreach ($macroMethods as $name => $closure) {
            $macroClass::macro($name, $closure);
        }
    }
}
