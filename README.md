# TCPDFModule

A Zend Framework 2 module for incorporating TCPDF support.

## Requirements

* Zend Faramework 2

## Installation

Installation of TCPDFModule uses PHP Composer. For more information about PHP Composer, please visit the official [PHP Composer site](http://getcomposer.org/).

#### Installation steps

```php composer.phar require vladmeh/zf2-tcpdf:dev-master```

or

    
1. ```cd my/project/directory```

2. create a composer.json file with following contents:

    ```
     {
         "require": {
             "vladmeh/zf2-tcpdf": "dev-master"
         }
     }
    ```

3. install PHP Composer via curl -s http://getcomposer.org/installer | php (on windows, download (http://getcomposer.org/installer) and execute it with PHP)

4. run ```php composer.phar install```

5. open my/project/directory/config/application.config.php and add the following key to your modules:

     ```
     'TCPDFModule',
     ```
    
#### Example usage

> Side note: use of getServiceLocator() in the controller is deprecated since in ZF3. Make sure you create your controller via a factory and inject the TCPDF object in the constructor. 
> [Migration Guide](http://zendframework.github.io/zend-servicemanager/migration/#factories)

```php
// module config: module\Application\config\module.config.php

<?php
namespase Application;

return array(
    'controllers' => array(
        'factories' => array(
            'Application\Controller\Index' => 'Application\Factory\IndexControllerFactory',
        )
    ),
    'router' => array(...),
    ...
)
```

```php
// module\Application\src\Application\Factory\IndexControllerFactory.php

<?php

namespace Application\Factory;

use Application\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $renderer           = $realServiceLocator->get('Zend\View\Renderer\RendererInterface');
        $tcpdf              = $realServiceLocator->get('TCPDF');

        return new IndexController(
            $tcpdf,
            $renderer
        );
    }
}
```

```php
// module\Application\src\Application\Controller\IndexController.php
<?php

namespace Application\Controller;

use TCPDF;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\RendererInterface;

class IndexController extends AbstractActionController
{

    /**
     * @var TCPDF
     */
    protected $tcpdf;

    /**
     * @var RendererInterface
     */
    protected $renderer;

    public function __construct($tcpdf, $renderer)
    {
        $this->tcpdf = $tcpdf;
        $this->renderer = $renderer;
    }

    public function indexAction()
    {
        $view = new ViewModel();
        
        $renderer = $this->renderer;
        $view->setTemplate('pdf');
        $html = $renderer->render($view);

        $pdf = $this->tcpdf;
        
        $pdf->SetFont('arialnarrow', '', 12, '', false);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output();
    }

}

```




