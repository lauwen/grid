<div class="box grid-box">
    @if(isset($title))
    <div class="box-header with-border">
        <h3 class="box-title"> {{ $title }}</h3>
    </div>
    @endif
    @if ( $grid->showTools() || $grid->showExportBtn() || $grid->showCreateBtn() )
    <div class="box-header with-border">
        <div class="pull-right">
            {!! $grid->renderColumnSelector() !!}
            {!! $grid->renderExportButton() !!}
            {!! $grid->renderCreateButton() !!}
        </div>
        @if ( $grid->showTools() )
        <div class="pull-left">
            {!! $grid->renderHeaderTools() !!}
        </div>
        @endif
    </div>
    @endif

    {!! $grid->renderFilter() !!}

    {{--    页头--}}
    {!! $grid->renderHeader() !!}

    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover grid-table" id="{{ $grid->tableID }}">
            <thead>
                <tr>
                    @foreach($grid->visibleColumns() as $column)
                    <th {!! $column->formatHtmlAttributes() !!}>{!! $column->getLabel() !!}{!! $column->renderHeader() !!}</th>
                    @endforeach
                </tr>
            </thead>

            @if ($grid->hasQuickCreate())
                {!! $grid->renderQuickCreate() !!}
            @endif

            <tbody>

                @if($grid->rows()->isEmpty() && $grid->showDefineEmptyPage())
                    @include('admin::grid.empty-grid')
                @endif
                @foreach($grid->rows() as $row)
                <tr {!! $row->getRowAttributes() !!}
                    data-fields={!! $subGridFields !!}
                    onclick="lauwenGridGetSubformData(this,'{!! $subGridUrl !!}')">
                    @foreach($grid->visibleColumnNames() as $name)
                    <td {!! $row->getColumnAttributes($name) !!}>
                        {!! $row->column($name) !!}
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>

            {!! $grid->renderTotalRow() !!}

        </table>

    </div>
    {{--    页脚--}}
    {!! $grid->renderFooter() !!}

    <div class="box-footer clearfix">
        {!! $grid->paginator() !!}
    </div>
    @if (isset($subGridColumns))
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-striped" id="lauwen-grid-data-subtable">
            @if (isset($subGridTitle))
            <caption class="lauwen-grid-data-subtable-title">{{ $subGridTitle }}</caption>
            @endif
            <thead>
            <tr>
                @foreach ($subGridColumns as $subColumn)
                <th>{{ $subColumn }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="5" align="center">还没有数据哦！</td>
            </tr>
            </tbody>
        </table>
    </div>
    @endif
    <!-- /.box-body -->
</div>
