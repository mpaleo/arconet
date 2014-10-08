<?php

class TestQueueTwo
{

    public function fire($job, $data)
    {
        Log::info('Queue 2 :)');
        $job->delete();
    }

}
