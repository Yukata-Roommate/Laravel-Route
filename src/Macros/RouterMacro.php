<?php

namespace YukataRm\Laravel\Route\Macros;

use Illuminate\Routing\Router;

use YukataRm\Info\Proxies\PHPInfo;

/**
 * Router Macro
 *
 * @package YukataRm\Laravel\Route\Macros
 *
 * @method \Illuminate\Routing\RouteRegistrar group(array $attributes, \Closure $routes)
 * @method \Illuminate\Routing\RouteRegistrar controller(string $controller)
 * @method \Illuminate\Routing\Route get(string $uri, array|string|callable|null $action = null)
 * @method \Illuminate\Routing\Route post(string $uri, array|string|callable|null $action = null)
 * @see \Illuminate\Routing\Router
 */
class RouterMacro
{
    /**
     * macro class
     *
     * @return string
     */
    public function class(): string
    {
        return Router::class;
    }

    /**
     * registered methods
     *
     * @return array<string, \Closure>
     */
    public function methods(): array
    {
        return [
            "phpinfo" => $this->phpinfo(),
        ];
    }

    /**
     * phpinfo
     *
     * @return \Closure
     */
    protected function phpinfo(): \Closure
    {
        return function (): void {
            $this->group(["prefix" => "phpinfo", "as" => "phpinfo."], function () {
                $this->get("/", function () {
                    return PHPInfo::show();
                })->name("all");

                $this->get("/general", function () {
                    return PHPInfo::make()->general()->show();
                })->name("general");

                $this->get("/credits", function () {
                    return PHPInfo::make()->credits()->show();
                })->name("credits");

                $this->get("/configuration", function () {
                    return PHPInfo::make()->configuration()->show();
                })->name("configuration");

                $this->get("/modules", function () {
                    return PHPInfo::make()->modules()->show();
                })->name("modules");

                $this->get("/variables", function () {
                    return PHPInfo::make()->variables()->show();
                })->name("variables");

                $this->get("/license", function () {
                    return PHPInfo::make()->license()->show();
                })->name("license");
            });
        };
    }
}
