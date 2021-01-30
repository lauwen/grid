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
                    @if (isset($subGridColumns) && isset($subGridFields) && isset($subGridUrl))
                    data-fields={!! $subGridFields !!}
                    data-urls={!! $subGridUrl !!}
                    onclick="lauwenGridGetSubformData(this)"
                    style="cursor: pointer"
                    @endif
                >
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
    @if (isset($subGridColumns) && isset($subGridFields) && isset($subGridUrl))
        <div class="row">
            @if (count($subGridColumns) == 1)
                <div class="col-sm-12">
                    @else
                        <div class="col-sm-6">
                            @endif
                            <div class="box-body table-responsive no-padding">
                                @if (isset($subGridTitle) || isset($actionUrl))
                                    <div class="lauwen-grid-data-subtable-head">
                                        @if (isset($subGridTitle[0]))
                                            <div class="lauwen-grid-subtable-title">{{ $subGridTitle[0] }}</div>
                                        @endif
                                        @if (isset($actionUrl[0]))
                                            <div class="lauwen-grid-subtable-save-btn">
                                                <button type="button" class="btn btn-sm btn-success" onclick="lauwenGridSaveSubformData('lauwen-grid-data-subtable-left', '{{ $actionUrl[0] }}', '{{ csrf_token() }}')">保存</button>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <table class="table table-hover table-striped" id="lauwen-grid-data-subtable-left">
                                    <thead>
                                    <tr>
                                        @foreach ($subGridColumns[0] as $subColumn)
                                            <th style="text-align: center">{{ $subColumn }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="{{ count($subGridColumns[0]) }}" align="center" data-name="none">还没有数据哦！</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if (count($subGridColumns) == 2)
                            <div class="col-sm-6">
                                <div class="box-body table-responsive no-padding">
                                    @if (isset($subGridTitle) || isset($actionUrl))
                                        <div class="lauwen-grid-data-subtable-head">
                                            @if (isset($subGridTitle[1]))
                                                <div class="lauwen-grid-subtable-title">{{ $subGridTitle[1] }}</div>
                                            @endif
                                            @if (isset($actionUrl[1]))
                                                <div class="lauwen-grid-subtable-save-btn">
                                                    <button type="button" class="btn btn-sm btn-success" onclick="lauwenGridSaveSubformData('lauwen-grid-data-subtable-right', '{{ $actionUrl[1] }}', '{{ csrf_token() }}')">保存</button>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    <table class="table table-hover table-striped" id="lauwen-grid-data-subtable-right">
                                        <thead>
                                        <tr>
                                            @foreach ($subGridColumns[1] as $subColumn)
                                                <th style="text-align: center">{{ $subColumn }}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan="{{ count($subGridColumns[1]) }}" align="center" data-name="none">还没有数据哦！</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                </div>


        @endif
        <!-- /.box-body -->
        </div>
