<?php
namespace TCPDFModule\Factory;

use Interop\Container\ContainerInterface;
use TCPDF;
use TCPDF_FONTS;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class TCPDFFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        TCPDF_FONTS::addTTFfont(__DIR__.'/../../../fonts/ArialNarrow.ttf', 'TrueTypeUnicode');
        TCPDF_FONTS::addTTFfont(__DIR__.'/../../../fonts/ArialNarrow-Bold.ttf', 'TrueTypeUnicode');
        TCPDF_FONTS::addTTFfont(__DIR__.'/../../../fonts/ArialNarrow-BoldItalic.ttf', 'TrueTypeUnicode');
        TCPDF_FONTS::addTTFfont(__DIR__.'/../../../fonts/ArialNarrow-Italic.ttf', 'TrueTypeUnicode');

        return new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }
    
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, TCPDF::class);
    }
}