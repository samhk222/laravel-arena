<?php

namespace App\Jobs\Customers;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Repositories\StatusRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Store implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    private $data;

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
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\App\Models\Agenda
     * @throws \Exception
     */
    public function handle()
    {
        return (new CustomerRepository())->create($this->defineData());
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function defineData()
    {
        return \array_merge($this->data, [
            'status_id' => (new StatusRepository())->getIdByDescription(Customer::NEW_STATUS)
        ]);
    }
}
