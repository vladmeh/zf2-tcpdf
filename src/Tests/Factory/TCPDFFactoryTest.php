<?php
namespace TCPDFModule\Tests\Factory;

use TCPDFModule\Factory\TCPDFFactory;

class TCPDFFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $factory;
    public function setUp()
    {
        $this->factory = new \TCPDFModule\Factory\TCPDFFactory();
    }
    public function test_it_is_initializable()
    {
        self::assertInstanceOf('TCPDFModule\Factory\TCPDFFactory', $this->factory);
    }
}