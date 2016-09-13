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
        <div class="form-group form-md-line-input col-md-2">
            <label for="FromDate"><b>Từ ngày</b></label>
            <input type="date" class="form-control"
                   id="FromDate"
                   name="FromDate"
                   onchange="statisticsPatientView.search()"
                   value="{{date('Y-m-d')}}">
        </div>
        <div class="form-group form-md-line-input col-md-2">
            <label for="ToDate"><b>Đến ngày</b></label>
            <input type="date" class="form-control"
                   id="ToDate"
                   name="ToDate"
                   onchange="statisticsPatientView.search()"
                   value="{{date('Y-m-d')}}">
        </div>
        <div class="form-group form-md-line-input col-md-2">
            <label for="SourceCustomerId"><b>Nguồn khách hàng</b></label>
            <select class="form-control" name="SourceCustomerId" id="SourceCustomerId" onchange="statisticsPatientView.search()">
                @if($sourceCustomers)
                    @foreach($sourceCustomers as $item)
                        <option value="{{$item->id}}">{{$item->sourceCustomer}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group form-md-line-input col-md-2">
            <label for="Umpteenth"><b>Khám mới / Tái khám</b></label>
            <select class="form-control" name="Umpteenth" id="Umpteenth" onchange="statisticsPatientView.search()">
                <option value="0">Khám mới</option>
                <option value="1">Tái khám</option>
            </select>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Danh sách điều trị
                        <label for="Name" class="pull-right"><b name="ToTal">Tổng: {{count($patients)}}</b></label>
                    </div>

                </div>
                <div class="table-responsive" style="height: 500px; overflow: scroll">
                    <table class="table table-bordered table-hover order-column" id="tablestatisticsPatientViewList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Mã bệnh nhân</th>
                            <th>Tên bệnh nhân</th>
                            <th>Năm sinh</th>
                            <th>Tỉnh</th>
                            <th>Gói</th>
                            <th>Bác sĩ</th>
                            <th>Lượt tái khám</th>
                            <th>Ra/vào</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyStatisticPatientList">
                        @if($patients)
                            @foreach($patients as $item)
                                <tr id="{{$item->id}}" style="cursor: pointer">
                                    <td>{{$item->MaBN}}</td>
                                    <td>{{$item->TEN}}</td>
                                    <td>{{$item->NAMSINH}}</td>
                                    <td>{{$item->TINH}}</td>
                                    <td>{{$item->GOI}}</td>
                                    <td>{{$item->BS}}</td>
                                    <td>{{$item->SOLANTAIKHAM}}</td>
                                    <td>{{$item->RAVAO}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

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
                    SourceCustomerId:null,
                    Umpteenth:null
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
                search: function () {
                    statisticsPatientView.setValueObject();
                    $.post(url + "admin/searchStatusPatient", {
                        _token: _token,
                        data: statisticsPatientView.StatisticsPatientViewObject
                    }, function (data) {
                        console.log(data);
                        statisticsPatientView.fillTbody(data);
                    })
                },
                fillTbody: function (data) {
                    $("tbody#tbodyStatisticPatientList").empty();
                    var row = "";
                    for (var i = 0; i < data.length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data[i]["id"] + ">";
                        tr += "<td>" + data[i]["MaBN"] + "</td>";
                        tr += "<td>" + data[i]["TEN"] + "</td>";
                        tr += "<td>" + data[i]["NAMSINH"] + "</td>";
                        tr += "<td>" + data[i]["TINH"] + "</td>";
                        tr += "<td>" + data[i]["GOI"] + "</td>";
                        tr += "<td>" + data[i]["BS"] + "</td>";
                        tr += "<td>" + data[i]["SOLANTAIKHAM"] + "</td>";
                        tr += "<td>" + data[i]["RAVAO"] + "</td>";
                        row += tr;
                    }
                    $("b[name=ToTal]").text("Tổng: " + data.length + "");
                    table.destroy();
                    $("tbody#tbodyStatisticPatientList").empty();
                    $("tbody#tbodyStatisticPatientList").append(row);
                    table = $("#tablestatisticsPatientViewList").DataTable({language : languageOptions});
                    $("input[aria-controls=tablestatisticsPatientViewList]").on('keyup', function () {
                        $("b[name=ToTal]").empty().html("Tổng: " + $("#tbodyStatisticPatientList").find("tr").length);
                    });
                },
            }
        }
    });
    var table = $("#tablestatisticsPatientViewList").DataTable({language: languageOptions});
    $("input[aria-controls=tablestatisticsPatientViewList]").on('keyup', function () {
        $("b[name=ToTal]").empty().html("Tổng: " + $("#tbodyStatisticPatientList").find("tr").length);
    });
</script>