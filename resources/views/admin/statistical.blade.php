{{--Model--}}

<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Bạn có chắc xóa ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Hủy</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="packageView.modalAgree()">Đồng ý
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
            <h4 style="color: #00a859">Khảo sát > Ý kiến bệnh nhân > Khảo sát bệnh nhân</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Danh sách khảo sát bệnh nhân
                        <label for="Name"  class="pull-right"><b name="ToTal"></b></label>

                    </div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">

                        {{--<button type="button" class="btn btn-danger btn-circle" onclick="packageView.deletePackage()"><i--}}
                        {{--class="fa fa-times"></i>--}}
                        {{--</button>--}}
                    </div>
                </div>
                <div style="height: 380px;overflow: scroll;">
                    <table class="table table-bordered table-hover order-column" id="tablePackageList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Ngày khảo sát</th>
                            <th>Tên bệnh nhân</th>
                            <th>Ý kiến bệnh nhân</th>
                            <th>Tình trạng</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyStatisticsList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Thêm mới | Chỉnh sửa</div>

                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formPackage">
                            <div class="form-body">
                                <div>
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="ToDate"><b>Từ ngày</b></label>
                                        <input type="date" class="form-control"
                                               id="ToDate"
                                               name="ToDate"
                                               value="{{date('Y-m-d')}}">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="FromDate"><b>Đến ngày</b></label>
                                        <input type="date" class="form-control"
                                               id="FromDate"
                                               name="FromDate"
                                               value="{{Date('Y-m-d')}}">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12 ">
                                        <label for="handling">Tình trạng</label>
                                        <select class="form-control" id="Handling">
                                            <option value="0"> -- Chọn tình trạng --</option>
                                            <option value="1">Đã xử lý</option>
                                            <option value="2">Chưa xử lý</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <button type="button" class="btn blue"
                                                onclick="statisticalView.searchStatistical()">
                                            Tìm kiếm
                                        </button>
                                        {{--<button type="button" class="btn default" onclick="packageView.Cancel()">Hủy--}}
                                        {{--</button>--}}

                                    </div>
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
        if (typeof (statisticalView) === 'undefined') {
            statisticalView = {
                idStatistical: null,
                StatisticalObject: {
                    Id: null,
                    ToDate: null,
                    FromDate: null,
                    Handling: null,
                },
                resetStatisticsObject: function () {
                    for (var propertyName in statisticalView.StatisticalObject) {
                        if (statisticalView.StatisticalObject.hasOwnProperty(propertyName)) {
                            statisticalView.StatisticalObject.propertyName = null;
                        }
                    }
                },
                setValueObject: function () {
                    statisticalView.resetStatisticsObject();
                    for (var i = 0; i < Object.keys(statisticalView.StatisticalObject).length; i++) {
                        statisticalView.StatisticalObject[Object.keys(statisticalView.StatisticalObject)[i]] = $("#" + Object.keys(statisticalView.StatisticalObject)[i]).val();
                    }
                },
                firstToUpperCase: function (str) {
                    return str.substr(0, 1).toUpperCase() + str.substr(1);
                },
                searchStatistical:function () {
                    statisticalView.setValueObject();
                    $.post(url+"admin/searchStatistical",{
                        _token:_token,
                        data:statisticalView.StatisticalObject
                    },function (data) {
                        if (data == "") {
                            statisticalView.fillTbody(data);
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Dữ liệu không có.Vui lòng chọn lại");
                            $("button[name=modalAgree]").hide();
                        } else {
                        statisticalView.fillTbody(data);
                    }
                    })
                },
                fillTbody: function (data) {
                    $("tbody#tbodyStatisticsList").empty();
                    var row = "";
                    for (var i = 0; i < data.length; i++) {
                        var tr = "";
                        tr += "<tr id=" +data[i]["Id"] + ">";
                        tr += "<td>"+ data[i]["createdDate"] +"</td>";
                        tr += "<td>"+ data[i]["fullName"] +"</td>";
                        tr += "<td>"+ data[i]["question"] +"</td>";
                        if(data[i]["handling"] === 2 || data[i]["handling"]=== 0){
                            tr += "<td>" + "Chưa xử lý" +"</td>";
                        }else {
                            tr += "<td>" + "Đã xử lý" + "</td>";
                        }
                        row += tr;
                    }
                    $("b[name=ToTal]").text("Tổng: " + data.length + "");
                    $("tbody#tbodyStatisticsList").append(row);
                },


            }
        }
    });


</script>