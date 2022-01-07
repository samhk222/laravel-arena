<?php

namespace App\Jobs\NumberPreferences;

use App\Events\Number\Created;
use App\Models\Customer;
use App\Models\Number;
use App\Repositories\CustomerRepository;
use App\Repositories\NumberPreferenceRepository;
use App\Repositories\NumberRepository;
use App\Repositories\StatusRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class Store implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var Collection
     */
    private $data;

    /**
     * @var \App\Models\Number
     */
    private $number;
    /**
     * @var int
     */
    private $number_id;

    /**
     * @var \App\Models\NumberPreference
     */
    private $number_preferences;

    /**
     * Create a new job instance.
     *
     * @param int $number_id
     * @param array $data
     */
    public function __construct(int $number_id, array $data)
    {
        $this->data      = \collect($data);
        $this->number_id = $number_id;
    }

    /**
     * Execute the job.
     *
     * @return \App\Models\NumberPreference
     * @throws \Exception
     */
    public function handle()
    {
        $this
            ->mergeData()
            ->createNumberPreference();

        return $this->number_preferences;
    }

    /**
     * @return $this
     */
    private function mergeData()
    {
        $this->data = $this->data->merge(['number_id' => $this->number_id]);

        return $this;
    }

    private function createNumberPreference()
    {
        $this->number_preferences = (new NumberPreferenceRepository())->create($this->data->toArray());

        return $this;
    }
}
