<?php
/**
 * Created by Alpha-Hydro.
 * @link http://www.alpha-hydro.com
 * @author Vladimir Mikhaylov <admin@alpha-hydro.com>
 * @copyright Copyright (c) 2016, Alpha-Hydro
 *
 */

namespace TCPDFModule\Factory;

use TCPDF;
use TCPDF_FONTS;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class TCPDFFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        TCPDF_FONTS::addTTFfont(__DIR__.'/../../../../../data/fonts/ArialNarrow.ttf', 'TrueTypeUnicode');
        TCPDF_FONTS::addTTFfont(__DIR__.'/../../../../../data/fonts/ArialNarrow-Bold.ttf', 'TrueTypeUnicode');
        TCPDF_FONTS::addTTFfont(__DIR__.'/../../../../../data/fonts/ArialNarrow-BoldItalic.ttf', 'TrueTypeUnicode');
        TCPDF_FONTS::addTTFfont(__DIR__.'/../../../../../data/fonts/ArialNarrow-Italic.ttf', 'TrueTypeUnicode');

        return new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }
}