<?php declare(strict_types=1);

namespace Lintaba\Fastforms;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class FastformsServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    
        $this->loadViews();
    
        $this->loadTranslations();
    
    }
    
    public function register()
    {
        $this->app->singleton('Fastforms', function (Container $app) {return new Fastforms();});
    }
    
    private function loadViews()
    {
        $viewsPath = $this->packagePath('Resources/views');
        
        $this->loadViewsFrom($viewsPath, 'Fastforms');
        
        $this->publishes([$viewsPath => base_path('Resources/views/vendor/fastforms'),], 'views');
    }
    
    private function loadTranslations()
    {
        $translationsPath = $this->packagePath('Resources/lang');
        
        $this->loadTranslationsFrom($translationsPath, 'Fastforms');
        
        $this->publishes([$translationsPath => base_path('Resources/lang/vendor/fastforms'),], 'translations');
    }
    
    private function packagePath($path)
    {
        return __DIR__."/$path";
    }
}
