{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Chắc chắn xoá ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Đóng</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="doctorView.modalAgree()">Tiếp tục
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
            <h4 style="color: #00a859">Quản lý > Bác sĩ</h4>
            <hr style="margin-top: 0px;color: #00a859">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6" style="height: 500px; overflow: scroll">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Danh sách bác sĩ
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover order-column" id="tableDoctorList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Họ và tên</th>
                            <th>Giới tính</th>
                            <th>Số điện thoại</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyDoctorList">
                        @if($doctors)
                            @foreach($doctors as $item)
                                <tr id="{{$item->id}}" onclick="doctorView.viewListDoctor(this)"
                                    style="cursor: pointer">
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->name}}</td>
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
                                onclick="doctorView.addNewDoctor('')">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form" id="formDoctor">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input" style="display:none">
                                    <input type="text" class="form-control" name="Id" id="Id">
                                </div>
                                <div class="form-group form-md-line-input ">
                                    <label for="Code"><b>Mã</b></label>
                                    <input type="text" class="form-control"
                                           id="Code"
                                           name="Code"
                                           placeholder="BS001">
                                </div>

                                <div class="form-group form-md-line-input ">
                                    <label for="Name"><b>Họ và tên</b></label>
                                    <input type="text" class="form-control"
                                           id="Name"
                                           name="Name"
                                           placeholder="Nguyễn Văn A">
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label for="Sex"><b>Giới tính</b></label>
                                    <select class="form-control" name="Sex" id="Sex">
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                    </select>
                                </div>


                                <div class="form-group form-md-line-input ">
                                    <label for="Address"><b>Địa chỉ</b></label>
                                    <input type="text" class="form-control"
                                           id="Address"
                                           name="Address"
                                           onclick=""
                                           onchange=""
                                           placeholder="562/2A Lê Quang Định Gò Vấp">
                                    <label id="Email" style="display: none">Email đã tồn tại</label>
                                </div>
                                <div class="row">
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="ProvincialId"><b>Thành phố/ Tỉnh</b></label>
                                        <select class="form-control" id="ProvincialId">
                                            @if($provinces)
                                                @foreach($provinces as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="AgeId"><b>Độ tuổi</b></label>
                                        <select class="form-control" id="AgeId">
                                            @if($ages)
                                                @foreach($ages as $item)
                                                    <option value="{{$item->id}}">{{$item->age}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input ">
                                    <label for="Phone"><b>Số điện thoại</b></label>
                                    <input type="text" class="form-control"
                                           id="Phone"
                                           name="Phone"
                                           maxlength="15"
                                           placeholder="093266xxx">
                                </div>

                            </div>
                            <div class="form-actions noborder">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="doctorView.addNewAndUpdateDoctor()">
                                        Hoàn tất
                                    </button>
                                    <button type="button" class="btn default" onclick="doctorView.Cancel()">Huỷ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        Doctor = null;
        if (typeof (doctorView) === 'undefined') {
            doctorView = {
                checkDelete: false,
                goBack: null,
                idDoctor: null,
                DoctorObject: {
                    Id: null,
                    Code: null,
                    Name: null,
                    Address: null,
                    Phone: null,
                    Sex: null,
                    AgeId: null,
                    ProvincialId: null,
                },
                resetDoctorObject: function () {
                    for (var propertyName in doctorView.resetDoctorObject) {
                        if (doctorView.DoctorObject.hasOwnProperty(propertyName)) {
                            doctorView.DoctorObject.propertyName = null;
                        }
                    }
                },
                addNewDoctor: function (result) {
                    $("input[name=Code]").prop("readOnly", false);
                    if (result === "") {
                        $("input[name=Id]").val("");
                        doctorView.resetForm();
                    } else if (result === "delete") {
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                        $("input[name=Id]").val("");
                        doctorView.resetForm();
                    }
                },
                Cancel: function () {
                    doctorView.resetForm();
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
                        doctorView.viewListDoctor(doctorView.goBack);
                    }
                },
                fillTbody: function (data, result) {
                    $("tbody#tbodyDoctorList").empty();
                    var row = "";
                    for (var i = 0; i < data["listDoctor"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listDoctor"][i]["id"] + " onclick='doctorView.viewListDoctor(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listDoctor"][i]["code"] + "</td>";
                        tr += "<td>" + data["listDoctor"][i]["name"] + "</td>";
                        if (data["listDoctor"][i]["sex"] === 1) {
                            tr += "<td>Nam</td>";
                        } else if (data["listDoctor"][i]["sex"] === 2) {
                            tr += "<td>Nữ</td>";
                        }
                        tr += "<td>" + data["listDoctor"][i]["phone"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyDoctorList").append(row);
                    doctorView.idDoctor = null;
                    doctorView.addNewDoctor(result);
                },
                deleteDoctor: function () {
                    if (Doctor === null) {
                        $("div#modalContent").empty().append("Vui lòng chọn nhân viên để xoá");
                        $("button[name=modalAgree]").hide();
                        $("div#modalConfirm").modal("show");
                    } else {
                        $("div#modalContent").empty().append("Chắc chắn xoá");
                        $("button[name=modalAgree]").show();
                        $("div#modalConfirm").modal("show");
                    }

                },
                viewListDoctor: function (element) {
                    $("input[name=Code]").prop("readOnly", true);
                    doctorView.goBack = element;
                    doctor = $(element).attr("id");
                    doctorView.idDoctor = $(element).attr("id");
                    $("tbody#tbodyDoctorList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewDoctor", {
                        _token: _token,
                        idDoctor: doctorView.idDoctor
                    }, function (data) {
                        $("input[name=Id]").empty().val(doctorView.idDoctor)
                        for (var propertyName in data) {
                            $("select[id=" + doctorView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("input[id=" + doctorView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                modalAgree: function () {
                    if (Doctor !== null) {
                        $.post(url + "admin/deleteDoctor", {
                            _token: _token,
                            idDoctor: Doctor
                        }, function (data) {
                            if (data[0] === 1) {
                                Doctor = null;
                                doctorView.fillTbody(data, 'delete');
                            }
                        });
                    }
                    else {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Vui lòng chọn chuyên viên cần xoá");
                        $("button[name=modalAgree]").hide();
                    }
                },
                addNewAndUpdateDoctor: function () {
                    doctorView.resetDoctorObject();
                    for (var i = 0; i < Object.keys(doctorView.DoctorObject).length; i++) {
                        doctorView.DoctorObject[Object.keys(doctorView.DoctorObject)[i]] = $("#" + Object.keys(doctorView.DoctorObject)[i]).val();
                    }
                    $("#formDoctor").validate({
                        rules: {
                            Code: "required",
                            Name: "required",
                            Address: "required",
                            Phone: "required"
                        },
                        messages: {
                            Code: "Mã chuyên viên không được rỗng",
                            Name: "Tên chuyên viên không được rỗng",
                            Address: "Địa chỉ nhân viên không được rỗng",
                            Phone: "Số điện thoại chuyên viên không được rỗng"
                        }
                    });
                    if ($("#formDoctor").valid()) {
                        $.post(url + "admin/addNewAndUpdateDoctor", {
                            _token: _token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataDoctor: doctorView.DoctorObject
                        }, function (data) {
                            if (data[0] === 1) {
                                Doctor = null;
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                doctorView.fillTbody(data, '');
                            } else if (data[0] === 2) {
                                Doctor = null;
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                doctorView.fillTbody(data, '');
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
                    }else{
                        $("form#formDoctor").find("label[class=error]").css("color","red");
                    }
                }
            }
        }
    })
</script>