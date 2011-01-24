<?php
/**
 * chkProcessTest Class PHP File
 * Created on January, the 12th 2010 at 21:26:14 by ronan
 *
 * @copyright Copyright (C) 2011 Ronan Guilloux. All rights reserved.
 * @license http://www.gnu.org/licenses/agpl.html GNU AFFERO GPL v3
 * @version //autogen//
 * @author Ronan Guilloux - coolforest.net
 * @package WebCheckerTests
 * @filesource processtest.php
 */

/**
 * Test class for chkProcess
 * Generated by PHPUnit on 2011-01-12 at 23:50:17.
 *
 * @package WebCheckerTests
 * @version //autogen//
 * @codeCoverageIgnore
 */
class chkProcessTest extends PHPUnit_Framework_TestCase
{

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @group WebCheckerTests
     */
    protected function setUp()
    {
        $this->object = new chkProcess();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @group WebCheckerTests
     */
    protected function tearDown()
    {
    }

    /**
     * @group WebCheckerTests
     */
    public function testSetters()
    {
        $this->object->logger = ezcLog::getInstance();
        $this->assertTrue( get_class($this->object->logger) === 'ezcLog' );

        $this->object->benchmarkSuite = new chkBenchmarkSuite();
        $this->assertTrue( get_class($this->object->benchmarkSuite) === 'chkBenchmarkSuite' );
    }

    /**
     * @group WebCheckerTests
     */
    public function testGet()
    {
        $this->object->logger = ezcLog::getInstance();
        $foo = $this->object->logger;
    }

    /**
     * @expectedException ezcBasePropertyNotFoundException
     * @group WebCheckerTests
     */
    public function testGetException()
    {
        $foo = $this->object->bar;
    }

    /**
     * @expectedException ezcBasePropertyNotFoundException
     * @group WebCheckerTests
     */
    public function testSetException_1()
    {
        $this->object->foo = 'bar';
    }

    /**
     * @expectedException ezcBaseValueException
     * @group WebCheckerTests
     */
    public function testSetException_2()
    {
        $this->object->logger = -1;
    }

    /**
     * @expectedException ezcBaseValueException
     * @group WebCheckerTests
     */
    public function testSetException_3()
    {
        $this->object->benchmarkSuite = -1;
    }

    /**
     * @group WebCheckerTests
     */
    public function testIsset()
    {
        $this->object->logger = ezcLog::getInstance();
        $this->assertTrue( isset( $this->object->logger ) );
    }

    /**
     * @group WebCheckerTests
     */
    public function testToString()
    {
        (string)$foo = (string)$this->object;
    }

    /**
     * @group WebCheckerTests
     */
    public function testRunFree()
    {
        $suite = $this->fillBenchmarkSuite();
        $this->object->setUp();
        $result = $this->object->run( $suite );
        $this->assertTrue( $result['status'] );
    }

    /**
     * @group WebCheckerTests
     */
    public function testRunWithOptions()
    {
        $options = array('excluded'=>'chkBenchmarkUri');
        $suite = $this->fillBenchmarkSuite($options);
        $this->object->setUp();
        $result = $this->object->run( $suite );
        $this->assertTrue( $result['status'] );
    }

    protected function fillBenchmarkSuite($options = null)
    {
        $suite = new chkBenchmarkSuite();
        if($options)
        {
            $suite = new chkBenchmarkSuite( $options );
        }
        $benchmarks = array();
        $benchmarks['one'] = new chkBenchmarkDemo(); // the quasi-abstract one...
        $benchmarks['two'] = new chkBenchmarkUri(); // a real one
        $result = $suite->add( $benchmarks['one'], 'one' );
        $result = $suite->add( $benchmarks['two'] );
        return $suite;
    }

}
?>
