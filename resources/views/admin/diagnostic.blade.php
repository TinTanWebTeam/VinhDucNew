{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Chắt chắn xoá ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Đóng</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="diagnosticView.modalAgree()">Tiếp tục
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
        <div class="col-sm-6">
            <div class="row" id="menuPackageTreatment">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div style="color: #00a859;font-size: 17px;">Danh sách gói điều trị</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover order-column" id="tableDiagnosticList"
                               style="margin-bottom: 0px;">
                            <thead>
                            <tr>

                                <th>Mã phiếu</th>
                                <th>Ghi chú</th>
                                <th>Ngày tạo</th>
                                <th>Gói</th>
                                <th>Chi tiết</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyDiagnosticList">
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover order-column" id="PackagesTable"
                                   style="overflow: scroll;">
                                <tbody id="PackagesTable">
                                @if($professionals)
                                    @foreach($professionals as $professional)
                                        <tr>
                                            <td colspan="1">{{ \App\locationTreatment::where('id',$professional->first()->locationTreatmentId)->first()->name }}</td>
                                        </tr>
                                        @foreach(array_chunk($professional->all(),3)as $rows)
                                            <tr>
                                                <td style="width: 3%;"></td>
                                                @foreach($rows as $item)
                                                    <td id="check" name="{{$item->id}}"><input type="checkbox"
                                                                                               onclick="diagnosticView.checked(this)"
                                                                                               id="{{$item->id}}">{{$item->name}}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                        </div>
                        <div class="form-group pull-bottom" style="margin-top: 10%; text-align: center; ">
                            <button type="button" name="CompleteTreatmentPackage" class="btn blue"
                                    onclick="diagnosticView.CompleteTreatmentPackage(this)">
                                Hoàn tất
                            </button>
                            <button type="button" name="cancelTreatment" onclick="diagnosticView.cancelTreatment(this)"
                                    class="btn default">Huỷ
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-sm-6" id="seachPatient">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;" name="searchPatient">Tìm kiếm bệnh nhân
                        <button type="button" class="btn btn-info btn-circle pull-right"
                                onclick="diagnosticView.addNewDiagnostic('')"><i
                                    class="fa fa-refresh"></i>
                        </button>
                        <button type="button" class="btn btn-info btn-circle pull-right"
                                onclick="diagnosticView.addNewTreatmentPackages()"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div style="color: #00a859;font-size: 17px; display: none" name="addNewTreatment">Thêm mới phiếu
                        điều trị
                        <button type="button" class="btn btn-info btn-circle pull-right"
                                onclick="diagnosticView.addNewDiagnostic('')"><i
                                    class="fa fa-refresh"></i>
                        </button>
                        <button type="button" class="btn btn-info btn-circle pull-right"
                                onclick="diagnosticView.addNewTreatmentPackages()"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formDiagnostic">
                            <div class="form-body">
                                <div name="tableSearchPatient">
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id">
                                    </div>
                                    <div class="table-responsive  row col-md-12" style="display:none" id="Table">
                                        <table class="table table-hover table-light" id="AutoCompleteTable">
                                            <thead>
                                            <tr class="AutoCompleteTableHeader">
                                                <th>Mã</th>
                                                <th>Họ và tên</th>
                                                <th>Giới tính</th>
                                                <th>Số điện thoại</th>
                                                <th>Choose</th>
                                            </tr>
                                            </thead>
                                            <tbody id="AutoCompleteTableBody">

                                            </tbody>
                                        </table>
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
                                <div name="tableAddNewTreatmentPackages" style="display: none">
                                    <div class="form-group form-md-line-input" style="display()none">
                                        <input type="text" class="form-control" name="AddNewId" id="AddNewId">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="PackagesId"><b>Gói</b></label>
                                        <select class="form-control" id="PackagesId" name="PackagesId">
                                            @if($packages)
                                                @foreach($packages as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="PatientId"><b>Bệnh nhân</b></label>
                                        <select class="form-control" id="PatientId" name="PatientId">
                                            @if($patients)
                                                @foreach($patients as $item)
                                                    <option value="{{$item->id}}">{{$item->fullName}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="TreatmentPackageCode"><b>Mã Phiếu</b></label>
                                        <input type="text" class="form-control"
                                               id="TreatmentPackageCode"
                                               name="TreatmentPackageCode"
                                               placeholder="BN001">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="Note"><b>Ghi chú</b></label>
                                        <textarea class="form-control"
                                                  id="Note"
                                                  style="resize: none;"
                                                  rows="5"
                                                  name="Note">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions noborder" name="buttonSearchPatient">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="diagnosticView.searchPatient(this)">
                                        Tìm kiếm
                                    </button>
                                    <button type="button" class="btn default">Huỷ</button>
                                </div>
                            </div>
                            <div class="form-actions noborder" name="buttonAddNewTreatmentPackages"
                                 style="display: none">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="diagnosticView.addNew(this)">
                                        Thêm mới
                                    </button>
                                    <button type="button" class="btn default" onclick="diagnosticView.Cancel(this)">
                                        Huỷ
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
    if (typeof (diagnosticView) === 'undefined') {
        diagnosticView = {
            goBack: null,
            idTreatmentPackage: null,
            idDiagnostic: null,
            data: null,
            deleteTreatmentPackage: null,
            DiagnosticObject: {
                Id: null,
                Code: null,
                FullName: null,
                Birthday: null,
                Sex: null,
                AddNewId: null,
                PackagesId: null,
                PatientId: null,
                TreatmentPackageCode: null,
                Note: null
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
                    diagnosticView.resetForm();
                } else if (result === "delete") {
                    $("div#modalContent").empty().append("Xoá thành công");
                    $("button[name=modalAgree]").hide();
                    $("input[name=Id]").val("");
                    diagnosticView.resetForm();
                }
            },
            Cancel: function () {
                $("div[name=tableSearchPatient]").show();
                $("div[name=buttonSearchPatient]").show();
                $("div[name=tableAddNewTreatmentPackages]").hide();
                $("div[name=buttonAddNewTreatmentPackages]").hide();
                $("div[name=searchPatient]").show();
                $("div[name=addNewTreatment]").hide();
            },
            firstToUpperCase: function (str) {
                return str.substr(0, 1).toUpperCase() + str.substr(1);
            },
            resetForm: function () {
                if ($("input[name=Id]").val() === "" || $("input[name=AddNewId]").val() === "") {
                    var allinput = $("input");
                    $("div[class=form-body]").find(allinput).val("");
                    $("div[class=form-body]").find("select").val(1);
                    $("div[class=form-body]").find("textarea").val("");

                } else {
                }
            },
            checked: function (element) {
                1
                if ($(element).prop("checked") !== true) {
                    $(element).parent().css("background-color", "white").css('color', '#555555');
                    $(element).removeAttr("checked");
                } else {
                    $(element).parent().css('background-color', '#00a859').css('color', '#fff');
                }
            },
            fillTbody: function (data) {
                $("tbody#tbodyDiagnosticList").empty();
                var row = "";
                for (var i = 0; i < data.length; i++) {
                    var tr = "";
                    if (data[i]["active"] === 0) {
                        tr += "<tr id=" + data[i]["id"] + " data-note='" + data[i]["note"] + "' data-code='" + data[i]["code"] + "' data-patientId='" + data[i]["patientId"] + "' data-packageId='" + data[i]["packageId"] + "' ondblclick='diagnosticView.updateTreatmentPackage(this)' style='cursor: pointer;background-color: #e6e4e4'>";
                    } else {
                        tr += "<tr id=" + data[i]["id"] + " style='cursor: pointer' data-note='" + data[i]["note"] + "' data-code='" + data[i]["code"] + "' data-patientId='" + data[i]["patientId"] + "' data-packageId='" + data[i]["packageId"] + "' ondblclick='diagnosticView.updateTreatmentPackage(this)'>";
                    }
                    tr += "<td>" + data[i]["code"] + "</td>";
                    tr += "<td>" + data[i]["note"] + "</td>";
                    tr += "<td>" + data[i]["createdDate"] + "</td>";
                    tr += "<td>" + data[i]["namePackage"] + "</td>";
                    tr += "<td style='min-width: 100px;'><button  type='button' style='margin-left: 20%; background-color: #999999; border-color: #999999' class='btn btn-info btn-circle' data-active='" + data[i]["active"] + "' data-date='" + data[i]["createdDate"] + "' data-Id='" + data[i]["id"] + "' onclick='diagnosticView.fillUpdateToTable(this,String(\"\"))' ><i class='fa fa-cog' ></i></button><button type='button' style='margin-left: 5%;border-color: rgb(212, 0, 0);background-color: rgb(212, 0, 0);' class='btn btn-info btn-circle' data-Id='" + data[i]["id"] + "' onclick='diagnosticView.deleteTreatmentPackages(this)'><i class='fa fa-times' ></i></button></td>";
                    row += tr;
                }
                $("tbody#tbodyDiagnosticList").append(row);
                diagnosticView.idDiagnostic = null;
                //diagnosticView.addNewDiagnostic(result);
            },
            updateTreatmentPackage:function (element) {
                $("input[name=AddNewId]").val($(element).attr("id"));
                $("select[name=PackagesId]").val($(element).attr("data-packageId"));
                //$("input[name=Id]").val($(element).attr("data-patientId"));
                $("input[name=TreatmentPackageCode]").val($(element).attr("data-code"));
                $("textarea[name=Note]").val($(element).attr("data-note"));
                diagnosticView.addNewTreatmentPackages();
            },
            setValueObject: function () {
                diagnosticView.resetDiagnosticObject();
                for (var i = 0; i < Object.keys(diagnosticView.DiagnosticObject).length; i++) {
                    diagnosticView.DiagnosticObject[Object.keys(diagnosticView.DiagnosticObject)[i]] = $("#" + Object.keys(diagnosticView.DiagnosticObject)[i]).val();
                }
            },
            searchPatient: function (element) {
                diagnosticView.setValueObject();
                var dataArray = [];
                for (var i = 0; i < Object.keys(diagnosticView.DiagnosticObject).length; i++) {
                    if (diagnosticView.DiagnosticObject[Object.keys(diagnosticView.DiagnosticObject)[i]] != null) {
                        dataArray.push(diagnosticView.DiagnosticObject[Object.keys(diagnosticView.DiagnosticObject)[i]]);
                    }
                }
                $.post(url + "admin/searchPatient", {
                    _token: _token,
                    Patient: diagnosticView.DiagnosticObject
                }, function (data) {
                    if (data.length !== 0) {
                        var row = "";
                        for (var i = 0; i < data.length; i++) {
                            var tr = "";
                            tr += "<tr id=" + data[i]["id"] + ">";
                            tr += "<td>" + data[i]["code"] + "</td>";
                            tr += "<td>" + data[i]["fullName"] + "</td>";
                            tr += "<td>" + data[i]["sex"] + "</td>";
                            tr += "<td>" + data[i]["birthday"] + "</td>";
                            tr += "<td <button type='button' style='margin-left: 30%;' class='btn btn-info btn-circle' data-Id='" + data[i]["id"] + "' onclick='diagnosticView.fillToInput(this)'><i class='fa fa-check '></i></button></td>";
                            tr += "</tr>";
                            row += tr;
                        }
                        $("tbody#AutoCompleteTableBody").empty().append(row);
                        $("div#Table").show();
                        //$("div#Table").css("left", position.left).css("top", (position.top - 235));
                    }

                });
            },
            fillToInput: function (element) {
                $("div#Table").hide();
                $("input[name=Id]").val($(element).attr("data-Id"));
                $("input[name=Code]").val($(element).parent().parent().find("td").eq(0).text());
                $("input[name=FullName]").val($(element).parent().parent().find("td").eq(1).text());
                $("input[name=Sex]").val($(element).parent().parent().find("td").eq(2).text());
                $("input[name=Birthday]").val($(element).parent().parent().find("td").eq(3).text());
                diagnosticView.SearchTreatmentPackages($(element).attr("data-Id"));
            },
            SearchTreatmentPackages: function (element) {
                $.post(url + "admin/SearchTreatmentPackages", {
                    _token: _token,
                    IdPatient: element

                }, function (data) {
                    diagnosticView.fillTbody(data)
                })
            },
            fillUpdateToTable: function (element, result) {
                var d = new Date();
                var year = d.getFullYear();
                var month = d.getMonth() + 1;
                var date = d.getDate();
                if (month < 10) month = "0" + month;
                if (date < 10) date = "0" + date;
                var strDate = year + "-" + month + "-" + date;
                if ($(element).attr("data-date") < strDate || $(element).attr("data-active") === "0") {
                    $("button[name=CompleteTreatmentPackage]").hide();
                    $("button[name=cancelTreatment]").text("Trở về");
                } else if (result !== "") {
                    diagnosticView.idTreatmentPackage = result;
                } else {
                    diagnosticView.idTreatmentPackage = $(element).attr("data-Id");
                    $("button[name=CompleteTreatmentPackage]").show();
                    $("button[name=cancelTreatment]").text("Huỷ");
                }
                $.post(url + "admin/searchProfessional", {
                    _token: _token,
                    idPackageTreatment: diagnosticView.idTreatmentPackage
                }, function (data) {
                    if (data !== null) {
                        diagnosticView.data = data[0],
                                $("tbody#PackagesTable").children().children().css("background-color", "white").css('color', '#555555');
                        $("tbody#PackagesTable").children().children().find("input").removeAttr("checked");
                        for (var i = 0; i < data.length; i++) {
                            if ($("tbody#PackagesTable").children().find("td[name=" + data[i]["professionalId"] + "]")) {
                                $("td[name=" + data[i]["professionalId"] + "]").css("background-color", "#00a859").css('color', '#ffffff');
                                $("td[name=" + data[i]["professionalId"] + "]").find("input").prop("checked", true);
                            }
                        }
                    }
                });
                $("div#TablePackages").show();
                $("div#menuPackageTreatment").hide();
                //$(element).parent().parent().addClass("active");
            },
            fillAddNewToTable: function () {
                $("tbody#PackagesTable").children().children().css("background-color", "white").css('color', '#555555');
                $("tbody#PackagesTable").children().children().find("input").removeAttr("checked");
                $("div#TablePackages").show();
                $("div#menuPackageTreatment").hide();

            },
            deleteTreatmentPackages: function (element) {
                $("div#modalConfirm").modal("show");
                $("div#modalContent").empty().append("Xoá phiếu điều trị ?");
                diagnosticView.deleteTreatmentPackage = $(element).attr("data-Id");
            },
            modalAgree: function () {
                $.post(url + "admin/deleteTreatmentPackage", {
                    _token: _token,
                    id: diagnosticView.deleteTreatmentPackage
                }, function (data) {
                    if (data === "1") {
                        diagnosticView.SearchTreatmentPackages($("input[name=Id]").val());
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                    } else {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Phiếu đã được xoá");
                        $("button[name=modalAgree]").hide();
                    }
                })
            },
            cancelTreatment: function () {
                if ($("button[name=cancelTreatment]").text() === "Trở về") {
                    $("div#TablePackages").hide();
                    $("div#menuPackageTreatment").show();
                } else {
                    $("tbody#PackagesTable").children().children().css("background-color", "white").css('color', '#555555');
                    $("tbody#PackagesTable").children().children().find("input").removeAttr("checked");
                    for (var i = 0; i < diagnosticView.data.length; i++) {
                        if ($("tbody#PackagesTable").children().find("td[name=" + diagnosticView.data[i]["professionalId"] + "]")) {
                            $("td[name=" + diagnosticView.data[i]["professionalId"] + "]").css("background-color", "#00a859").css('color', '#ffffff');
                            $("td[name=" + diagnosticView.data[i]["professionalId"] + "]").find("input").prop("checked", true);
                        }
                    }
                }
            },
            CompleteTreatmentPackage: function () {
                var array = [];
                var findtdchecked = $("tbody#PackagesTable").children().children();
                for (var i = 1; i <= findtdchecked.children().length; i++) {
                    if (findtdchecked.find("input[id=" + i + "]").prop("checked") === true) {
                        array.push(findtdchecked.find("input[id=" + i + "]").attr("id"));
                    }
                }
                $.post(url + "admin/updateDetailTreatment", {
                    _token: _token,
                    idTreatmentPackage: diagnosticView.idTreatmentPackage,
                    data: array,
                    idPatient: $("input[name=Id]").val()
                }, function (data) {
                    if (data === "1") {
                        console.log(diagnosticView.idTreatmentPackage);
                        diagnosticView.fillUpdateToTable('', diagnosticView.idTreatmentPackage);
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Lưu thành công");
                        $("button[name=modalAgree]").hide();
                        $("div#TablePackages").hide();
                        $("div#menuPackageTreatment").show();
                    }
                });

            },
            addNewTreatmentPackages: function () {
                $("select[name=PatientId]").val($("input[name=Id]").val());
                $("div[name=tableSearchPatient]").hide();
                $("div[name=buttonSearchPatient]").hide();
                $("div[name=tableAddNewTreatmentPackages]").show();
                $("div[name=buttonAddNewTreatmentPackages]").show();
                $("div[name=searchPatient]").hide();
                $("div[name=addNewTreatment]").show();
            },
            addNew: function () {
                diagnosticView.resetDiagnosticObject();
                for (var i = 0; i < Object.keys(diagnosticView.DiagnosticObject).length; i++) {
                    diagnosticView.DiagnosticObject[Object.keys(diagnosticView.DiagnosticObject)[i]] = $("#" + Object.keys(diagnosticView.DiagnosticObject)[i]).val();
                }
                $("#formDiagnostic").validate({
                    rules: {
                        TreatmentPackageCode: "required"
                    },
                    messages: {
                        TreatmentPackageCode: "Mã phiếu không được rỗng",
                    }
                });
                if ($("#formDiagnostic").valid()) {
                    $.post(url + "admin/addNewTreatment", {
                        _token: _token,
                        data: diagnosticView.DiagnosticObject
                    }, function (data) {
                        if (data === "1") {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Thêm phiếu thành công");
                            $("button[name=modalAgree]").hide();
                            diagnosticView.resetForm();
                        } else if (data === "2") {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Sửa phiếu thành công");
                            $("button[name=modalAgree]").hide();
                        }else if (data === "0") {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Sửa phiếu KHÔNG thành công");
                            $("button[name=modalAgree]").hide();
                        }else {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Thêm phiếu KHÔNG thành công");
                            $("button[name=modalAgree]").hide();
                        }
                    })
                }
            }

        }
    }
</script>