@extends('voyager::master')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-list"></i> 歷史牌局查詢
        </h1>
    </div>
@stop

@section('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop


@section('content')
    <div class="page-content container-fluid" id="gameResultModifyPage">
        <div class="row">
            <div class="col-md-12">
                @if (isset($responseString))
                    <div class="alert alert-warning">
                        <strong>Info!</strong> {{ $responseString }}.
                    </div>
                @endif

                @if (count($errors))
                    <div class="alert alert-danger fade in">
                        <strong>訊息</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Tab panes -->
                <form method="POST" action="{{ route('cancel-game-result') }}" onsubmit="return confirm('＃提示：確定要查詢牌局？')">
                <!-- Method Field -->
                {{ method_field("PUT") }}
                <!-- CSRF TOKEN -->
                    {{ csrf_field() }}
                    <div class="panel panel-primary panel-bordered">

                        <div class="panel-heading">
                            <h3 class="panel-title panel-icon"><i class="voyager-hammer"></i>歷史牌局 <small><font color="black">Game Result Search</font></small></h3>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class="col-md-4 form-group">
                                    <label for="cancel-TableId"><b>桌號</b> Table</label>
                                    <select class="form-control" id="cancel-TableId" name="cancel-TableId">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="cancel-GameRound"><b>輪號</b> Round</label>
                                    <input id="cancel-GameRound" name="cancel-GameRound" type="text" class="form-control" placeholder="必填欄位">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="cancel-GameRun"><b>局號</b> Run</label>
                                    <input id="cancel-GameRun" name="cancel-GameRun" type="text" class="form-control" placeholder="必填欄位">
                                </div>
                            </div>

                            <div class="row clearfix">

                                <div class="col-md-3 form-group">
                                    <label class="" for="cancel-ModifiedStatus"><b>牌局狀態</b></label>
                                    <select class="form-control" id="cancel-ModifiedStatus" name="cancel-ModifiedStatus">
                                        <option value="Normal">正常 Normal</option>
                                        <option value="Modified">已修改 Modified</option>
                                        <option value="Canceled">事後取消 Canceled</option>
                                    </select>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label class="" for="cancel-GameSelect"><b>遊戲選擇</b></label>
                                    <input id="cancel-GameSelect" type="text" class="form-control" readonly name="cancel-GameSelect" value="Baccarat">
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="startAt"><b>查詢開始時間</b></label>
                                    <input type="date" class="form-control" data-name="startAt" name="startAt" value="2018/08/08" id="startAt">
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="endAt"><b>查詢結束時間</b></label>
                                    <input type="date" class="form-control" data-name="endAt"  name="endAt" value="2018/08/08" id="endAt">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn pull-right btn-warning btn-block"> 查詢牌局 </button>
                </form>
            </div><!-- .col-md-12 -->
        </div><!-- .row -->
    </div><!-- .page-content -->
@stop


@section('page-js-script')
    <!-- Data picker -->

    <!-- 日期選單
    <script>
        $( function() {
            $('#search-start-time').datepicker();
        });

        $('#endAt').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });

    </script>-->

@stop