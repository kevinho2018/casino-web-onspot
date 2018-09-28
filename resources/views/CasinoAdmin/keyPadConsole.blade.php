@extends('voyager::master')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-list"></i> KeyPad伺服器
        </h1>
    </div>

    <link href="{{ asset('css/keypad.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
@stop


@section('content')
    <div class="page-content container-fluid" id="gameResultModifyPage"><!-- page-content -->
        <div class="row"><!-- row -->
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>E桌維護</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <a id="StartTable_E" class="btn btn-app">
                            <i class="fa fa-play"></i> Start
                        </a>
                        <a id="StopTable_E" class="btn btn-app" style="display: none;">
                            <i class="fa fa-pause"></i> Stop
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>F桌維護</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <a id="StartTable_F" class="btn btn-app">
                            <i class="fa fa-play"></i> Start
                        </a>
                        <a id="StopTable_F" class="btn btn-app" style="display: none;">
                            <i class="fa fa-pause"></i> Stop
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>G桌維護</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <a id="StartTable_G" class="btn btn-app">
                            <i class="fa fa-play"></i> Start
                        </a>
                        <a id="StopTable_G" class="btn btn-app" style="display: none;">
                            <i class="fa fa-pause"></i> Stop
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- .page-content -->
@stop

@section('page-js-script')
<script type="text/javascript">

    // TODO 確定之後怎麼跟keypad那邊即時溝通, 或是直接同步game server那邊？
    // TODO https://github.com/alexwight/php-signalr-client/blob/master/src/Hammershark/SignalR/Client.php

    // 百家桌關閉維護動態觸發
    $("a[id^='StopTable_']").on('click', function (x) {
        var callerId = this.id.substring(10, 11);
        if (confirm('是否確定暫停' + callerId + '桌?')) {
            $('#StopTable_' + callerId).hide();
            $('#StartTable_' + callerId).show();
            casinoProxy.server.setTableInMaintance("Baccarat", callerId, true).done(function (res) {
                if (res === 0) {
                    alert("執行成功");
                } else {
                    $('#StartTable_' + callerId).hide();
                    $('#StopTable_' + callerId).show();
                    alert("執行失敗, 錯誤碼:" + res);
                }
            });
        }
    });

    function InitialBaccaratTableStatus(proxy) {
        var tid = setInterval(BaccaratTableStatus, 3000);
        function BaccaratTableStatus() {
            proxy.server.getBaccaratTableInMaintance().done(function (res) {
                $.each(res, function (key, value) {
                    if (value == true) {
                        $('#StartTable_' + key).show();
                        $('#StopTable_' + key).hide();
                    }
                    else {
                        $('#StopTable_' + key).show();
                        $('#StartTable_' + key).hide();
                    }
                });
                console.log(res);
            });
        }
        function abortTimer() { // to be called when you want to stop the timer
            clearInterval(tid);
        }
    }

</script>
@stop