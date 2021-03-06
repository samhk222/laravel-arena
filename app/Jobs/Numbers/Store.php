<?php

namespace App\Jobs\Numbers;

use App\Events\Number\Created;
use App\Models\Customer;
use App\Models\Number;
use App\Repositories\CustomerRepository;
use App\Repositories\NumberRepository;
use App\Repositories\StatusRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Store implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var array
     */
    private $data;

    /**
     * @var \App\Models\Number
     */
    private $number;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return \App\Models\Number
     * @throws \Exception
     */
    public function handle()
    {
        $this
            ->createNumber()
            ->dispatchEvent();

        return $this->number;
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function defineData()
    {
        return \array_merge($this->data, [
            'status_id' => (new StatusRepository())->getIdByDescription(Number::NEW_STATUS)
        ]);
    }

    /**
     * @return $this
     * @throws \Exception
     */
    private function createNumber()
    {
        $this->number = (new NumberRepository())->create($this->defineData());

        return $this;
    }

    private function dispatchEvent()
    {
        event(new Created($this->number->getKey()));

        return $this;
    }
}
