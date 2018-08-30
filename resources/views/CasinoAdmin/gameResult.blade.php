@extends('voyager::master')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-list"></i> 歷史牌局查詢
        </h1>
    </div>

    <link href="{{ asset('css/baccaratCard.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="page-content container-fluid" id="gameResultModifyPage">
        <div class="row">
            <div class="col-md-12">
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
                <form method="GET" action="{{ route('search-game-result') }}" onsubmit="return confirm('＃提示：確定要查詢牌局？')">
                    <div class="panel panel-primary panel-bordered">

                        <div class="panel-heading">
                            <h3 class="panel-title panel-icon"><i class="voyager-hammer"></i>歷史牌局 <small><font color="black">Game Result Search</font></small></h3>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class="col-md-4 form-group">
                                    <label for="search-TableId"><b>桌號</b> Table</label>
                                    <select class="form-control" id="search-TableId" name="search-TableId">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="search-GameRound"><b>輪號</b> Round</label>
                                    <input id="search-GameRound" name="search-GameRound" type="text" class="form-control" placeholder="必填欄位">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="search-GameRun"><b>局號</b> Run</label>
                                    <input id="search-GameRun" name="search-GameRun" type="text" class="form-control" placeholder="必填欄位">
                                </div>
                            </div>

                            <div class="row clearfix">

                                <div class="col-md-3 form-group">
                                    <label class="" for="search-ModifiedStatus"><b>牌局狀態</b></label>
                                    <select class="form-control" id="search-ModifiedStatus" name="search-ModifiedStatus">
                                        <option value="normal">正常 Normal</option>
                                        <option value="modified">已修改 Modified</option>
                                        <option value="canceled">事後取消 Canceled</option>
                                    </select>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label class="" for="search-GameSelect"><b>遊戲選擇</b></label>
                                    <input id="search-GameSelect" type="text" class="form-control" readonly name="search-GameSelect" value="Baccarat">
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="startAt"><b>查詢開始時間</b></label>
                                    <input type="date" class="form-control" data-name="startAt"name="startAt" id="startAt">
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="endAt"><b>查詢結束時間</b></label>
                                    <input type="date" class="form-control" data-name="endAt" name="endAt" id="endAt">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn pull-right btn-warning btn-block"> 查詢牌局 </button>
                </form>
            </div><!-- .col-md-12 -->
        </div><!-- .row -->

        <div class="row"> <!-- 查詢結果顯示row -->
            <div class="col-md-12"><!-- col-md-12 -->
                @if (isset($gameReport))
                    @if (count($gameReport) > 0)
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <table class="table table-hover dataTable no-footer">
                                    <thead>
                                    <tr role="row">
                                        <th>ID</th>
                                        <th>桌號</th>
                                        <th>輪號</th>
                                        <th>局號</th>
                                        <th>輸贏結果</th>
                                        <th>閒補3</th>
                                        <th>閒2</th>
                                        <th>閒1</th>
                                        <th>莊補3</th>
                                        <th>莊2</th>
                                        <th>莊1</th>
                                        <th>牌局狀態</th>
                                        <th>影片</th>
                                        <th>修改時間</th>
                                        <th>建立時間</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($gameReport as $listKey => $listValue)
                                        <tr class="p-md">
                                            <td>{{ $listValue['HistoryId'] }}</td>
                                            <td>{{ $listValue['TableId'] }}</td>
                                            <td>{{ $listValue['Round'] }}</td>
                                            <td>{{ $listValue['Run'] }}</td>
                                            <td>{{ $listValue['WinSpot'] }}</td>
                                            <div>
                                                @php
                                                    $card1 = strtolower($listValue['Card1']);
                                                    $card2 = strtolower($listValue['Card2']);
                                                    $card3 = strtolower($listValue['Card3']);
                                                    $card4 = strtolower($listValue['Card4']);
                                                    $card5 = strtolower($listValue['Card5']);
                                                    $card6 = strtolower($listValue['Card6']);
                                                @endphp
                                                <div>
                                                    <td>
                                                        @if (! is_null($card5) && ($card5 != ''))
                                                            <span class="baccaratResultCard thirdCard"><img src='{{ asset("images/pokercard/$card5.png") }}'></span>
                                                        @else
                                                            {{ $listValue['Card5'] }}
                                                        @endif
                                                    </td>
                                                    <td><span class="baccaratResultCard"><img src='{{ asset("images/pokercard/$card3.png") }}'></span></td>
                                                    <td><span class="baccaratResultCard"><img src='{{ asset("images/pokercard/$card1.png") }}'></span></td>
                                                    <td>
                                                        @if (! is_null($card6) && ($card6 != ''))
                                                            <span class="baccaratResultCard thirdCard"><img src='{{ asset("images/pokercard/$card6.png") }}'></span>
                                                        @else
                                                            {{ $listValue['Card6'] }}
                                                        @endif
                                                    </td>
                                                    <td><span class="baccaratResultCard"><img src='{{ asset("images/pokercard/$card4.png") }}'></span></td>
                                                    <td><span class="baccaratResultCard"><img src='{{ asset("images/pokercard/$card2.png") }}'></span></td>
                                                </div>
                                            </div>
                                            <td>{{ $listValue['ModifiedStatus'] }}</td>
                                            <td>
                                                <a target="_blank" href="http://video.livecasino168.com/<?= ucwords($listValue['TableId']) ?>/<?= $listValue['Round'] ?>/<?= $listValue['Round'] ?>-<?= $listValue['Run'] ?>.mp4 ">Video</a>
                                            </td>
                                            <td>{{ $listValue['ModifiedTime'] }}</td>
                                            <td>{{ $listValue['CreateTime'] }}</td>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    @endif
                @else
                    <div class="ibox float-e-margins">
                        <div class="alert alert-danger">
                            查無資料。
                        </div>
                    </div>
                @endif
                        </div>
            </div><!-- .col-md-12 -->
        </div> <!-- .查詢結果顯示row -->
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