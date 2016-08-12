{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Chắt chắn xoá ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Đóng</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="">Tiếp tục
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--End Modal--}}
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4 style="color: #00a859">Khảo sát > Tiến triển bệnh > Thống kê bệnh nhân</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Danh sách điều trị
                        <label for="Name" class="pull-right"><b name="ToTal">Tổng:</b></label>
                    </div>

                </div>
                <div class="table-responsive" style="height: 500px; overflow: scroll">
                    <table class="table table-bordered table-hover order-column" id="tablestatisticsPatientViewList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Tên bệnh nhân</th>
                            <th>Tình trạng</th>
                            <th>Thông tin tiến triển</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyStatisticPatientList">
                        {{--@if($Positions)--}}
                        {{--@foreach($Positions as $item)--}}
                        {{--<tr id="{{$item->id}}" onclick="statisticsPatientView.viewListPosition(this)"--}}
                        {{--style="cursor: pointer">--}}
                        {{--<td>{{$item->name}}</td>--}}
                        {{--<td>{{$item->description}}</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--@endif--}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Tìm kiếm
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formPosition">
                            <div class="form-body">
                                <div class="form-group form-md-line-input" style="display:none">
                                    <input type="text" class="form-control" name="Id" id="Id">
                                </div>
                                <div class="form-group form-md-line-input col-md-6">
                                    <label for="FromDate"><b>Từ ngày</b></label>
                                    <input type="date" class="form-control"
                                           id="FromDate"
                                           name="FromDate"
                                           value="{{date('Y-m-d')}}">
                                </div>
                                <div class="form-group form-md-line-input col-md-6">
                                    <label for="ToDate"><b>Đến ngày</b></label>
                                    <input type="date" class="form-control"
                                           id="ToDate"
                                           name="ToDate"
                                           value="{{date('Y-m-d')}}">
                                </div>
                                <div class="form-group form-md-line-input col-md-12">
                                    <label for="Status"><b>Tình trạng</b></label>
                                    <select class="form-control" name="Status" id="Status">
                                        <option value="0">Tình trạng</option>
                                        <option value="1">Giảm</option>
                                        <option value="2">Không giảm</option>
                                        <option value="3">Đau hơn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions noborder">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="statisticsPatientView.search()">
                                        Tìm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        if (typeof (statisticsPatientView) === 'undefined') {
            statisticsPatientView = {
                StatisticsPatientViewObject: {
                    FromDate: null,
                    ToDate: null,
                    Status: null
                },
                resetStatisticsPatientObject: function () {
                    for (var propertyName in statisticsPatientView.StatisticsPatientViewObject) {
                        if (statisticsPatientView.StatisticsPatientViewObject.hasOwnProperty(propertyName)) {
                            statisticsPatientView.StatisticsPatientViewObject.propertyName = null;
                        }
                    }
                },
                setValueObject: function () {
                    statisticsPatientView.resetStatisticsPatientObject();
                    for (var i = 0; i < Object.keys(statisticsPatientView.StatisticsPatientViewObject).length; i++) {
                        statisticsPatientView.StatisticsPatientViewObject[Object.keys(statisticsPatientView.StatisticsPatientViewObject)[i]] = $("#" + Object.keys(statisticsPatientView.StatisticsPatientViewObject)[i]).val();
                    }
                },
                firstToUpperCase: function (str) {
                    return str.substr(0, 1).toUpperCase() + str.substr(1);
                },
                resetForm: function () {
                    if ($("input[name=Id]").val() === "") {
                        var allinput = $("input");
                        $("div[class=form-body]").find(allinput).val("");
                        $("div[class=form-body]").find("select").val(1);
                        $("div[class=form-body]").find("textarea").val("");

                    } else {
                        //regimensView.viewListPatient(patientView.goBack);
                    }
                },
                search:function () {
                    statisticsPatientView.setValueObject();
                    $.post(url+"admin/searchStatusPatient",{
                        _token:_token,
                        data:statisticsPatientView.StatisticsPatientViewObject
                    },function (data) {
                        statisticsPatientView.fillTbody(data);
                    })
                },
                fillTbody: function (data) {
                    $("tbody#tbodyStatisticPatientList").empty();
                    var row = "";
                    for (var i = 0; i < data.length; i++) {
                        var tr = "";
                        tr += "<tr id=" +data[i]["id"] + ">";
                        tr += "<td>"+ data[i]["fullName"] +"</td>";
                        if(data[i]["status"]===0){
                            tr += "<td></td>";
                        }else if(data[i]["status"]===1){
                            tr += "<td>Giảm</td>";
                        }else if(data[i]["status"]===2){
                            tr += "<td>Không giảm</td>";
                        }else if(data[i]["status"]===3){
                            tr += "<td>Đau hơn</td>";
                        }
                        tr += "<td>" + data[i]["note"] + "</td>";
                        row += tr;
                    }
                    $("b[name=ToTal]").text("Tổng: " + data.length + "");
                    $("tbody#tbodyStatisticPatientList").append(row);
                },
            }
        }
    })
</script>