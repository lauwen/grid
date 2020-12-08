<?php

namespace Lauwen\Grid;

use Encore\Admin\Extension;

class GridExtension extends Extension
{
    public $name = 'grid';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';
}
