@extends('voyager::master')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-list"></i> 遊戲牌局改單取消
        </h1>
    </div>
@stop

@section('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page-js-files')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

@stop

@section('content')
    <div class="page-content container-fluid" id="gameResultModifyPage">
        <div class="row">
            <div class="col-md-12">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item active">
                        <a class="nav-link active" href="#cancel-game" aria-controls="cancel-game" role="tab" data-toggle="tab"><b>取消牌局</b></a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a class="nav-link" href="#modify-game" aria-controls="modify-game" role="tab" data-toggle="tab"><b>修改牌局</b></a>
                    </li>
                </ul>

                <br>

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
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="cancel-game">
                        <form method="POST" action="{{ route('cancel-game-result') }}" onsubmit="return confirm('＃提示：確定要取消牌局？(牌局取消後不可復原)')">
                            <!-- Method Field -->
                            {{ method_field("PUT") }}
                            <!-- CSRF TOKEN -->
                            {{ csrf_field() }}
                            <div class="panel panel-primary panel-bordered">

                                <div class="panel-heading">
                                    <h3 class="panel-title panel-icon"><i class="voyager-hammer"></i>取消遊戲牌局 <small><font color="black">Game Result Cancel</font></small></h3>
                                </div>

                                <div class="panel-body">
                                    <div class="row clearfix">
                                        <div class="col-md-4 form-group">
                                            <label for="cancel-TableId"><b>桌號</b> Table</label>
                                            <select class="form-control" id="cancel-TableId" name="cancel-TableId" value="">
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
                                            <input id="cancel-GameRound" name="cancel-GameRound" type="text" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="cancel-GameRun"><b>局號</b> Run</label>
                                            <input id="cancel-GameRun" name="cancel-GameRun" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-12 form-group">
                                            <label class="" for="cancel-ModifiedStatus">牌局狀態</label>
                                            <input id="cancel-ModifiedStatus" type="text" class="form-control" readonly name="cancel-ModifiedStatus" value="Canceled">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="" for="cancel-GameSelect">遊戲選擇</label>
                                            <input id="cancel-GameSelect" type="text" class="form-control" readonly name="cancel-GameSelect" value="Baccarat">
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-12 form-group">
                                            <label for="cancel-Announcement"><b>公告訊息</b></label>
                                            <input class="form-control" readonly id="cancel-Announcement" name="cancel-Announcement" value="[取消公告] 百家樂 -輪-局，因結果錯誤已取消，請會員至歷史帳務查看，謝謝。">
                                        </div>
                                    </div>

                                </div><!-- .panel-body -->

                            </div><!-- .panel -->

                            <button type="submit" class="btn pull-right btn-warning btn-block"> 取消牌局 </button>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="modify-game">
                        <form method="POST" action="{{ route('modify-game-result') }}" onsubmit="return confirm('＃提示：確定要修改牌局？(請確認牌型正確)')">
                            <!-- Method Field -->
                            {{ method_field("PUT") }}
                            <!-- CSRF TOKEN -->
                            {{ csrf_field() }}
                            <div class="panel panel-primary panel-bordered">

                                <div class="panel-heading">
                                    <h3 class="panel-title panel-icon"><i class="voyager-hammer"></i>修改遊戲牌局 <small><font color="black">Game Result Modify</font></small></h3>
                                    <div class="panel-actions">
                                        <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="row clearfix">
                                        <div class="col-md-4 form-group">
                                            <label for="modify-TableId"><b>桌號</b> Table</label>
                                            <select class="form-control" id="modify-TableId" name="modify-TableId">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="F">F</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="modify-GameRound"><b>輪號</b> Round</label>
                                            <input id="modify-GameRound" type="text" class="form-control" name="modify-GameRound" value="">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="modify-GameRun"><b>局號</b> Run</label>
                                            <input id="modify-GameRun" type="text" class="form-control" name="modify-GameRun" value="">
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-12 form-group">
                                            <label class="" for="modify-ModifiedStatus"><b>牌局狀態</b></label>
                                            <input id="modify-ModifiedStatus" type="text" class="form-control" readonly name="modify-ModifiedStatus" value="Modified">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="" for="modify-GameSelect">遊戲選擇</label>
                                            <input id="modify-GameSelect" type="text" class="form-control" readonly name="modify-GameSelect" value="Baccarat">
                                        </div>
                                    </div>


                                    <div class="row clearfix" id="PostModify">
                                        <div class="col-md-2 form-group">
                                            <label for="player-card-3"><b>閒家3</b> </label>
                                            <select class="js-card-Select2  form-control" id="player-card-3" name="player-card-3">
                                                <option value="">無</option>
                                                <optgroup label="紅心">
                                                    <option value="H1">紅心1</option>
                                                    <option value="H2">紅心2</option>
                                                    <option value="H3">紅心3</option>
                                                    <option value="H4">紅心4</option>
                                                    <option value="H5">紅心5</option>
                                                    <option value="H6">紅心6</option>
                                                    <option value="H7">紅心7</option>
                                                    <option value="H8">紅心8</option>
                                                    <option value="H9">紅心9</option>
                                                    <option value="H0">紅心10</option>
                                                    <option value="HJ">紅心J</option>
                                                    <option value="HQ">紅心Q</option>
                                                    <option value="HK">紅心K</option>
                                                </optgroup>
                                                <optgroup label="黑桃">
                                                    <option value="S1">黑桃1</option>
                                                    <option value="S2">黑桃2</option>
                                                    <option value="S3">黑桃3</option>
                                                    <option value="S4">黑桃4</option>
                                                    <option value="S5">黑桃5</option>
                                                    <option value="S6">黑桃6</option>
                                                    <option value="S7">黑桃7</option>
                                                    <option value="S8">黑桃8</option>
                                                    <option value="S9">黑桃9</option>
                                                    <option value="S0">黑桃10</option>
                                                    <option value="SJ">黑桃J</option>
                                                    <option value="SQ">黑桃Q</option>
                                                    <option value="SK">黑桃K</option>
                                                </optgroup>
                                                <optgroup label="梅花">
                                                    <option value="C1">梅花1</option>
                                                    <option value="C2">梅花2</option>
                                                    <option value="C3">梅花3</option>
                                                    <option value="C4">梅花4</option>
                                                    <option value="C5">梅花5</option>
                                                    <option value="C6">梅花6</option>
                                                    <option value="C7">梅花7</option>
                                                    <option value="C8">梅花8</option>
                                                    <option value="C9">梅花9</option>
                                                    <option value="C0">梅花10</option>
                                                    <option value="CJ">梅花J</option>
                                                    <option value="CQ">梅花Q</option>
                                                    <option value="CK">梅花K</option>
                                                </optgroup>
                                                <optgroup label="方塊">
                                                    <option value="D1">方塊1</option>
                                                    <option value="D2">方塊2</option>
                                                    <option value="D3">方塊3</option>
                                                    <option value="D4">方塊4</option>
                                                    <option value="D5">方塊5</option>
                                                    <option value="D6">方塊6</option>
                                                    <option value="D7">方塊7</option>
                                                    <option value="D8">方塊8</option>
                                                    <option value="D9">方塊9</option>
                                                    <option value="D0">方塊10</option>
                                                    <option value="DJ">方塊J</option>
                                                    <option value="DQ">方塊Q</option>
                                                    <option value="DK">方塊K</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="player-card-2"><b>閒家2</b></label>
                                            <select class="js-card-Select2  form-control" id="player-card-2" name="player-card-2" value="H1">
                                                <optgroup label="紅心">
                                                    <option value="H1">紅心1</option>
                                                    <option value="H2">紅心2</option>
                                                    <option value="H3">紅心3</option>
                                                    <option value="H4">紅心4</option>
                                                    <option value="H5">紅心5</option>
                                                    <option value="H6">紅心6</option>
                                                    <option value="H7">紅心7</option>
                                                    <option value="H8">紅心8</option>
                                                    <option value="H9">紅心9</option>
                                                    <option value="H0">紅心10</option>
                                                    <option value="HJ">紅心J</option>
                                                    <option value="HQ">紅心Q</option>
                                                    <option value="HK">紅心K</option>
                                                </optgroup>
                                                <optgroup label="黑桃">
                                                    <option value="S1">黑桃1</option>
                                                    <option value="S2">黑桃2</option>
                                                    <option value="S3">黑桃3</option>
                                                    <option value="S4">黑桃4</option>
                                                    <option value="S5">黑桃5</option>
                                                    <option value="S6">黑桃6</option>
                                                    <option value="S7">黑桃7</option>
                                                    <option value="S8">黑桃8</option>
                                                    <option value="S9">黑桃9</option>
                                                    <option value="S0">黑桃10</option>
                                                    <option value="SJ">黑桃J</option>
                                                    <option value="SQ">黑桃Q</option>
                                                    <option value="SK">黑桃K</option>
                                                </optgroup>
                                                <optgroup label="梅花">
                                                    <option value="C1">梅花1</option>
                                                    <option value="C2">梅花2</option>
                                                    <option value="C3">梅花3</option>
                                                    <option value="C4">梅花4</option>
                                                    <option value="C5">梅花5</option>
                                                    <option value="C6">梅花6</option>
                                                    <option value="C7">梅花7</option>
                                                    <option value="C8">梅花8</option>
                                                    <option value="C9">梅花9</option>
                                                    <option value="C0">梅花10</option>
                                                    <option value="CJ">梅花J</option>
                                                    <option value="CQ">梅花Q</option>
                                                    <option value="CK">梅花K</option>
                                                </optgroup>
                                                <optgroup label="方塊">
                                                    <option value="D1">方塊1</option>
                                                    <option value="D2">方塊2</option>
                                                    <option value="D3">方塊3</option>
                                                    <option value="D4">方塊4</option>
                                                    <option value="D5">方塊5</option>
                                                    <option value="D6">方塊6</option>
                                                    <option value="D7">方塊7</option>
                                                    <option value="D8">方塊8</option>
                                                    <option value="D9">方塊9</option>
                                                    <option value="D0">方塊10</option>
                                                    <option value="DJ">方塊J</option>
                                                    <option value="DQ">方塊Q</option>
                                                    <option value="DK">方塊K</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="player-card-1"><b>閒家1</b></label>
                                            <select class="js-card-Select2  form-control" id="player-card-1" name="player-card-1" value="H1">
                                                <optgroup label="紅心">
                                                    <option value="H1">紅心1</option>
                                                    <option value="H2">紅心2</option>
                                                    <option value="H3">紅心3</option>
                                                    <option value="H4">紅心4</option>
                                                    <option value="H5">紅心5</option>
                                                    <option value="H6">紅心6</option>
                                                    <option value="H7">紅心7</option>
                                                    <option value="H8">紅心8</option>
                                                    <option value="H9">紅心9</option>
                                                    <option value="H0">紅心10</option>
                                                    <option value="HJ">紅心J</option>
                                                    <option value="HQ">紅心Q</option>
                                                    <option value="HK">紅心K</option>
                                                </optgroup>
                                                <optgroup label="黑桃">
                                                    <option value="S1">黑桃1</option>
                                                    <option value="S2">黑桃2</option>
                                                    <option value="S3">黑桃3</option>
                                                    <option value="S4">黑桃4</option>
                                                    <option value="S5">黑桃5</option>
                                                    <option value="S6">黑桃6</option>
                                                    <option value="S7">黑桃7</option>
                                                    <option value="S8">黑桃8</option>
                                                    <option value="S9">黑桃9</option>
                                                    <option value="S0">黑桃10</option>
                                                    <option value="SJ">黑桃J</option>
                                                    <option value="SQ">黑桃Q</option>
                                                    <option value="SK">黑桃K</option>
                                                </optgroup>
                                                <optgroup label="梅花">
                                                    <option value="C1">梅花1</option>
                                                    <option value="C2">梅花2</option>
                                                    <option value="C3">梅花3</option>
                                                    <option value="C4">梅花4</option>
                                                    <option value="C5">梅花5</option>
                                                    <option value="C6">梅花6</option>
                                                    <option value="C7">梅花7</option>
                                                    <option value="C8">梅花8</option>
                                                    <option value="C9">梅花9</option>
                                                    <option value="C0">梅花10</option>
                                                    <option value="CJ">梅花J</option>
                                                    <option value="CQ">梅花Q</option>
                                                    <option value="CK">梅花K</option>
                                                </optgroup>
                                                <optgroup label="方塊">
                                                    <option value="D1">方塊1</option>
                                                    <option value="D2">方塊2</option>
                                                    <option value="D3">方塊3</option>
                                                    <option value="D4">方塊4</option>
                                                    <option value="D5">方塊5</option>
                                                    <option value="D6">方塊6</option>
                                                    <option value="D7">方塊7</option>
                                                    <option value="D8">方塊8</option>
                                                    <option value="D9">方塊9</option>
                                                    <option value="D0">方塊10</option>
                                                    <option value="DJ">方塊J</option>
                                                    <option value="DQ">方塊Q</option>
                                                    <option value="DK">方塊K</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="banker-card-3"><b>莊家3</b></label>
                                            <select class="js-card-Select2  form-control" id="banker-card-3" name="banker-card-3"  value="">
                                                <option value="">無</option>
                                                <optgroup label="紅心">
                                                    <option value="H1">紅心1</option>
                                                    <option value="H2">紅心2</option>
                                                    <option value="H3">紅心3</option>
                                                    <option value="H4">紅心4</option>
                                                    <option value="H5">紅心5</option>
                                                    <option value="H6">紅心6</option>
                                                    <option value="H7">紅心7</option>
                                                    <option value="H8">紅心8</option>
                                                    <option value="H9">紅心9</option>
                                                    <option value="H0">紅心10</option>
                                                    <option value="HJ">紅心J</option>
                                                    <option value="HQ">紅心Q</option>
                                                    <option value="HK">紅心K</option>
                                                </optgroup>
                                                <optgroup label="黑桃">
                                                    <option value="S1">黑桃1</option>
                                                    <option value="S2">黑桃2</option>
                                                    <option value="S3">黑桃3</option>
                                                    <option value="S4">黑桃4</option>
                                                    <option value="S5">黑桃5</option>
                                                    <option value="S6">黑桃6</option>
                                                    <option value="S7">黑桃7</option>
                                                    <option value="S8">黑桃8</option>
                                                    <option value="S9">黑桃9</option>
                                                    <option value="S0">黑桃10</option>
                                                    <option value="SJ">黑桃J</option>
                                                    <option value="SQ">黑桃Q</option>
                                                    <option value="SK">黑桃K</option>
                                                </optgroup>
                                                <optgroup label="梅花">
                                                    <option value="C1">梅花1</option>
                                                    <option value="C2">梅花2</option>
                                                    <option value="C3">梅花3</option>
                                                    <option value="C4">梅花4</option>
                                                    <option value="C5">梅花5</option>
                                                    <option value="C6">梅花6</option>
                                                    <option value="C7">梅花7</option>
                                                    <option value="C8">梅花8</option>
                                                    <option value="C9">梅花9</option>
                                                    <option value="C0">梅花10</option>
                                                    <option value="CJ">梅花J</option>
                                                    <option value="CQ">梅花Q</option>
                                                    <option value="CK">梅花K</option>
                                                </optgroup>
                                                <optgroup label="方塊">
                                                    <option value="D1">方塊1</option>
                                                    <option value="D2">方塊2</option>
                                                    <option value="D3">方塊3</option>
                                                    <option value="D4">方塊4</option>
                                                    <option value="D5">方塊5</option>
                                                    <option value="D6">方塊6</option>
                                                    <option value="D7">方塊7</option>
                                                    <option value="D8">方塊8</option>
                                                    <option value="D9">方塊9</option>
                                                    <option value="D0">方塊10</option>
                                                    <option value="DJ">方塊J</option>
                                                    <option value="DQ">方塊Q</option>
                                                    <option value="DK">方塊K</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="banker-card-2"><b>莊家2</b></label>
                                            <select class="js-card-Select2  form-control" id="banker-card-2" name="banker-card-2" value="H1">
                                                <optgroup label="紅心">
                                                    <option value="H1">紅心1</option>
                                                    <option value="H2">紅心2</option>
                                                    <option value="H3">紅心3</option>
                                                    <option value="H4">紅心4</option>
                                                    <option value="H5">紅心5</option>
                                                    <option value="H6">紅心6</option>
                                                    <option value="H7">紅心7</option>
                                                    <option value="H8">紅心8</option>
                                                    <option value="H9">紅心9</option>
                                                    <option value="H0">紅心10</option>
                                                    <option value="HJ">紅心J</option>
                                                    <option value="HQ">紅心Q</option>
                                                    <option value="HK">紅心K</option>
                                                </optgroup>
                                                <optgroup label="黑桃">
                                                    <option value="S1">黑桃1</option>
                                                    <option value="S2">黑桃2</option>
                                                    <option value="S3">黑桃3</option>
                                                    <option value="S4">黑桃4</option>
                                                    <option value="S5">黑桃5</option>
                                                    <option value="S6">黑桃6</option>
                                                    <option value="S7">黑桃7</option>
                                                    <option value="S8">黑桃8</option>
                                                    <option value="S9">黑桃9</option>
                                                    <option value="S0">黑桃10</option>
                                                    <option value="SJ">黑桃J</option>
                                                    <option value="SQ">黑桃Q</option>
                                                    <option value="SK">黑桃K</option>
                                                </optgroup>
                                                <optgroup label="梅花">
                                                    <option value="C1">梅花1</option>
                                                    <option value="C2">梅花2</option>
                                                    <option value="C3">梅花3</option>
                                                    <option value="C4">梅花4</option>
                                                    <option value="C5">梅花5</option>
                                                    <option value="C6">梅花6</option>
                                                    <option value="C7">梅花7</option>
                                                    <option value="C8">梅花8</option>
                                                    <option value="C9">梅花9</option>
                                                    <option value="C0">梅花10</option>
                                                    <option value="CJ">梅花J</option>
                                                    <option value="CQ">梅花Q</option>
                                                    <option value="CK">梅花K</option>
                                                </optgroup>
                                                <optgroup label="方塊">
                                                    <option value="D1">方塊1</option>
                                                    <option value="D2">方塊2</option>
                                                    <option value="D3">方塊3</option>
                                                    <option value="D4">方塊4</option>
                                                    <option value="D5">方塊5</option>
                                                    <option value="D6">方塊6</option>
                                                    <option value="D7">方塊7</option>
                                                    <option value="D8">方塊8</option>
                                                    <option value="D9">方塊9</option>
                                                    <option value="D0">方塊10</option>
                                                    <option value="DJ">方塊J</option>
                                                    <option value="DQ">方塊Q</option>
                                                    <option value="DK">方塊K</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="banker-card-1"><b>莊家1</b></label>
                                            <select class="js-card-Select2  form-control" id="banker-card-1" name="banker-card-1" value="H1">
                                                <optgroup label="紅心">
                                                    <option value="H1">紅心1</option>
                                                    <option value="H2">紅心2</option>
                                                    <option value="H3">紅心3</option>
                                                    <option value="H4">紅心4</option>
                                                    <option value="H5">紅心5</option>
                                                    <option value="H6">紅心6</option>
                                                    <option value="H7">紅心7</option>
                                                    <option value="H8">紅心8</option>
                                                    <option value="H9">紅心9</option>
                                                    <option value="H0">紅心10</option>
                                                    <option value="HJ">紅心J</option>
                                                    <option value="HQ">紅心Q</option>
                                                    <option value="HK">紅心K</option>
                                                </optgroup>
                                                <optgroup label="黑桃">
                                                    <option value="S1">黑桃1</option>
                                                    <option value="S2">黑桃2</option>
                                                    <option value="S3">黑桃3</option>
                                                    <option value="S4">黑桃4</option>
                                                    <option value="S5">黑桃5</option>
                                                    <option value="S6">黑桃6</option>
                                                    <option value="S7">黑桃7</option>
                                                    <option value="S8">黑桃8</option>
                                                    <option value="S9">黑桃9</option>
                                                    <option value="S0">黑桃10</option>
                                                    <option value="SJ">黑桃J</option>
                                                    <option value="SQ">黑桃Q</option>
                                                    <option value="SK">黑桃K</option>
                                                </optgroup>
                                                <optgroup label="梅花">
                                                    <option value="C1">梅花1</option>
                                                    <option value="C2">梅花2</option>
                                                    <option value="C3">梅花3</option>
                                                    <option value="C4">梅花4</option>
                                                    <option value="C5">梅花5</option>
                                                    <option value="C6">梅花6</option>
                                                    <option value="C7">梅花7</option>
                                                    <option value="C8">梅花8</option>
                                                    <option value="C9">梅花9</option>
                                                    <option value="C0">梅花10</option>
                                                    <option value="CJ">梅花J</option>
                                                    <option value="CQ">梅花Q</option>
                                                    <option value="CK">梅花K</option>
                                                </optgroup>
                                                <optgroup label="方塊">
                                                    <option value="D1">方塊1</option>
                                                    <option value="D2">方塊2</option>
                                                    <option value="D3">方塊3</option>
                                                    <option value="D4">方塊4</option>
                                                    <option value="D5">方塊5</option>
                                                    <option value="D6">方塊6</option>
                                                    <option value="D7">方塊7</option>
                                                    <option value="D8">方塊8</option>
                                                    <option value="D9">方塊9</option>
                                                    <option value="D0">方塊10</option>
                                                    <option value="DJ">方塊J</option>
                                                    <option value="DQ">方塊Q</option>
                                                    <option value="DK">方塊K</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-12 form-group">
                                            <label for="modify-Announcement"><b>公告訊息</b></label>
                                            <span class="form-control" readonly id="modify-Announcement">
                                                [改單公告] 百家樂 -輪-局結果錯誤已重新修正，請會員至歷史帳務查看，謝謝。
                                            </span>
                                        </div>
                                    </div>

                                </div><!-- .panel-body -->

                            </div><!-- .panel -->

                            <button type="submit" class="btn pull-right btn-warning btn-block"> 改單牌局 </button>

                        </form>
                    </div>
                </div>
            </div><!-- .col-md-12 -->
        </div><!-- .row -->
    </div><!-- .page-content -->
@stop


@section('page-js-script')
    <!-- 公告訊息修改  -->


    <!-- 下拉式選單 -->
    <script>
        $(document).ready(function() {
            $('.js-card-Select2 ').select2();
        });
    </script>
@stop