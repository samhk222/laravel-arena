<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    /**
     * @var string
     */
    public $msg3;
    /**
     * @var string
     */
    public $msg2;
    /**
     * @var string
     */
    public $type;
    /**
     * @var int
     */
    public $cols;

    public $search;
    /**
     * @var bool
     */
    public $minimize;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $type
     * @param string $msg2
     * @param string $msg3
     * @param int $cols
     * @param bool $search
     * @param bool $minimize
     */
    public function __construct(
        string $title = "",
        string $type = "",
        string $msg2 = "",
        string $msg3 = "",
        int $cols = 12,
        bool $search = false,
        bool $minimize = false
    ) {
        $this->title    = $title;
        $this->msg3     = $msg3;
        $this->msg2     = $msg2;
        $this->type     = $type;
        $this->cols     = $cols;
        $this->search   = $search;
        $this->minimize = $minimize;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.card');
    }
}
