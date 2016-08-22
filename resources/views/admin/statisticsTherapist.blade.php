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
            <h4 style="color: #00a859">Khảo sát > Tiến triển bệnh > Thống kê chuyên viên</h4>
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
                        <label for="Name"  class="pull-right"><b name="ToTal">Tổng:</b></label>
                    </div>

                </div>
                <div class="table-responsive" style="height: 500px; overflow: scroll">
                    <table class="table table-bordered table-hover order-column" id="tablestatisticsTherapistViewList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Điều trị chuyên môn</th>
                            <th>Ngày</th>
                            <th>Mã bệnh nhân</th>
                            <th>Tình trạng</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyStatisticTherapistList">
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
                                    <label for="TherapistId"><b>Chuyên viên</b></label>
                                    <select class="form-control" id="TherapistId" name="TherapistId">
                                        @if($therapists)
                                            @foreach($therapists as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions noborder">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="statisticsTherapistView.search()">
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
        if (typeof (statisticsTherapistView) === 'undefined') {
            statisticsTherapistView = {
                StatisticsTherapistObject: {
                    FromDate: null,
                    ToDate: null,
                    TherapistId: null
                },
                resetStatisticsTherapistObject: function () {
                    for (var propertyName in statisticsTherapistView.StatisticsTherapistObject) {
                        if (statisticsTherapistView.StatisticsTherapistObject.hasOwnProperty(propertyName)) {
                            statisticsTherapistView.StatisticsTherapistObject.propertyName = null;
                        }
                    }
                },
                setValueObject: function () {
                    statisticsTherapistView.resetStatisticsTherapistObject();
                    for (var i = 0; i < Object.keys(statisticsTherapistView.StatisticsTherapistObject).length; i++) {
                        statisticsTherapistView.StatisticsTherapistObject[Object.keys(statisticsTherapistView.StatisticsTherapistObject)[i]] = $("#" + Object.keys(statisticsTherapistView.StatisticsTherapistObject)[i]).val();
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
                    statisticsTherapistView.setValueObject();
                    $.post(url+"admin/searchProfessionalTherapist",{
                        _token:_token,
                        data:statisticsTherapistView.StatisticsTherapistObject
                    },function (data) {
                        console.log(data);
                        statisticsTherapistView.fillTbody(data);
                    })
                },
                fillTbody: function (data) {
                    $("tbody#tbodyStatisticTherapistList").empty();
                    var row = "";
                    for (var i = 0; i < data.length; i++) {
                        var tr = "";
                        tr += "<tr id=" +data[i]["id"] + ">";
                        tr += "<td>"+ data[i]["name"] +"</td>";
                        tr += "<td>"+ data[i]["createdDate"] +"</td>";
                        tr += "<td>"+ data[i]["code"] +"</td>";
                        if(data[i]["ail"]==0){
                            tr += "<td>Không đau</td>";
                        }else if(data[i]["ail"]==1){
                            tr += "<td>Đau</td>";
                        }
                        row += tr;
                    }
                    $("b[name=ToTal]").text("Tổng: " + data.length + "");
                    $("tbody#tbodyStatisticTherapistList").append(row);
                },
            }
        }
    })
</script>