<?php
namespace Axstrad\SymfonyBridge\WorkForce\Tests\Unit\Worker;

use Axstrad\Component\Test\TestCase;
use Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent;


/**
 * @uses Axstrad\Symfony\EventDispatcher\EventDispatcherAwareTrait
 * @uses Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::__construct
 * @uses Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::setEventDispatcher
 * @uses Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::setEventType
 * @uses Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::setEventClass
 */
class DispatchStaticEventTest extends TestCase
{
    const EVENT_TYPE = 'type';
    const EVENT_CLASS = 'Symfony\Component\EventDispatcher\GenericEvent';


    protected $mockEventDispatcher;


    public function setUp()
    {
        $this->mockEventDispatcher = $this->getMockBuilder('Symfony\Component\EventDispatcher\EventDispatcher')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $this->fixture = new DispatchStaticEvent(
            $this->mockEventDispatcher,
            self::EVENT_TYPE,
            self::EVENT_CLASS
        );
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::__construct
     */
    public function testConstructorSetsEventDispatcher()
    {
        $this->assertAttributeSame(
            $this->mockEventDispatcher,
            'eventDispatcher',
            $this->fixture
        );
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::__construct
     */
    public function testConstructorSetsEventType()
    {
        $this->assertAttributeSame(
            self::EVENT_TYPE,
            'eventType',
            $this->fixture
        );
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::__construct
     */
    public function testConstructorSetsEventClass()
    {
        $this->assertAttributeSame(
            self::EVENT_CLASS,
            'eventClass',
            $this->fixture
        );
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::getEventType
     */
    public function testGetEventType()
    {
        $this->assertEquals(
            self::EVENT_TYPE,
            $this->fixture->getEventType()
        );
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::setEventType
     */
    public function testSetEventType()
    {
        $this->fixture->setEventType('foo');

        $this->assertAttributeEquals(
            'foo',
            'eventType',
            $this->fixture
        );
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::setEventType
     */
    public function testSetEventTypeReturnsSelf()
    {
        $this->assertSame(
            $this->fixture,
            $this->fixture->setEventType('foo')
        );
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::getEventClass
     */
    public function testGetEventClass()
    {
        $this->assertEquals(
            self::EVENT_CLASS,
            $this->fixture->getEventClass()
        );
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::setEventClass
     */
    public function testSetEventClass()
    {
        $this->fixture->setEventClass('foo');

        $this->assertAttributeEquals(
            'foo',
            'eventClass',
            $this->fixture
        );
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::setEventClass
     */
    public function testSetEventClassReturnsSelf()
    {
        $this->assertSame(
            $this->fixture,
            $this->fixture->setEventClass('foo')
        );
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::work
     * @uses Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::getEventClass
     * @uses Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::getEventType
     */
    public function testWorkDispatchesEvent()
    {
        $this->mockEventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->equalTo(self::EVENT_TYPE),
                $this->isInstanceOf(self::EVENT_CLASS)
            )
        ;

        $this->fixture->work(null);
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::work
     * @uses Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::getEventClass
     * @uses Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::getEventType
     */
    public function testEventObjectContainsTask()
    {
        $this->mockEventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->equalTo(self::EVENT_TYPE),
                $this->callback(function($subject) {
                    return $subject->getSubject() == 'some task';
                })
            )
        ;

        $this->fixture->work('some task');
    }

    /**
     * @covers Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::work
     * @uses Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::getEventClass
     * @uses Axstrad\SymfonyBridge\WorkForce\Worker\DispatchStaticEvent::getEventType
     */
    public function testWorkReturnsTrue()
    {
        $this->assertTrue($this->fixture->work(null));
    }
}
