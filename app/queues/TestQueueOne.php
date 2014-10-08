<?php

class TestQueueOne
{

    public function fire($job, $data)
    {
        Log::info('Queue 1 :)');
        $job->delete();
    }

}
