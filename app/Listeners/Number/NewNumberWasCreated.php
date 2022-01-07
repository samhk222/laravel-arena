<?php

namespace App\Listeners\Number;

use App\Events\Number\Created;
use App\Jobs\NumberPreferences\Store;
use App\Repositories\NumberRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;

class NewNumberWasCreated implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var Created|App\Events\Number\Created
     */
    private $event;

    /**
     * @var \App\Models\Number
     */
    private $number;

    /**
     * @var Collection
     */
    private $preferences;

    public function __construct()
    {
        $this->preferences = \collect();
    }

    /**
     * Handle the event.
     *
     * @param App\Events\Number\Created $event
     * @return void
     */
    public function handle(Created $event)
    {
        $this->event = $event;

        $this
            ->defineNumber()
            ->defineDefaultsNumberPreferences();

        $this->preferences->each(function ($preference) {
            Store::dispatchNow($this->number->id, $preference);
        });
    }

    /**
     * @return $this
     */
    private function defineNumber()
    {
        $this->number = (new NumberRepository())->find($this->event->number_id);

        return $this;
    }

    /**
     * @return $this
     */
    private function defineDefaultsNumberPreferences()
    {
        $this->preferences->push(['name' => 'auto_attendant', 'value' => 1]);
        $this->preferences->push(['name' => 'voicemail_enabled', 'value' => 1]);

        return $this;
    }


}
