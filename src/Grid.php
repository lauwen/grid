<?php


namespace Lauwen\Grid;

use Closure;
use \Encore\Admin\Grid as AdminGrid;
use Illuminate\Database\Eloquent\Model as Eloquent;


class Grid extends AdminGrid
{
    /**
     * View for grid to render.
     *
     * @var string
     */
    protected $view = "grid::table";

    public function __construct(Eloquent $model, Closure $builder = null)
    {
        parent::__construct($model, $builder);
    }

    /**
     * Set sub grid title
     *
     * @param $subGridTitle
     * @return $this
     */
    public function setSubGridTitle ($subGridTitle) {
        $this->variables['subGridTitle'] = $subGridTitle;
        return $this;
    }

    /**
     * Set sub grid url
     *
     * @param $subGridUrl
     * @return $this
     */
    public function setSubGridUrl ($subGridUrl) {
        $this->variables['subGridUrl'] = json_encode($subGridUrl);
        return $this;
    }

    /**
     * Set sub grid header
     *
     * @param $subGridColumns
     * @return $this
     */
    public function setSubGridColumns ($subGridColumns) {
        $this->variables['subGridColumns'] = $subGridColumns;
        return $this;
    }

    /**
     * Set sub grid fields
     *
     * @param $subGridFields
     * @return $this
     */
    public function setSubGridFields ($subGridFields) {
        $this->variables['subGridFields'] = json_encode($subGridFields);
        return $this;
    }

    /**
     * Set sub grid
     *
     * @param Closure $callback
     */
    public function setSubGrid (Closure $callback) {
        call_user_func($callback, $this);
    }

}
