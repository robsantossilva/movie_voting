<?php

namespace Tests\Unit\Domain\SharedCore\Notification;

use Core\Domain\SharedCore\Notification\Notification;
use Core\Domain\SharedCore\Notification\NotificationErrorProps;
use PHPUnit\Framework\TestCase;

class NotificationUnitTest extends TestCase
{
    public function testCreateError()
    {
        $notification = new Notification();

        $error1 = new NotificationErrorProps(
            message: "error message 1",
            context: "video"
        );
        $notification->addError($error1);

        $error2 = new NotificationErrorProps(
            message: "error message 2",
            context: "assessment"
        );
        $notification->addError($error2);

        $this->assertEquals("video: error message 1", $notification->messages("video"));
        $this->assertEquals("assessment: error message 2", $notification->messages("assessment"));
        $this->assertEquals("video: error message 1, assessment: error message 2", $notification->messages());

        $this->assertTrue($notification->hasErrors());

        $this->assertEquals([$error1, $error2], $notification->getErrors());
    }
}
