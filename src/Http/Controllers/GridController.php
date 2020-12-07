<?php

namespace Lauwen\Grid\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class GridController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(view('grid::index'));
    }
}