<?php namespace Prexlab\LaravelMixmix;



class BladeServiceProviderTest extends \Orchestra\Testbench\TestCase
{


    /**
     * Load the package
     * @return array the packages
     */
    protected function getPackageProviders($app)
    {
        return [
            \Prexlab\LaravelMixmix\BladeServiceProvider::class
        ];
    }

    protected function render ($template) {
      ob_start();
      $compiled = app('blade.compiler')->compileString($template);
      $__env = app('view');
      eval('?>'.$compiled);
      $output = ob_get_contents();
      ob_end_clean();
      return $output;

    }
    protected function assertBladeRenders($expectedHtml, $viewContent)
    {
        $this->assertEquals($expectedHtml, $this->render($viewContent));
    }

    /** @test */
    public function test_mixmix_render()
    {
         $this->assertRegExp('/^<link href="\/storage\/mixmix\/6a31c90ac0cd4cf7efcfb64de3206404/', $this->render(file_get_contents(__DIR__.'/links.blade.php')));
    }

    /** @test */
    public function test_mixmix_mixed_contents()
    {
         $this->assertEquals(file_get_contents(__DIR__.'/sample.css') , file_get_contents(storage_path('app/public/mixmix/6a31c90ac0cd4cf7efcfb64de3206404.css')));
    }



}
