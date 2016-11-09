{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Chắt chắn xoá ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Đóng</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="professionalView.modalAgree()">Tiếp tục
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
            <h4 style="color: #00a859">Khảo sát > Tiến triển bệnh > Điều trị chuyên môn</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-5" id="seachPatient">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;" name="searchPatient">Tìm kiếm bệnh nhân
                        <button type="button" class="btn btn-info btn-circle pull-right"
                                onclick="professionalView.addNewProfessional('')"><i
                                    class="fa fa-refresh"></i>
                        </button>
                        {{--<button type="button" class="btn btn-info btn-circle pull-right"--}}
                        {{--onclick="professionalView.addNewTreatmentPackages()"><i--}}
                        {{--class="fa fa-plus"></i>--}}
                        {{--</button>--}}
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formProfessional">
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
                                                <th>Ngày sinh</th>
                                                <th>Chọn</th>
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
                                    {{--<div class="">--}}
                                    {{--<div class="form-group form-md-line-input col-md-6">--}}
                                    {{--<label for="Sex"><b>Giới tính</b></label>--}}
                                    {{--<select class="form-control" name="Sex" id="Sex">--}}
                                    {{--<option value="1">Nam</option>--}}
                                    {{--<option value="2">Nữ</option>--}}
                                    {{--</select>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group form-md-line-input col-md-6">--}}
                                    {{--<label for="Birthday"><b>Năm sinh</b></label>--}}
                                    {{--<input type="text" class="form-control"--}}
                                    {{--id="Birthday"--}}
                                    {{--name="Birthday">--}}

                                    {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                            <div class="form-actions noborder" name="buttonSearchPatient">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="professionalView.searchPatient(this)">
                                        Tìm kiếm
                                    </button>
                                    <button type="button" class="btn default">Huỷ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="menuPackageTreatment">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div style="color: #00a859;font-size: 17px;">Danh sách gói điều trị</div>
                    </div>
                    <div class="table-responsive" style="height: 300px ;overflow: scroll;">
                        <table class="table table-bordered table-hover order-column" id="tableProfessionalList"
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
                            <tbody id="tbodyProfessionalList">
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="row" id="TablePackages">
                <div style="background-color: white;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div style="color: #00a859;font-size: 17px;" name="title"><span name="title"> Chi tiết điều trị của mã phiếu:</span>
                                @if(Auth::user()->positionId == 1 || Auth::user()->positionId == 5)
                                    <button type="button" class="btn btn-info btn-circle pull-right"
                                            onclick="professionalView.Show()"
                                            style="width: 50px;"><i class="fa fa-plus"></i>
                                        Hiện
                                    </button>
                                    <button type="button" class="btn btn-info btn-circle pull-right"
                                            onclick="professionalView.Hide()"
                                            style="width: 50px;"><i
                                                class="fa fa-minus"></i>
                                        Ẩn
                                    </button>
                                @endif
                            </div>

                        </div>
                        <div style="height: 650px ;overflow: scroll;">
                            <table class="table table-bordered table-hover order-column " id="PackagesTable">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Vùng</th>
                                    <th>Chuyên môn</th>
                                    <th>Vị trí</th>
                                    <th>S/C</th>
                                    <th>Phút</th>
                                    <th>Mã chuyên viên</th>
                                    <th>Bắt đầu</th>
                                    <th>Tình trạng</th>
                                    <th>Kết thúc</th>
                                </tr>
                                </thead>
                                <tbody id="PackagesTable" class="">

                                </tbody>
                            </table>

                        </div>
                        {{--<div class="form-group pull-bottom" style="margin-top: 10%; text-align: center; ">--}}
                        {{--<button type="button" name="CompleteTreatmentPackage" class="btn blue"--}}
                        {{--onclick="professionalView.CompleteTreatmentPackage(this)">--}}
                        {{--Hoàn tất--}}
                        {{--</button>--}}
                        {{--<button type="button" name="cancelTreatment" onclick="professionalView.cancelTreatment(this)"--}}
                        {{--class="btn default">Huỷ--}}
                        {{--</button>--}}
                        {{--</div>--}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    if (typeof (professionalView) === 'undefined') {
        professionalView = {
            goBack: null,
            idTreatmentPackage: null,
            idProfessional: null,
            data: null,
            check: true,
            DateStart: null,
            DateEnd: null,
            deleteTreatmentPackage: null,
            ProfessionalObject: {
                Id: null,
                Code: null,
                FullName: null,
                Birthday: null,
                Sex: null,
                AddNewId: null,
                PackagesId: null,
                PatientId: null,
                TreatmentPackageCode: null,
                Note: null,
                TherapistId: null,
                Status: null,

            },
            resetProfessionalObject: function () {
                for (var propertyName in professionalView.ProfessionalObject) {
                    if (professionalView.ProfessionalObject.hasOwnProperty(propertyName)) {
                        professionalView.ProfessionalObject.propertyName = null;
                    }
                }
            },
            addNewProfessional: function (result) {
                if (result === "") {
                    $("input[name=Id]").val("");
                    professionalView.resetForm();
                } else if (result === "delete") {
                    $("div#modalContent").empty().append("Xoá thành công");
                    $("button[name=modalAgree]").hide();
                    $("input[name=Id]").val("");
                    professionalView.resetForm();
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
            searchTherapist: function (element) {

                $.post(url + "admin/searchTherapist", {
                    _token: _token,
                    codeTherapist: $(element).val()
                }, function (data) {
                    if (data === "1") {
                        professionalView.check = true;
                    } else {
                        professionalView.check = false;
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Không tìm thấy mã chuyên viên. Vui lòng nhập lại");
                        $("button[name=modalAgree]").hide();
                        $("input[id=" + $(element).attr("Id") + "]").val("").focus();

                    }
                })
            },
            fillTbody: function (data) {
                $("tbody#tbodyProfessionalList").empty();
                var row = "";
                for (var i = 0; i < data[0].length; i++) {
                    var tr = "";
                    if (data[0][i]["active"] === 0) {
                        tr += "<tr id=" + data[0][i]["id"] + " style='cursor: pointer;background-color: #e6e4e4' data-active='" + data[0][i]["active"] + "' data-date='" + data[0][i]["createdDate"] + "' data-code='" + data[0][i]["code"] + "' data-Id='" + data[0][i]["id"] + "' onclick='professionalView.fillUpdateToTable(this,String(\"\"))'>";
                    } else {
                        tr += "<tr id=" + data[0][i]["id"] + " style='cursor: pointer' data-active='" + data[0][i]["active"] + "' data-date='" + data[0][i]["createdDate"] + "' data-code='" + data[0][i]["code"] + "' data-Id='" + data[0][i]["id"] + "' onclick='professionalView.fillUpdateToTable(this,String(\"\"))'>";
                    }
                    tr += "<td>" + data[0][i]["code"] + "</td>";
                    tr += "<td>" + data[0][i]["packagesNote"] + "</td>";
                    tr += "<td>" + data[0][i]["createdDate"] + "</td>";
                    tr += "<td>" + data[0][i]["namePackage"] + "</td>";
                    tr += "<td style='min-width: 100px;'><button  type='button' style='margin-left: 20%; background-color: #999999; border-color: #999999' class='btn btn-info btn-circle' data-active='" + data[0][i]["active"] + "' data-code='" + data[0][i]["code"] + "' data-date='" + data[0][i]["createdDate"] + "' data-Id='" + data[0][i]["id"] + "' onclick='professionalView.fillUpdateToTable(this,String(\"\"))' ><i class='fa fa-cog' ></i></button></td>";
                    row += tr;
                }
                $("tbody#tbodyProfessionalList").append(row);
                professionalView.idProfessional = null;
                //professionalView.addNewProfessional(result);
            },
            setValueObject: function () {
                professionalView.resetProfessionalObject();
                for (var i = 0; i < Object.keys(professionalView.ProfessionalObject).length; i++) {
                    professionalView.ProfessionalObject[Object.keys(professionalView.ProfessionalObject)[i]] = $("#" + Object.keys(professionalView.ProfessionalObject)[i]).val();
                }
            },
            searchPatient: function (element) {
                professionalView.setValueObject();
                var dataArray = [];
                for (var i = 0; i < Object.keys(professionalView.ProfessionalObject).length; i++) {
                    if (professionalView.ProfessionalObject[Object.keys(professionalView.ProfessionalObject)[i]] != null) {
                        dataArray.push(professionalView.ProfessionalObject[Object.keys(professionalView.ProfessionalObject)[i]]);
                    }
                }
                $.post(url + "admin/searchPatient", {
                    _token: _token,
                    Patient: professionalView.ProfessionalObject
                }, function (data) {
                    if (data.length !== 0) {
                        var row = "";
                        for (var i = 0; i < data.length; i++) {
                            var tr = "";
                            tr += "<tr id=" + data[i]["id"] + ">";
                            tr += "<td>" + data[i]["code"] + "</td>";
                            tr += "<td>" + data[i]["fullName"] + "</td>";
                            if (data[i]["sex"] === 1) {
                                tr += "<td>Nam</td>";
                            } else {
                                tr += "<td>Nữ</td>";
                            }
                            tr += "<td>" + data[i]["birthday"] + "</td>";
                            tr += "<td <button type='button' style='margin-left: 30%;' class='btn btn-info btn-circle' data-code='" + data[i]["code"] + "' data-Id='" + data[i]["id"] + "' onclick='professionalView.fillToInput(this)'><i class='fa fa-check '></i></button></td>";
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
                var a = $("tbody[id=AutoCompleteTableBody]").find("tr[id=" + $(element).attr("data-Id") + "]");
                $("div#Table").hide();
                $("input[name=Id]").val($(element).attr("data-Id"));
                $("input[name=Code]").val(a.find("td").eq(0).text());
                $("input[name=FullName]").val(a.find("td").eq(1).text());
                $("input[name=Sex]").val(a.find("td").eq(2).text());
                $("input[name=Birthday]").val(a.find("td").eq(3).text());
                professionalView.SearchTreatmentPackages($(element).attr("data-code"));
            },
            SearchTreatmentPackages: function (element) {
                $.post(url + "admin/SearchTreatmentPackages", {
                    _token: _token,
                    IdPatient: element

                }, function (data) {
                    professionalView.fillTbody(data)
                })
            },
            Show: function () {
                var dem = $("tbody[id=PackagesTable]").children("tr");
                for (var i = 0; i < dem.length; i++) {
                    if ($(dem[i]).find("td:eq(6)").children().val() !== "") {
                        $(dem[i]).show();
                    }
                }
            },
            Hide:function () {
                var dem = $("tbody[id=PackagesTable]").children("tr");
                for (var i = 0; i < dem.length; i++) {
                    if ($(dem[i]).find("td:eq(6)").children().val() !== "") {
                        $(dem[i]).hide();
                    }
                }
            },
            getDate: function () {
                var d = new Date();
                var year = d.getFullYear();
                var month = d.getMonth() + 1;
                var date = d.getDate();
                var Hour = d.getHours();
                var Minute = d.getMinutes();
                var second = d.getSeconds();
                if (month < 10) month = "0" + month;
                if (date < 10) date = "0" + date;
                var strDate = year + "-" + month + "-" + date + " " + Hour + ":" + Minute + ":" + second;
                return strDate;
            },
            Start: function (element) {
                professionalView.DateStart = professionalView.getDate();
                if ($(element).parent().parent().find("td:eq(6)").children().val() !== "") {
                    $(element).parent().parent().find("td:eq(6)").children().prop("readOnly", true);
                    $(element).prop("disabled", true);
                    $(element).css("background-color", "#00a859").css("color", "#ffffff");
                    $(element).text(professionalView.DateStart);

                } else {
                    $("div#modalConfirm").modal("show");
                    $("div#modalContent").empty().append("Mã chuyên viên không được trống");
                    $("button[name=modalAgree]").hide();
                }
            },
            fillUpdateToTable: function (element, result) {
                $("span[name=title]").text("Chi tiết điều trị của mã phiếu: " + $(element).attr("data-code") + "");
                var d = new Date();
                var year = d.getFullYear();
                var month = d.getMonth() + 1;
                var date = d.getDate();
                if (month < 10) month = "0" + month;
                if (date < 10) date = "0" + date;
                var strDate = year + "-" + month + "-" + date;
//                if ($(element).attr("data-date") < strDate || $(element).attr("data-active") === "0") {
//
//                } else

                if (result !== "") {
                    professionalView.idTreatmentPackage = result;

                } else {
                    professionalView.idTreatmentPackage = $(element).attr("data-Id");
                    $("button[name=CompleteTreatmentPackage]").show();
                    $("button[name=cancelTreatment]").text("Huỷ");
                }
                $.post(url + "admin/fillToTbody", {
                    _token: _token,
                    idPackageTreatment: professionalView.idTreatmentPackage
                }, function (data) {
                    $("tbody[id=PackagesTable]").empty().append(data);
                    var dem = $("tbody[id=PackagesTable]").children("tr");
                    for (var i = 0; i < dem.length; i++) {
                        if ($(dem[i]).find("td:eq(6)").children().val() !== "") {
                            $(dem[i]).hide();
                        }
                    }
                });

//                $("div#TablePackages").show();
//                $("div#menuPackageTreatment").hide();
                //$(element).parent().parent().addClass("active");
            },
            fillAddNewToTable: function () {
                $("tbody#PackagesTable").children().children().css("background-color", "white").css('color', '#555555');
                $("tbody#PackagesTable").children().children().find("input").removeAttr("checked");


            },
            deleteTreatmentPackages: function (element) {
                $("div#modalConfirm").modal("show");
                $("div#modalContent").empty().append("Xoá phiếu điều trị ?");
                professionalView.deleteTreatmentPackage = $(element).attr("data-Id");
            },
            modalAgree: function () {
                $.post(url + "admin/deleteTreatmentPackage", {
                    _token: _token,
                    id: professionalView.deleteTreatmentPackage
                }, function (data) {
                    if (data === "1") {
                        professionalView.SearchTreatmentPackages($("input[name=Id]").val());
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
                    // $("tbody#PackagesTable").children().children().find("input").removeAttr("checked");
                    for (var i = 0; i < professionalView.data.length; i++) {
                        if ($("tbody#PackagesTable").children().find("td[name=" + professionalView.data[i]["professionalId"] + "]")) {
                            $("td[name=" + professionalView.data[i]["professionalId"] + "]").css("background-color", "#00a859").css('color', '#ffffff');
                            // $("td[name=" + professionalView.data[i]["professionalId"] + "]").find("input").prop("checked", true);
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
                    idTreatmentPackage: professionalView.idTreatmentPackage,
                    data: array,
                    idPatient: $("input[name=Id]").val()
                }, function (data) {
                    if (data === "1") {
                        professionalView.fillUpdateToTable('', professionalView.idTreatmentPackage);
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Lưu thành công");
                        $("button[name=modalAgree]").hide();
                        $("div#TablePackages").hide();
                        $("div#menuPackageTreatment").show();
                    }
                });

            },
            addNewTreatmentPackages: function () {
                $("div[name=tableSearchPatient]").hide();
                $("div[name=buttonSearchPatient]").hide();
                $("div[name=tableAddNewTreatmentPackages]").show();
                $("div[name=buttonAddNewTreatmentPackages]").show();
                $("div[name=searchPatient]").hide();
                $("div[name=addNewTreatment]").show();
            },
            addNew: function () {
                professionalView.resetProfessionalObject();
                for (var i = 0; i < Object.keys(professionalView.ProfessionalObject).length; i++) {
                    professionalView.ProfessionalObject[Object.keys(professionalView.ProfessionalObject)[i]] = $("#" + Object.keys(professionalView.ProfessionalObject)[i]).val();
                }
                $("#formProfessional").validate({
                    rules: {
                        TreatmentPackageCode: "required"
                    },
                    messages: {
                        TreatmentPackageCode: "Mã phiếu không được rỗng",
                    }
                });
                if ($("#formProfessional").valid()) {
                    $.post(url + "admin/addNewTreatment", {
                        _token: _token,
                        data: professionalView.ProfessionalObject
                    }, function (data) {
                        if (data === "1") {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Thêm phiếu thành công");
                            $("button[name=modalAgree]").hide();
                            professionalView.resetForm();
                        } else {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Thêm phiếu KHÔNG thành công");
                            $("button[name=modalAgree]").hide();
                        }
                    })
                }
            },
            saveDetail: function (element) {
                if (professionalView.check == true) {
                    $idTherapist = $(element).parent().parent().find("td").eq(6).children().val();
                    $idstatus = $(element).parent().parent().find("td").eq(8).children().val();

                    if ($idTherapist === "") {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Chưa chọn chuyên viên thực hiện");
                        $("button[name=modalAgree]").hide();
                    } else if ($idstatus === "-1") {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Chưa chọn tình trạng bệnh nhân");
                        $("button[name=modalAgree]").hide();
                    } else {
                        professionalView.DateEnd = professionalView.getDate();
                        $.post(url + "admin/updateAil", {
                            _token: _token,
                            therapistId: $(element).parent().parent().find("td").find("input").val(),
                            ail: $(element).parent().parent().find("td").eq(8).find("select").val(),
                            dateStart: professionalView.DateStart,
                            dateEnd: professionalView.DateEnd,
                            patientId: $("input[name=Id]").val(),
//                    treatmentPackageId:professionalView.idTreatmentPackage
                            id: $(element).attr("id")
                        }, function (data) {
                            if (data === "1") {
                                if ($(element).attr("positionId") === "1" || $(element).attr("positionId") === "5") {
                                    $(element).css("background-color", "#00a859").css('color', '#ffffff');
                                    $(element).text(professionalView.DateEnd);
                                } else {
                                    $(element).parent().parent().hide();
                                }

                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Lưu thành công");
                                $("button[name=modalAgree]").hide();
                            } else if (data === "2") {

                            }
                        })
                    }
                } else {
                    $("div#modalConfirm").modal("show");
                    $("div#modalContent").empty().append("Không tìm thấy mã chuyên viên. Vui lòng nhập lại");
                    $("button[name=modalAgree]").hide();
                }
            }
        }
    }
    //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;  //time in ms, 3 second for example
    var $inputCode = $("input#Code");

    //on keyup, start the countdown
    $inputCode.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTypingCode, doneTypingInterval);
    });

    //on keydown, clear the countdown
    $inputCode.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTypingCode() {
        $.get(url + 'admin/getSearchCodePatient', {
            _token: _token,
            Code: $inputCode.val()
        }, function (data) {
            if (data === "0") {
                $("div#modalContent").empty().append("Bệnh nhân này đang được nhập dữ liệu.");
                $("button[name=modalAgree]").hide();
                $("input[name=Id]").val("");
                $("div#modalConfirm").modal("show");
                $inputCode.val("");
            } else if (data === "2") {
//                        $("div#modalContent").empty().append("Vui lòng nhập mã chính xác");
//                        $("button[name=modalAgree]").hide();
//                        $("input[name=Id]").val("");
//                        $("div#modalConfirm").modal("show");
            } else {
                $inputCode.val(data[0]["code"]);
            }
        });
    }
</script>