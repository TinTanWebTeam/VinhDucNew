{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Chắc chắn xoá ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Đóng</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="medicalrecordView.modalAgree()">Tiếp tục
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
            <h4 style="color: #00a859">Hồ sơ bệnh án</h4>
            <hr style="margin-top: 0px;">
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Hồ sơ bệnh án
                        <div class="input-group custom-search-form pull-right" style="width: 50%;margin-top: -1%;">
                            <input type="text" class="form-control" placeholder="Search..." name = "searchMedicalRecordViewByCodePatient">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button" onclick="medicalrecordView.searchMedicalRecordViewByCodePatient()">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="height: 480px; overflow: scroll">
                    <table class="table table-bordered table-hover order-column col-md-6" id="tablePatientList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Mã bệnh nhân</th>
                            <th>Bệnh nhân</th>
                            <th>Lý do vào viện</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyMedicalRecordList">
                        @if($medicals)
                            @foreach($medicals as $item)
                                <tr id="{{$item->id}}" onclick="medicalrecordView.viewListPatient(this)"
                                    style="cursor: pointer">
                                    <td>{{\App\PatientManagement::where('id',$item->patientId)->first()->code}}</td>
                                    <td>{{\App\PatientManagement::where('id',$item->patientId)->first()->fullName}}</td>
                                    <td>{{$item->reasons}}</td>
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
                                onclick="medicalrecordView.addNewMedicalRecord('')"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div style="height: 480px; overflow: scroll">
                    <div class="portlet-body form">
                        <form role="form" id="formPatient">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input " style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="PatientId"><b>Bệnh nhân</b></label>
                                        <select class="form-control" id="PatientId" name="PatientId">
                                            @if($patients)
                                                @foreach($patients as $item)
                                                    <option value="{{$item->id}}">{{$item->fullName}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <label for="Reasons"><b>Lý do vào viện</b></label>
                                        <textarea type="text" class="form-control"
                                                  id="Reasons"
                                                  name="Reasons"
                                                  style="resize:none"
                                                  rows="3"
                                                  placeholder="Đau lưng"></textarea>
                                    </div>
                                    <div class="form-group form-md-line-input col-md-6 row">
                                        <label for="MedicalHistory"><b>Bệnh sử:</b></label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input ">
                                            <label for="PathologicalProcess"><b style="font-weight: normal;">Quá trình
                                                    bệnh lý</b></label>
                                        <textarea type="text" class="form-control"
                                                  id="PathologicalProcess"
                                                  name="PathologicalProcess"
                                                  style="resize:none"
                                                  rows="3"
                                                  cols="3"
                                                  placeholder="Đau cột sống"></textarea>
                                        </div>
                                        <div class="form-group form-md-line-input ">
                                            <label for="Anamnesis"><b style="font-weight: normal;">Tiền sử
                                                    bệnh</b></label>
                                        <textarea type="text" class="form-control"
                                                  id="Anamnesis"
                                                  name="Anamnesis"
                                                  style="resize:none"
                                                  rows="3"
                                                  cols="3"
                                                  placeholder="Đau cột sống"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input col-md-6 row">
                                        <label for="Examination"><b>Khám bệnh:</b></label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input ">
                                            <label for="Body"><b style="font-weight: normal;">Toàn thân</b></label>
                                        <textarea type="text" class="form-control"
                                                  id="Body"
                                                  name="Body"
                                                  style="resize:none"
                                                  rows="3"
                                                  cols="3"
                                                  placeholder="Đau cột sống"></textarea>
                                        </div>
                                        <div class="form-group form-md-line-input ">
                                            <label for="Parts"><b style="font-weight: normal;">Các bộ phận</b></label>
                                        <textarea type="text" class="form-control"
                                                  id="Parts"
                                                  name="Parts"
                                                  style="resize:none"
                                                  rows="3"
                                                  cols="3"
                                                  placeholder="Đau cột sống"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <label for="Subclinical"><b>Cận lâm sàn</b></label>
                                        <textarea type="text" class="form-control"
                                                  id="Subclinical"
                                                  name="Subclinical"
                                                  style="resize:none"
                                                  rows="3"
                                                  cols="3"
                                                  placeholder="Đau lưng"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions noborder">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="medicalrecordView.addNewAndUpdateMedicalRecord()">
                                        Hoàn tất
                                    </button>
                                    <button type="button" class="btn default" onclick="medicalrecordView.Cancel()">
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
    $(function () {
        idPatient = null;
        if (typeof (medicalrecordView) == 'undefined') {
            medicalrecordView = {
                goBack: null,
                PatientId: null,
                MedicalRecordObject: {
                    Id: null,
                    PatientId: null,
                    Reasons: null,
                    PathologicalProcess: null,
                    Anamnesis: null,
                    Body: null,
                    Parts: null,
                    Temperature: null,
                    BloodPressure: null,
                    Breathing: null,
                    Weight: null,
                    Height: null,
                    Subclinical: null,
                },
                resetMedicalRecordObject: function () {
                    for (var propertyName in medicalrecordView.MedicalRecordObject) {
                        if (medicalrecordView.MedicalRecordObject.hasOwnProperty(propertyName)) {
                            medicalrecordView.MedicalRecordObject.propertyName = null;
                        }
                    }
                },
                Cancel: function () {
                    medicalrecordView.resetForm();
                },
                firstToUpperCase: function (str) {
                    return str.substr(0, 1).toUpperCase() + str.substr(1);
                },
                addNewMedicalRecord: function () {
                    $("input[name=Id]").val("");
                    medicalrecordView.resetForm();
                },
                resetForm: function () {
                    if ($("input[name=Id]").val() === "") {
                        var allinput = $("input");
                        var alltextarea = $("textarea");
                        $("div[class=form-body]").find(allinput).val("");
                        $("div[class=form-body]").find(alltextarea).val("");
                    } else {
                        medicalrecordView.viewListPatient(medicalrecordView.goBack);
                    }
                },
                viewListMedicalRecord: function (element) {
                    medicalrecordView.goBack = element;
                    idPatient = $(element).attr("id");
                    medicalrecordView.PatientId = $(element).attr("id");
                    $("tbody#tbodyLocationList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewLocation", {
                        _token: _token,
                        PatientId: medicalrecordView.PatientId
                    }, function (data) {
                        $("input[name=Id]").empty().val(medicalrecordView.PatientId)
                        for (var propertyName in data) {
                            $("input[id=" + medicalrecordView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("textarea[id=" + medicalrecordView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    });
                },
                setValueObject: function () {
                    medicalrecordView.resetMedicalRecordObject();
                    for (var i = 0; i < Object.keys(medicalrecordView.MedicalRecordObject).length; i++) {
                        medicalrecordView.MedicalRecordObject[Object.keys(medicalrecordView.MedicalRecordObject)[i]] = $("#" + Object.keys(medicalrecordView.MedicalRecordObject)[i]).val();
                    }
                },
                addNewAndUpdateMedicalRecord: function () {
                    medicalrecordView.setValueObject();
                    $.post(url + "admin/addNewAndUpdateMedicalRecord", {
                        _token: _token,
                        data: medicalrecordView.MedicalRecordObject
                    }, function (data) {
                        if (data === "1") {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Thêm mới thành công");
                            $("button[name=modalAgree]").hide();
                            medicalrecordView.loadMedicalRecord();
                        } else if (data === "2") {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Chỉnh sửa thành công");
                            $("button[name=modalAgree]").hide();
                            medicalrecordView.loadMedicalRecord();
                        } else if (data === "0") {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Chỉnh sửa KHÔNG thành công");
                            $("button[name=modalAgree]").hide();
                        } else {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Thêm mới KHÔNG thành công");
                            $("button[name=modalAgree]").hide();
                        }
                    })
                },
                loadMedicalRecord: function () {
                    $.post(url + "admin/getMedicalRecord", {
                        _token: _token,
                    }, function (data) {
                        medicalrecordView.fillTbody(data);
                    })
                },
                viewListPatient: function (element) {
                    medicalrecordView.goBack = element;
                    $("input[name=Id]").empty().val($(element).attr("id"));
                    $.post(url + "admin/getMedicalRecordOnly", {
                        _token: _token,
                        id: $(element).attr("id")
                    }, function (data) {

                        for (var propertyName in data) {
                            $("select[id=" + medicalrecordView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("input[id=" + medicalrecordView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("textarea[id=" + medicalrecordView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                fillTbody: function (data) {
                    $("tbody#tbodyMedicalRecordList").empty();
                    var row = "";
                    for (var i = 0; i < data.length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data[i]["id"] + " onclick='medicalrecordView.viewListPatient(this)' style='cursor: pointer'>";
                        tr += "<td>" + data[i]["code"] + "</td>";
                        tr += "<td>" + data[i]["name"] + "</td>";
                        tr += "<td>" + data[i]["reasons"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyMedicalRecordList").append(row);
                    medicalrecordView.addNewMedicalRecord();
                    //medicalrecordView.addNewPatient(result);
                },
                searchMedicalRecordViewByCodePatient:function () {
                    $.post(url+"admin/searchMedicalRecordViewByCodePatient",{
                        _token:_token,
                        search:$("input[name=searchMedicalRecordViewByCodePatient]").val()
                    },function (data) {
                        medicalrecordView.fillTbody(data);
                    })
                }
            }

        }
    })
</script>