<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Book;

class LastBooks extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
	$this->config=['books'=>
Book::where('id','>','0')->orderby('created_at','desc')->limit(10)->get()];
        return view('widgets.last_books', [
            'config' => $this->config,
        ]);
    }
}
