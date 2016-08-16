{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Chắc chắn xoá ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Đóng</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="patientView.modalAgree()">Tiếp tục
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
            <h4 style="color: #00a859">Quản lí > Bệnh nhân</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6" style="height: 660px; overflow: scroll">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Danh sách bệnh nhân
                        {{--<button type="button" class="btn btn-danger btn-circle pull-right"--}}
                                {{--onclick="patientView.deletePatient()"><i--}}
                                    {{--class="fa fa-times"></i>--}}
                        {{--</button>--}}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover order-column col-md-6" id="tablePatientList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Họ và tên</th>
                            <th>Giới tính</th>
                            <th>Số điện thoại</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyPatientList">
                        @if($patients)
                            @foreach($patients as $item)
                                <tr id="{{$item->id}}" onclick="patientView.viewListPatient(this)"
                                    style="cursor: pointer">
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->fullName}}</td>
                                    @if($item->sex===1)
                                        <td>Nam</td>
                                    @else
                                        <td>Nữ</td>
                                    @endif

                                    <td>{{$item->phone}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Thêm mới | Chỉnh sửa
                        <button type="button" class="btn btn-info btn-circle pull-right"
                                onclick="patientView.addNewPatient('')"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formPatient">
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
                                            <select class="form-control" name="Sex" id="Sex">
                                                <option value="1">Nam</option>
                                                <option value="2">Nữ</option>
                                            </select>
                                        </div>
                                        <div class="form-group form-md-line-input col-md-6">
                                            <label for="Birthday"><b>Ngày sinh</b></label>
                                            <input type="date" class="form-control"
                                                   id="Birthday"
                                                   onchange="patientView.birthday()"
                                                   name="Birthday"
                                                   value={{date('Y-m-d')}}>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="form-group form-md-line-input col-md-3">
                                            <label for="Height"><b>Chiều cao</b></label>
                                            <input type="text" class="form-control"
                                                   id="Height"
                                                   name="Height"
                                                   placeholder="170">
                                        </div>
                                        <div class="form-group form-md-line-input col-md-3">
                                            <label for="Weight"><b>Cân nặng</b></label>
                                            <input type="text" class="form-control"
                                                   id="Weight"
                                                   name="Weight"
                                                   placeholder="70">
                                        </div>
                                        <div class="form-group form-md-line-input col-md-3">
                                            <label for="BloodPressure"><b>Huyết áp</b></label>
                                            <input type="text" class="form-control"
                                                   id="BloodPressure"
                                                   name="BloodPressure"
                                                   placeholder="130">
                                        </div>
                                        <div class="form-group form-md-line-input col-md-3">
                                            <label for="Pulse"><b>Mạch</b></label>
                                            <input type="text" class="form-control"
                                                   id="Pulse"
                                                   name="Pulse"
                                                   placeholder="160">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group form-md-line-input col-md-6">
                                            <label for="Job"><b>Công việc</b></label>
                                            <input type="text" class="form-control"
                                                   id="Job"
                                                   name="Job"
                                                   onclick=""
                                                   onchange=""
                                                   placeholder="Nhân viên văn phòng">
                                        </div>
                                        <div class="form-group form-md-line-input col-md-6">
                                            <label for="Phone"><b>Số điện thoại</b></label>
                                            <input type="text" class="form-control"
                                                   id="Phone"
                                                   name="Phone"
                                                   onclick=""
                                                   onchange=""
                                                   placeholder="0963276xxx">
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="Address"><b>Địa chỉ</b></label>
                                        <input type="text" class="form-control"
                                               id="Address"
                                               name="Address"
                                               onclick=""
                                               onchange=""
                                               placeholder="562/2A Lê Quang Định Gò Vấp">
                                    </div>
                                    <div>
                                        <div class="form-group form-md-line-input col-md-6">
                                            <label for="ProvincialId"><b>Thành phố/ Tỉnh</b></label>
                                            <select class="form-control" id="ProvincialId" name="ProvincialId">
                                                @if($provinces)
                                                    @foreach($provinces as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group form-md-line-input col-md-6">
                                            <label for="AgeId"><b>Độ tuổi</b></label>
                                            <select class="form-control" id="AgeId" name="AgeId">
                                                @if($ages)
                                                    @foreach($ages as $item)
                                                        <option value="{{$item->id}}">{{$item->age}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <button type="button" class="btn blue"
                                                onclick="patientView.addNewAndUpdatePatient()">
                                            Hoàn tất
                                        </button>
                                        <button type="button" class="btn default" onclick="patientView.Cancel()">Huỷ</button>
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
        idPatient = null;
        if (typeof (patientView) === 'undefined') {
            patientView = {
                goBack: null,
                idPatient: null,
                PatientObject: {
                    Id: null,
                    Code: null,
                    FullName: null,
                    Birthday: null,
                    Sex: null,
                    Weight: null,
                    Height: null,
                    BloodPressure: null,
                    Pulse: null,
                    Job: null,
                    Phone: null,
                    Address: null,
                    ProvincialId: null,
                    AgeId: null,
                },
                resetPatientObject: function () {
                    for (var propertyName in patientView.PatientObject) {
                        if (patientView.PatientObject.hasOwnProperty(propertyName)) {
                            patientView.PatientObject.propertyName = null;
                        }
                    }
                },
                convertStringToDate: function (date) {
                    var currentDate = new Date(date);
                    var datetime = currentDate.getFullYear() + "-"
                            + ("0" + (currentDate.getMonth() + 1)).slice(-2) + "-"
                            + ("0" + currentDate.getDate()).slice(-2);
                    return datetime;
                },
                addNewPatient: function (result) {
                    if (result === "") {
                        $("input[name=Id]").val("");
                        patientView.resetForm();
                    } else if (result === "delete") {
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                        $("input[name=Id]").val("");
                        patientView.resetForm();
                    }
                },
                Cancel: function () {
                    patientView.resetForm();
                },
                firstToUpperCase: function (str) {
                    return str.substr(0, 1).toUpperCase() + str.substr(1);
                },
                resetForm: function () {
                    if ($("input[name=Id]").val() === "") {
                        var allinput = $("input");
                        $("input[name=Code]").prop("readOnly", false);
                        $("div[class=form-body]").find(allinput).val("");
                        $("div[class=form-body]").find("select").val(1);
                        var date = new Date();
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear();
                        if (month < 10) month = "0" + month;
                        if (day < 10) day = "0" + day;
                        var today = day + "-" + month + "-" + year;
                        $("input[id=Birthday]").val(today);
                    } else {
                        patientView.viewListPatient(patientView.goBack);
                    }
                },
                fillTbody: function (data, result) {
                    $("tbody#tbodyPatientList").empty();
                    var row = "";
                    for (var i = 0; i < data["listPatient"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listPatient"][i]["id"] + " onclick='patientView.viewListPatient(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listPatient"][i]["code"] + "</td>";
                        tr += "<td>" + data["listPatient"][i]["fullName"] + "</td>";
                        if (data["listPatient"][i]["sex"] === 1) {
                            tr += "<td>Nam</td>";
                        } else if (data["listPatient"][i]["sex"] === 2) {
                            tr += "<td>Nữ</td>";
                        }
                        tr += "<td>" + data["listPatient"][i]["phone"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyPatientList").append(row);
                    patientView.idPatient = null;
                    patientView.addNewPatient(result);
                },
                deletePatient: function () {
                    if(idPatient==null) {
                        $("div#modalContent").empty().append("Vui lòng chọn bệnh nhân để xoá");
                        $("button[name=modalAgree]").hide();
                        $("div#modalConfirm").modal("show");
                    }else{
                        $("div#modalContent").empty().append("Chắc chắn xoá ?");
                        $("button[name=modalAgree]").show();
                        $("div#modalConfirm").modal("show");
                    }
                },
                viewListPatient: function (element) {
                    $("input[name=Code]").prop("readOnly", true);
                    patientView.goBack = element;
                    idPatient = $(element).attr("id");
                    patientView.idPatient = $(element).attr("id");
                    $("tbody#tbodyPatientList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewPatient", {
                        _token: _token,
                        idPatient: patientView.idPatient
                    }, function (data) {
                        $("input[name=Id]").empty().val(patientView.idPatient)
                        for (var propertyName in data) {

                            $("select[id=" + patientView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("input[id=" + patientView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                modalAgree: function () {
                    if (idPatient !== null) {
                        $.post(url + "admin/deletePatient", {
                            _token: _token,
                            idPatient: idPatient
                        }, function (data) {
                            if (data[0] === 1) {
                                idPatient=null;
                                patientView.fillTbody(data, 'delete');
                            }
                        });
                    }
                    else {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Vui lòng chọn bệnh nhân cần xoá");
                        $("button[name=modalAgree]").hide();
                    }
                },
                birthday: function () {
                    $.get(url + "admin/getdate", {
                        _token: _token,
                    }, function (data) {
                        var datenow = data[0]["NOW()"].slice(0, 4);
                        var date = $("input[name=Birthday]").val().slice(0, 4);

                        var now = datenow - date;
                        console.log(now);
                        if (now < 1) {
                            $("select[name=AgeId]").val(1);
                        } else if (now >= 1 && now < 6) {
                            $("select[name=AgeId]").val(2);
                        } else if (now >= 6 && now < 11) {
                            $("select[name=AgeId]").val(3);
                        } else if (now >= 11 && now < 16) {
                            $("select[name=AgeId]").val(4);
                        } else if (now >= 16 && now < 21) {
                            $("select[name=AgeId]").val(5);
                        } else if (now >= 21 && now < 26) {
                            $("select[name=AgeId]").val(6);
                        } else if (now >= 26 && now < 31) {
                            $("select[name=AgeId]").val(7);
                        } else if (now >= 31 && now < 36) {
                            $("select[name=AgeId]").val(8);
                        } else if (now >= 36 && now < 41) {
                            $("select[name=AgeId]").val(9);
                        } else if (now >= 41 && now < 46) {
                            $("select[name=AgeId]").val(10);
                        } else if (now >= 46 && now < 51) {
                            $("select[name=AgeId]").val(11);
                        } else if (now >= 51 && now < 56) {
                            $("select[name=AgeId]").val(12);
                        } else if (now >= 56 && now < 61) {
                            $("select[name=AgeId]").val(13);
                        } else if (now >= 61 && now < 66) {
                            $("select[name=AgeId]").val(14);
                        } else if (now >= 66 && now < 71) {
                            $("select[name=AgeId]").val(15);
                        } else if (now >= 71 && now < 76) {
                            $("select[name=AgeId]").val(16);
                        } else if (now >= 76 && now < 81) {
                            $("select[name=AgeId]").val(17);
                        } else if (now >= 81 && now < 86) {
                            $("select[name=AgeId]").val(18);
                        } else if (now >= 86 && now < 91) {
                            $("select[name=AgeId]").val(19);
                        } else if (now >= 91 && now < 96) {
                            $("select[name=AgeId]").val(20);
                        } else if (now >= 96 && now < 100) {
                            $("select[name=AgeId]").val(21);
                        }
                    });
                },
                addNewAndUpdatePatient: function () {
                    patientView.resetPatientObject();
                    for (var i = 0; i < Object.keys(patientView.PatientObject).length; i++) {
                        patientView.PatientObject[Object.keys(patientView.PatientObject)[i]] = $("#" + Object.keys(patientView.PatientObject)[i]).val();
                    }
                    $("#formPatient").validate({
                        rules: {
                            Code: "required",
                            FullName: "required",
                            Address: "required",
                            Phone: "required"
                        },
                        messages: {
                            Code: "Mã bệnh nhân không được rỗng",
                            FullName: "Tên bệnh nhân không được rỗng",
                            Address: "Địa chỉ bệnh nhân không được rỗng",
                            Phone: "Số điện thoại bệnh nhân không được rỗng"
                        }
                    });
                    if ($("#formPatient").valid()) {
                        $.post(url + "admin/addNewAndUpdatePatient", {
                            _token: _token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataPatient: patientView.PatientObject
                        }, function (data) {
                            if (data[0] === 1) {
                                idPatient = null;
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                patientView.fillTbody(data, '');
                            } else if (data[0] === 2) {
                                idPatient = null;
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                patientView.fillTbody(data, '');
                            } else if (data[0] === 0) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa KHÔNG thành công");
                                $("button[name=modalAgree]").hide();
                            }
                            else {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới KHÔNG thành công");
                                $("button[name=modalAgree]").hide();
                            }
                        })
                    }

                }
            }
        }
    })
</script>