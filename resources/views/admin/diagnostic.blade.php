{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Chắt chắn xoá ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Đóng</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="DiagnosticView.modalAgree()">Tiếp tục
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
            <h4 style="color: #00a859">Chẩn đoán</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Danh sách gói điều trị</div>
                </div>
                <div>
                    <table class="table table-bordered table-hover order-column" id="tableDiagnosticList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Gói</th>
                            <th>Diễn giải</th>
                            <th>Ngày tạo</th>
                            <th>Chi tiết</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyDiagnosticList">
                        {{--@if($patients)--}}
                        {{--@foreach($patients as $item)--}}
                        {{--<tr id="{{$item->id}}" onclick="patientView.viewListPatient(this)"--}}
                        {{--style="cursor: pointer">--}}
                        {{--<td>{{$item->code}}</td>--}}
                        {{--<td>{{$item->fullName}}</td>--}}
                        {{--<td>{{$item->sex}}</td>--}}
                        {{--<td>{{$item->phone}}</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--@endif--}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6" id="seachPatient">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Tìm kiếm bệnh nhân</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">
                        <button type="button" class="btn btn-info btn-circle"
                                onclick="DiagnosticView.addNewDiagnostic('')"><i
                                    class="fa fa-refresh"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formDiagnostic">
                            <div class="form-body">
                                <div>
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="Code"><b>Mã</b></label>
                                        <input type="text" class="form-control"
                                               id="Code"
                                               name="Code"
                                               placeholder="BN001">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="FullName"><b>Họ và tên</b></label>
                                        <input type="text" class="form-control"
                                               id="FullName"
                                               name="FullName"
                                               placeholder="Nguyễn Văn A">
                                    </div>
                                    <div class="">
                                        <div class="form-group form-md-line-input col-md-6">
                                            <label for="Sex"><b>Giới tính</b></label>
                                            <input type="text" class="form-control"
                                                   id="Sex"
                                                   name="Sex"
                                                   placeholder="nam">
                                        </div>
                                        <div class="form-group form-md-line-input col-md-6">
                                            <label for="Birthday"><b>Năm sinh</b></label>
                                            <input type="text" class="form-control"
                                                   id="Birthday"
                                                   name="Birthday">

                                        </div>
                                    </div>
                                </div>


                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue"
                                            onclick="diagnosticView.searchPatient(this)">
                                        Tìm kiếm
                                    </button>
                                    <button type="button" class="btn default">Huỷ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6"
             style="position: absolute;background-color: white; z-index: 50 ;width: 495px; display:none"
             id="Table">
            <table class="table table-hover table-light" id="AutoCompleteTable">
                <thead>
                <tr class="AutoCompleteTableHeader">
                    <th >Mã</th>
                    <th >Họ và tên</th>
                    <th >Giới tính</th>
                    <th >Số điện thoại</th>
                    <th >Choose</th>
                </tr>
                </thead>
                <tbody id="AutoCompleteTableBody">

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    if (typeof (diagnosticView) === 'undefined') {
        diagnosticView = {
            goBack: null,
            idDiagnostic: null,
            DiagnosticObject: {
                Id: null,
                Code: null,
                FullName: null,
                Birthday: null,
                Sex: null
            },
            resetDiagnosticObject: function () {
                for (var propertyName in diagnosticView.DiagnosticObject) {
                    if (diagnosticView.DiagnosticObject.hasOwnProperty(propertyName)) {
                        diagnosticView.DiagnosticObject.propertyName = null;
                    }
                }
            },
            addNewDiagnostic: function (result) {
                if (result === "") {
                    $("input[name=Id]").val("");
                    DiagnosticView.resetForm();
                } else if (result === "delete") {
                    $("div#modalContent").empty().append("Xoá thành công");
                    $("button[name=modalAgree]").hide();
                    $("input[name=Id]").val("");
                    DiagnosticView.resetForm();
                }
            },
            Cancel: function () {
                diagnosticView.resetForm();
            },
            firstToUpperCase: function (str) {
                return str.substr(0, 1).toUpperCase() + str.substr(1);
            },
            resetForm: function () {
                if ($("input[name=Id]").val() === "") {
                    var allinput = $("input");
                    $("div[class=form-body]").find(allinput).val("");
                    $("div[class=form-body]").find("select").val(1);

                } else {
                    //diagnosticView.viewListPatient(patientView.goBack);
                }
            },
            fillTbody: function (data, result) {
                $("tbody#tbodyDiagnosticList").empty();
                var row = "";
                for (var i = 0; i < data["listDiagnostic"].length; i++) {
                    var tr = "";
                    tr += "<tr id=" + data["listDiagnostic"][i]["id"] + " onclick='DiagnosticView.viewListDiagnostic(this)' style='cursor: pointer'>";
                    tr += "<td>" + data["listDiagnostic"][i]["code"] + "</td>";
                    tr += "<td>" + data["listDiagnostic"][i]["fullName"] + "</td>";
                    tr += "<td>" + data["listDiagnostic"][i]["sex"] + "</td>";
                    tr += "<td>" + data["listDiagnostic"][i]["phone"] + "</td>";
                    row += tr;
                }
                $("tbody#tbodyDiagnosticList").append(row);
                DiagnosticView.idDiagnostic = null;
                DiagnosticView.addNewDiagnostic(result);
            },
            searchPatient: function (element) {
                var position = $(element).offset();
                $.post(url + "admin/searchPatient", {
                    _token: _token,
                    Patient: diagnosticView.idDiagnostic
                }, function (data) {
                    $("div#Table").show();
                    $("div#Table").css("left", position.left).css("top", (position.top - 235));
                });
            }
        }
    }
</script>