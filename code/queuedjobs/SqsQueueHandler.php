<?php

/**
 *
 * @author marcus
 */
class SqsQueueHandler {
    const RUNNER_DELAY = 29;
	/**
	 * @var SqsService
	 */
	public $sqsService;

	public function startJobOnQueue(QueuedJobDescriptor $job) {
        // we explicitly delay the schedule runner job for 5 minutes
		$this->sqsService->runJob($job->ID);
	}

	public function scheduleJob(QueuedJobDescriptor $job, $date) {
        // null op; we rely on a regularly run job (each 5 minutes) to trigger the scheduled jobs
        // however we _do_ mark it as scheduled for picking it up later on
        $job->JobType = 'Scheduled';
        $job->write();
	}
}
