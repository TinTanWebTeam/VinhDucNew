{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Chắt chắn xoá ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Đóng</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="regimensView.modalAgree()">Tiếp tục
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
            <h4 style="color: #00a859">Khảo sát > Ý kiến bệnh nhân > Tìm kiếm phác đồ</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-6">
            <div class="row" id="menuPackageTreatment">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div style="color: #00a859;font-size: 17px;">Danh sách phác đồ
                            <label for="Name"  class="pull-right"><b name="ToTal"></b></label>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-hover order-column"
                               id="tableregimensList"
                               style="margin-bottom: 0px;">
                            <thead>
                            <tr>
                                <th>Mã phác đồ</th>
                                <th>Tên BN</th>
                                <th>Tình trạng</th>
                                <th>Ghi chú</th>
                            </tr>
                            </thead>
                            <tbody id="TableRegimentList">
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="row" id="TablePackages" style="display:none">
                <div style="background-color: white;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div style="color: #00a859;font-size: 17px;">Điều trị chuyên môn</div>
                        </div>
                        <div class="form-group pull-bottom" style="margin-top: 10%; text-align: center; ">
                            <button type="button" name="cancelTreatment" onclick="regimensView.goBack(this)"
                                    class="btn default">Trở về
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6" id="seachPatient">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Tìm kiếm phác đồ
                        {{--<button type="button" class="btn btn-info btn-circle pull-right"--}}
                                {{--onclick="regimensView.addNewRegimens('')"><i--}}
                                    {{--class="fa fa-refresh"></i>--}}
                        {{--</button>--}}
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formregimens">
                            <div class="form-body">
                                <div>
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12"></div>
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="CodePatient"><b>Mã BN</b></label>
                                        <input type="text" class="form-control"
                                               id="CodePatient"
                                               name="CodePatient"
                                               placeholder="BN001">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="CodeRegimen"><b>Mã phác đồ</b></label>
                                        <input type="text" class="form-control"
                                               id="CodeRegimen"
                                               name="CodeRegimen"
                                               placeholder="PD001">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="FullName"><b>Họ và tên</b></label>
                                        <input type="text" class="form-control"
                                               id="FullName"
                                               name="FullName"
                                               placeholder="Nguyễn Văn A">
                                    </div>

                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="CreatedDate"><b>Ngày tạo phác đồ</b></label>
                                        <input type="date" class="form-control"
                                               id="CreatedDate"
                                               name="CreatedDate"
                                               value="{{DATE('Y-m-d')}}">
                                    </div>

                                </div>
                            </div>
                            <div class="form-actions noborder">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="regimensView.searchPatient()">
                                        Tìm kiếm
                                    </button>
                                    <button type="button" class="btn default" onclick="regimensView.Cancel(this)">Huỷ</button>
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
    if (typeof (regimensView) === 'undefined') {
        regimensView = {
            goBack: null,
            idRegimens:null,
            data: null,
            RegimensObject: {
                Id: null,
                CodePatient: null,
                CodeRegimen: null,
                FullName: null,
                CreatedDate: null,
                //Note:null,
            },
            resetRegimensObject: function () {
                for (var propertyName in regimensView.RegimensObject) {
                    if (regimensView.RegimensObject.hasOwnProperty(propertyName)) {
                        regimensView.RegimensObject.propertyName = null;
                    }
                }
            },

            Cancel: function () {
                regimensView.resetForm();
            },
//
            firstToUpperCase: function (str) {
                return str.substr(0, 1).toUpperCase() + str.substr(1);
            },
            resetForm: function () {
                if ($("input[name=Id]").val() === "") {
                    var allinput = $("input");
                    $("div[class=form-body]").find(allinput).val("");
                }
            },

            setValueObject: function () {
                regimensView.resetRegimensObject();
                for (var i = 0; i < Object.keys(regimensView.RegimensObject).length; i++) {
                    regimensView.RegimensObject[Object.keys(regimensView.RegimensObject)[i]] = $("#" + Object.keys(regimensView.RegimensObject)[i]).val();
                }
            },
            searchPatient: function () {
                regimensView.setValueObject();
                var dataArray = [];
                for (var i = 0; i < Object.keys(regimensView.RegimensObject).length; i++) {
                    if (regimensView.RegimensObject[Object.keys(regimensView.RegimensObject)[i]] != null) {
                        dataArray.push(regimensView.RegimensObject[Object.keys(regimensView.RegimensObject)[i]]);
                    }
                }
                $.post(url + "admin/searchPatientTest", {
                    _token: _token,
                    Regimens: regimensView.RegimensObject
                }, function (data)
                {
                    if (data.length == 0)
                         {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Dữ liệu không có.Vui lòng chọn lại");
                            $("button[name=modalAgree]").hide();
                            regimensView.fillTbody(data, '');
                        }
                        var row = "";
                        for (var i = 0; i < data.length; i++)
                        {
                            var tr = "";
                            tr += "<tr id=" + data[i]["id"] + ">";
                            tr += "<td>" + data[i]["maPD"] + "</td>";
                            tr += "<td>" + data[i]["fullName"] + "</td>";
                            if(data[i]["status"] === 0) {
                                tr += "<td>" + ["Không Đau"] + "</td>";
                            }else if(data[i]["status"] === 1) {
                            tr += "<td>" + ["Giảm"] + "</td>";
                            }else if(data[i]["status"] === 2) {
                                tr += "<td>" + ["Không Giảm"] + "</td>";
                            }else{
                                tr += "<td>" + ["Đau hơn"] + "</td>";
                            }
                            tr += "<td>" + data[i]["note"] + "</td>";
                            tr += "</tr>";
                            row += tr;
                        }
//                    $("tbody#TableRegimentList").empty().append(row);
//                    $("div#Table").show();
                    $("b[name=ToTal]").text("Tổng: " + data.length + "");
                    $("tbody#TableRegimentList").empty().append(row);
                });
            },
        }
    }
</script>