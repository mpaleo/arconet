<?php

class QueueController extends BaseController
{

    public function testQueueOne()
    {
        Queue::push('TestQueueOne', array());
    }

    public function testQueueTwo($delay)
    {
        $date = Carbon::now()->addMinutes($delay);
        Queue::later($date, 'TestQueueTwo', array());
    }

}
