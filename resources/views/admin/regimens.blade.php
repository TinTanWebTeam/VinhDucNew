{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">
                <table class="table table-bordered table-hover order-column" id="PackagesTable"
                       style="overflow: scroll;">
                    <tr>
                        <td style="width: 50%;">
                            <label for=""> Tên chuyên viên</label>
                            <input type="text"
                                   id="NameTherapist"
                                   name="NameTherapist"
                                   value="{{\Auth::user()->name}}"
                                   readonly
                                   style="margin-left: 10%;">
                        </td>
                        <td>
                            <button type="button"
                                    id="ail"
                                    name="ail"
                                    onclick="regimensView.Ail()"
                                    style="margin-left: 20%;" class="btn btn-default">Đau
                            </button>
                            <button type="button"
                                    id="notAil"
                                    name="notAil"
                                    onclick="regimensView.notAil()"
                                    style="margin-left: 20%;" class="btn btn-default">Không đau
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
            {{--<div class="modal-footer">--}}
            {{--<button type="button" class="btn green" name="modalAgree"--}}
            {{--onclick="regimensView.modalAgree()">Tiếp tục--}}
            {{--</button>--}}
            {{--</div>--}}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--End Modal--}}
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4 style="color: #00a859">Khảo sát > Tiến triển bệnh > Phác đồ điều trị</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-6" id="seachPatient">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;" name="SearchPatient">Tìm kiếm bệnh nhân
                        <button type="button" class="btn btn-info btn-circle pull-right"
                                onclick="regimensView.refreshRegimens('')"><i
                                    class="fa fa-refresh"></i>
                        </button>
                    </div>
                    <div style="color: #00a859;font-size: 17px;display: none" name="Status">Đánh giá và thiết lập tình
                        trạng
                        <button type="button" class="btn btn-info btn-circle pull-right"
                                onclick="regimensView.refreshRegimens('')"><i
                                    class="fa fa-refresh"></i>
                        </button>
                    </div>
                </div>
                <div name="searchRegimen">
                    <div class="portlet-body form">
                        <form role="form" id="formregimens">
                            <div class="form-body">
                                <div>
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id">
                                    </div>
                                    <div class="table-responsive row col-md-12" style="display:none" id="Table">
                                        <table class="table table-hover table-light" id="AutoCompleteTable">
                                            <thead>
                                            <tr class="AutoCompleteTableHeader">
                                                <th>Mã bệnh nhân</th>
                                                <th>Họ và tên</th>
                                                <th>Ngày tạo</th>
                                                <th>Chọn</th>
                                            </tr>
                                            </thead>
                                            <tbody id="AutoCompleteTableBody">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="CodePatient"><b>Mã</b></label>
                                        <input type="text" class="form-control"
                                               id="CodePatient"
                                               name="CodePatient"
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
                                        {{--<div class="form-group form-md-line-input col-md-6">--}}
                                        {{--<label for="CodeRegimen"><b>Mã phác đồ</b></label>--}}
                                        {{--<input type="text" class="form-control"--}}
                                        {{--id="CodeRegimen"--}}
                                        {{--name="CodeRegimen"--}}
                                        {{--placeholder="BN001">--}}
                                        {{--</div>--}}
                                        <div class="form-group form-md-line-input col-md-12">
                                            <label for="CreatedDate"><b>Ngày tạo phác đồ</b></label>
                                            <input type="date" class="form-control"
                                                   id="CreatedDate"
                                                   name="CreatedDate"
                                                   value="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions noborder">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="regimensView.searchRegimens(this)">
                                        Tìm kiếm
                                    </button>
                                    <button type="button" class="btn default">Huỷ</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div style="display:none" name="formRegimens">
                    <div class="portlet-body form">
                        <form role="form" id="formregimens">
                            <div class="form-body">
                                <div>
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="AddNewId" id="AddNewId">
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

                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="Note"><b>Thông tin tiến triển</b></label>
                                            <textarea type="text" class="form-control"
                                                      id="Note"
                                                      rows="5"
                                                      name="Note"
                                                      style="resize: none;"
                                                      placeholder="Thông tin tiến triển bệnh nhân">
                                            </textarea>
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="Therapist"><b>Mã chuyên viên</b></label>
                                        <input type="text" class="form-control"
                                               id="Therapist"
                                               name="Therapist"
                                               placeholder="Nhập mã chuyên viên">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions noborder">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="regimensView.addRegimen(this)">
                                        Hoàn tất
                                    </button>
                                    <button type="button" class="btn default" onclick="regimensView.goBack(this)">Quay
                                        lại
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div id="menuPackageTreatment">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div style="color: #00a859;font-size: 17px;">Danh sách phác đồ</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-hover order-column"
                               id="tableregimensList"
                               style="margin-bottom: 0px;">
                            <thead>
                            <tr>
                                <th>Ngày tạo</th>
                                <th>Ngày sửa</th>
                                <th>Tình trạng</th>
                                <th>Ghi chú</th>
                                <th>Chuyên viên</th>
                                {{--<th>Chi tiết</th>--}}
                            </tr>
                            </thead>
                            <tbody id="tbodyRegimensList">
                            </tbody>
                        </table>
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
            idTreatmentPackage: null,
            idregimens: null,
            data: null,
            deleteTreatmentPackage: null,
            AilOrNotAilId: null,
            regimensObject: {
                Id: null,
                CodePatient: null,
                FullName: null,
                CodeRegimen: null,
                CreatedDate: null,
                AddNewId: null,
                Status: null,
                Note: null,
                Therapist:null
            },
            resetregimensObject: function () {
                for (var propertyName in regimensView.regimensObject) {
                    if (regimensView.regimensObject.hasOwnProperty(propertyName)) {
                        regimensView.regimensObject.propertyName = null;
                    }
                }
            },
            refreshRegimens: function (result) {
                if (result === "") {
                    $("input[name=Id]").val("");
                    regimensView.resetForm();
                } else if (result === "delete") {
                    $("div#modalContent").empty().append("Xoá thành công");
                    $("button[name=modalAgree]").hide();
                    $("input[name=Id]").val("");
                    regimensView.resetForm();
                }
            },
            Cancel: function () {
                regimensView.resetForm();
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
            fillTbody: function (data) {
//                $("tbody#tbodyRegimensList").empty();
                var row = "";
                for (var i = 0; i < data.length; i++) {
                    var tr = "";
//                    if (data[i]["active"] === 0) {
//                        tr += "<tr id=" + data[i]["id"] + " data-code=" + data[i]["code"] + " data-note=" + data[i]["note"] + "  ondblclick='regimensView.updateTreatmentRegiment(this)' style='cursor: pointer;background-color: #e6e4e4'>";
//                    } else {
                    tr += "<tr id=" + data[i]["id"] + " data-code=" + data[i]["code"] + " data-status=" + data[i]["status"] + " ondblclick='regimensView.updateTreatmentRegiment(this)' style='cursor: pointer' data-note=" + data[i]["note"] + ">";
//                    }
                    //tr += "<td>" + data[i]["code"] + "</td>";
                    tr += "<td>" + data[i]["createdDate"] + "</td>";
                    tr += "<td>" + data[i]["updatedDate"] + "</td>";
                    if (data[i]["status"] === 0) {
                        tr += "<td></td>";
                    } else if (data[i]["status"] === 1) {
                        tr += "<td>Giảm</td>";
                    } else if (data[i]["status"] === 2) {
                        tr += "<td>Không giảm</td>";
                    } else if (data[i]["status"] === 3) {
                        tr += "<td>Đau hơn</td>";
                    }
                    tr += "<td>" + data[i]["note"] + "</td>";
                    tr += "<td>" + data[i]["therapist"] + "</td>";
//                    tr += "<td style='min-width: 50px;'><button  type='button' style='margin-left: 10%; background-color: #999999; border-color: #999999' class='btn btn-info btn-circle' data-packageId='" + data[i]["treatmentPackageId"] + "' data-code='" + data[i]["code"] + "' data-active='" + data[i]["active"] + "' data-date='" + data[i]["createdDate"] + "' data-Id='" + data[i]["id"] + "' onclick='regimensView.fillUpdateToTable(this,String(\"\"))' ><i class='fa fa-cog' ></i></button></td>";
                    row += tr;
                }
                $("tbody#tbodyRegimensList").empty().append(row);
                regimensView.idregimens = null;
                //regimensView.addNewregimens(result);
            },
            updateTreatmentRegiment: function (element) {
                $("div[name=searchRegimen]").hide();
                $("div[name=formRegimens]").show();
                $("div[name=SearchPatient]").hide();
                $("div[name=Status]").show();
                $("input[name=AddNewId]").val($(element).attr("data-code"))
                $("select#Status").val($(element).attr("data-status"));
                $("textarea[name=Note]").val($(element).attr("data-note"));

            },
            setValueObject: function () {
                regimensView.resetregimensObject();
                for (var i = 0; i < Object.keys(regimensView.regimensObject).length; i++) {
                    regimensView.regimensObject[Object.keys(regimensView.regimensObject)[i]] = $("#" + Object.keys(regimensView.regimensObject)[i]).val();
                }
            },
            searchRegimens: function () {
                regimensView.setValueObject();
                var dataArray = [];
                for (var i = 0; i < Object.keys(regimensView.regimensObject).length; i++) {
                    if (regimensView.regimensObject[Object.keys(regimensView.regimensObject)[i]] != null) {
                        dataArray.push(regimensView.regimensObject[Object.keys(regimensView.regimensObject)[i]]);
                    }
                }
                $.post(url + "admin/searchRegimens", {
                    _token: _token,
                    Patient: regimensView.regimensObject
                }, function (data) {
                    if (data.length !== 0) {
                        var row = "";
                        for (var i = 0; i < data.length; i++) {
                            var tr = "";
                            tr += "<tr id=" + data[i]["id"] + ">";
                            tr += "<td>" + data[i]["maBN"] + "</td>";
                            tr += "<td>" + data[i]["fullName"] + "</td>";
                            tr += "<td>" + data[i]["createdDate"] + "</td>";
                            tr += "<td <button type='button' style='margin-left: 30%;' class='btn btn-info btn-circle' data-code='" + data[i]["maPD"] + "' data-Id='" + data[i]["id"] + "' onclick='regimensView.fillToInput(this)'><i class='fa fa-check '></i></button></td>";
                            tr += "</tr>";
                            row += tr;
                        }
                        $("tbody#AutoCompleteTableBody").empty().append(row);
                        $("div#Table").show();
                        //$("div#Table").css("left", position.left).css("top", (position.top - 235));
                    }else{
                        $("div#modalContent").empty().append("Không tìm thấy dữ liệu. Vui lòng nhập lại");
                        $("div#modalConfirm").modal("show");
                        $("button[name=modalAgree]").hide();
                    }

                });
            },
            fillToInput: function (element) {
                var a = $("tbody[id=AutoCompleteTableBody]").find("tr[id=" + $(element).attr("data-Id") + "]");

                $("div#Table").hide();
                $("input[name=Id]").val($(element).attr("data-Id"));
                $("input[name=CodePatient]").val(a.find("td").eq(0).text());
                $("input[name=FullName]").val(a.find("td").eq(1).text());
                $("input[name=CodeRegimen]").val(a.find("td").eq(2).text());
                $("input[name=CreatedDate]").val(a.find("td").eq(3).text());
                regimensView.SearchTreatmentRegimens($(element).attr("data-code"));
            },
            SearchTreatmentRegimens: function (element) {
                $.post(url + "admin/SearchTreatmentRegimens", {
                    _token: _token,
                    IdTreatmentRegimen: element

                }, function (data) {
                    regimensView.fillTbody(data)
                })
            },
            fillUpdateToTable: function (element, result) {
                $("div[name=title]").text("Chi tiết điều trị của mã phiếu: " + $(element).attr("data-code") + "")
                var d = new Date();
                var year = d.getFullYear();
                var month = d.getMonth() + 1;
                var date = d.getDate();
                if (month < 10) month = "0" + month;
                if (date < 10) date = "0" + date;
                var strDate = year + "-" + month + "-" + date;
                if ($(element).attr("data-date") < strDate || $(element).attr("data-active") === "0") {
                }
                if (result !== "") {
                    regimensView.idTreatmentPackage = result;

                } else {
                    regimensView.idTreatmentPackage = $(element).attr("data-packageId");
                }
                $.post(url + "admin/tbodyRegimen", {
                    _token: _token,
                    idPackageTreatment: regimensView.idTreatmentPackage
                }, function (data) {
                    if (data !== null) {
                        regimensView.data = data;
                        $("tbody[id=PackagesTable]").empty().append(data);
                    }
                });
//                $("div#TablePackages").show();
//                $("div#menuPackageTreatment").hide();
                //$(element).parent().parent().addClass("active");
            },
            fillAddNewToTable: function () {
                $("tbody#PackagesTable").children().children().css("background-color", "white").css('color', '#555555');
                $("tbody#PackagesTable").children().children().find("input").removeAttr("checked");
                $("div#TablePackages").show();
                $("div#menuPackageTreatment").hide();

            },
            survey: function (element) {
                var professionalId = $(element).attr("name");
                $.post(url + "admin/checkAilOrNotAil", {
                    _token: _token,
                    professionalId: professionalId
                }, function (data) {
                    regimensView.AilOrNotAilId = data["id"];
                    if (data["ail"] === 0) {
                        $("button[name=notAil]").css("background-color", "#00a859").css("border-color", "#00a859").css('color', '#ffffff');
                        $("button[name=ail]").css("background-color", "#eeeeee").css("border-color", "#e2e2e2").css('color', '#555555');
                        $("div#modalConfirm").modal("show");
                    } else if (data["ail"] === 1) {
                        $("button[name=ail]").css("background-color", "#00a859").css("border-color", "#00a859").css('color', '#ffffff');
                        $("button[name=notAil]").css("background-color", "#eeeeee").css("border-color", "#e2e2e2").css('color', '#555555');
                        $("div#modalConfirm").modal("show");
                    } else {
                        $("button[name=ail]").css("background-color", "#eeeeee").css("border-color", "#e2e2e2").css('color', '#555555');
                        $("button[name=notAil]").css("background-color", "#eeeeee").css("border-color", "#e2e2e2").css('color', '#555555');
                        $("div#modalConfirm").modal("show");
                    }
                })
            },
            Ail: function () {
                $.post(url + "admin/updateAil", {
                    _token: _token,
                    id: regimensView.AilOrNotAilId
                }, function (data) {
                    $("div#modalConfirm").modal("hide");
                })
            },
            notAil: function () {
                $.post(url + "admin/updateNotAil", {
                    _token: _token,
                    id: regimensView.AilOrNotAilId
                }, function (data) {
                    $("div#modalConfirm").modal("hide");
                })
            },
            goBack: function () {
                $("div#menuPackageTreatment").show();
                $("div[name=searchRegimen]").show();
                $("div[name=formRegimens]").hide();
                $("div[name=SearchPatient]").show();
                $("div[name=Status]").hide();
            },
            addNewRegimens: function () {
                $("div[name=searchRegimen]").hide();
                $("div[name=formRegimens]").show();

            },
            addRegimen: function () {
                $("#formregimens").validate({
                    rules: {
                        Therapist: "required",
                    },
                    messages: {
                        Therapist: "Mã chuyên viên không được rỗng",
                    }
                });
                if ($("#formregimens").valid()) {
                    regimensView.setValueObject();
                    $.post(url + "admin/updateRegimen", {
                        _token: _token,
                        data: regimensView.regimensObject
                    }, function (data) {
                        if (data === "1") {
                            $("div#modalContent").empty().append("Lưu thành công");
                            $("div#modalConfirm").modal("show");
                            regimensView.SearchTreatmentRegimens($("input[name=AddNewId]").val());
                            regimensView.goBack();
                            $("div[name=SearchPatient]").show();
                            regimensView.resetForm();
                        } else {
                            $("div#modalContent").empty().append("Lưu KHÔNG thành công");
                            $("div#modalConfirm").modal("show");
                            $("button[name=modalAgree]").hide();
                        }
                    })
                }
            }
        }
    }

    //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;  //time in ms, 3 second for example
    var $input = $("input#Therapist");

    //on keyup, start the countdown
    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping() {
        $.get(url + 'admin/getSearchCodeTherapist', {
            _token: _token,
            Code: $input.val()
        }, function (data) {
            if (data === "0") {
                $("div#modalContent").empty().append("Bệnh nhân này đang được nhập dữ liệu.");
                $("button[name=modalAgree]").hide();
                $("input[name=Id]").val("");
                $("div#modalConfirm").modal("show");
                $input.val("");
            } else if (data === "2") {
//                        $("div#modalContent").empty().append("Vui lòng nhập mã chính xác");
//                        $("button[name=modalAgree]").hide();
//                        $("input[name=Id]").val("");
//                        $("div#modalConfirm").modal("show");
            } else {
                $input.val(data[0]["code"]);
            }
        });
    }



    //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;  //time in ms, 3 second for example
    var $inputCode = $("input#CodePatient");

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
                $("div#modalContent").empty().append("Không tìm thấy mã vừa nhập");
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