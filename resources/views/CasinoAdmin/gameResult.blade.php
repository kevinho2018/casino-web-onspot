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
    @inject('gameResultPresenter', 'App\Presenters\GameResultPresenter')

    <div class="page-content container-fluid" id="gameResultModifyPage">
        <div class="row">
            <div class="col-md-12">
                @if (isset($errors) && count($errors) > 0)
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
                                        <option value="E">E 桌</option>
                                        <option value="F">F 桌</option>
                                        <option value="G">G 桌</option>
                                        <option value="H">H 桌</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="search-GameRound"><b>輪號</b> Round</label>
                                    <input id="search-GameRound" name="search-GameRound" type="text" class="form-control" placeholder="選填欄位">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="" for="search-ModifiedStatus"><b>牌局狀態</b></label>
                                    <select class="form-control" id="search-ModifiedStatus" name="search-ModifiedStatus">
                                        <option value="">不限 Unrestricted</option>
                                        <option value="normal">正常 Normal</option>
                                        <option value="modified">已修改 Modified</option>
                                        <option value="canceled">事後取消 Canceled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <input type="hidden" id="search-GameSelect" class="form-control" readonly name="search-GameSelect" value="Baccarat">
                                <div class="col-md-6 form-group">
                                    <label for="startAt"><b>查詢開始時間</b> Query Start Time</label>
                                    <input type="date" class="form-control" data-name="startAt" name="startAt" id="startAt">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="endAt"><b>查詢結束時間</b> Query End Time</label>
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
                                            <td>{!! $gameResultPresenter->showCard5Card6($listValue['Card5']) !!}</td>
                                            <td><span class="baccaratResultCard">{!! $gameResultPresenter->showCardImage($listValue['Card3']) !!}</span></td>
                                            <td><span class="baccaratResultCard">{!! $gameResultPresenter->showCardImage($listValue['Card1']) !!}</span></td>
                                            <td>{!! $gameResultPresenter->showCard5Card6($listValue['Card6']) !!}</td>
                                            <td><span class="baccaratResultCard">{!! $gameResultPresenter->showCardImage($listValue['Card4']) !!}</span></td>
                                            <td><span class="baccaratResultCard">{!! $gameResultPresenter->showCardImage($listValue['Card2']) !!}</span></td>
                                            <td>{{ $listValue['ModifiedStatus'] }}</td>
                                            <td><a target='_blank' href={!! $gameResultPresenter->showVideoDownloadLink($listValue) !!}>Video</a></td>
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
