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
<div id="page-wrapper" name="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4 style="color: #00a859">Chẩn đoán</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-7">
            <div class="row" id="menuPackageTreatment">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div style="color: #00a859;font-size: 17px;">Danh sách gói điều trị
                            <button type="button" class="btn btn-danger btn-circle pull-right"
                                    onclick="diagnosticView.deleteTreatmentPackages()"><i class="fa fa-times"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-circle pull-right"
                                    onclick="diagnosticView.report()"><i
                                        class="fa fa-print"></i>
                            </button>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover order-column" id="tableDiagnosticList"
                               style="margin-bottom: 0px;">
                            <thead>
                            <tr>
                                <th>Bác sĩ</th>
                                <th>Chẩn đoán</th>
                                <th>Ngày tạo</th>
                                <th>Gói</th>
                                <th>Tình trạng</th>
                                <th>Thông tin</th>
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
                            <div style="color: #00a859;font-size: 17px;">Điều trị chuyên môn
                                <button type="button" class="btn btn-warning btn-circle pull-right"
                                        onclick="diagnosticView.deleteProTm()"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive" style="height: 200px;overflow: scroll;">
                            <table class="table table-hover order-column" id="PackagesTable"
                                   style="overflow: scroll;">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Vùng</th>
                                    <th>Thời gian</th>
                                    <th>Điều trị chuyên môn</th>
                                    <th>Vị trí điều trị</th>
                                    <th>Phút</th>
                                    <th>Bác sĩ</th>
                                    <th>Ngày tạo</th>
                                    <th>Bỏ chọn</th>
                                </tr>
                                </thead>
                                <tbody id="PackagesTable">

                                </tbody>
                            </table>
                        </div>
                        <form action="" id="addProfessional">
                            <div id="addProfessional">
                                <div class="form-group form-md-line-input col-md-12 col-lg-4">
                                    <label for="Sesame"><b>Vùng</b></label>
                                    <select class="form-control" name="Sesame" id="Sesame">
                                        @if($locations)
                                            @foreach($locations as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group form-md-line-input col-md-12 col-lg-4">
                                    <label for="Time"><b>Sáng/Chiều</b></label>
                                    <input type="text" class="form-control"
                                           id="Time"
                                           name="Time"
                                           placeholder="S/C">
                                </div>
                                <div class="form-group form-md-line-input col-md-12 col-lg-4">
                                    <label for="Professional"><b>Chuyên môn</b></label>
                                    <input type="text" class="form-control"
                                           id="Professional"
                                           name="Professional"
                                           placeholder="Siêu âm">
                                </div>
                                <div class="form-group form-md-line-input col-md-12 col-lg-4">
                                    <label for="Location"><b>Vị trí điều trị</b></label>
                                    <input type="text" class="form-control"
                                           id="Location"
                                           name="Location">
                                </div>
                                <div class="form-group form-md-line-input col-md-12 col-lg-4">
                                    <label for="Minute"><b>Phút</b></label>
                                    <input type="text" class="form-control"
                                           id="Minute"
                                           onkeypress="diagnosticView.enternumber()"
                                           name="Minute">
                                </div>
                                <div class="form-group form-md-line-input col-md-12 col-lg-4">
                                    <label for="DoctorCode"><b>Bác sĩ</b></label>
                                    <select class="form-control" name="DoctorCode" id="DoctorCode"
                                            onchange="diagnosticView.loadDetailByDoctor()">
                                        @if($doctors)
                                            @foreach($doctors as $item)
                                                <option value="{{$item->code}}">{{$item->code}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group form-md-line-input col-md-12 col-lg-6">
                                    <div class="form-group form-md-line-input col-md-12 col-lg-6">
                                        <label for="checkbox"><b>Tái khám</b></label>
                                        <input type="checkbox" class="form-control"
                                               style="height: 20px;width: 20px;"
                                               id="checkbox"
                                               onclick="diagnosticView.checked(this)"
                                               name="checkbox">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12 col-lg-6">
                                        <label for="Umpteenth"><b>Lần thứ: </b></label>
                                        <input type="text" class="form-control"
                                               id="Umpteenth"
                                               readonly
                                               name="Umpteenth">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="form-group noborder" style="margin-top: 50%; text-align: center;">
                            <button type="button" name="CompleteTreatmentPackage"
                                    onclick="diagnosticView.CompleteTreatmentPackage()"
                                    class="btn default">Thêm
                            </button>
                            <button type="button" name="cancelTreatment"
                                    onclick="diagnosticView.cancelTreatment(this)"
                                    class="btn default">Trở về
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5" id="seachPatient">
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
                                    <div class="">
                                        <div class="form-group form-md-line-input col-md-6">
                                            <label for="Sex"><b>Giới tính</b></label>
                                            <select class="form-control" name="Sex" id="Sex">
                                                <option value="1">Nam</option>
                                                <option value="2">Nữ</option>
                                            </select>
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
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="AddNewId" id="AddNewId">
                                    </div>
                                    {{--<div class="form-group form-md-line-input col-md-6">--}}
                                    {{--<label for="PackagesId"><b>Gói</b></label>--}}
                                    {{--<select class="form-control" id="PackagesId" name="PackagesId">--}}
                                    {{--@if($packages)--}}
                                    {{--@foreach($packages as $item)--}}
                                    {{--<option value="{{$item->id}}">{{$item->name}}</option>--}}
                                    {{--@endforeach--}}
                                    {{--@endif--}}
                                    {{--</select>--}}
                                    {{--</div>--}}
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="PatientId"><b>Bệnh nhân</b></label>
                                        <input type="text" class="form-control"
                                               id="PatientId"
                                               name="PatientId"
                                               placeholder="BN001">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12" style="display: none">
                                        <label for="TreatmentPackageCode"><b>Mã Phiếu</b></label>
                                        <input type="text" class="form-control"
                                               id="TreatmentPackageCode"
                                               name="TreatmentPackageCode"
                                               placeholder="BN001">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="CodeDoctor"><b>Mã bác sĩ</b></label>
                                        <input type="text" class="form-control"
                                               id="CodeDoctor"
                                               name="CodeDoctor"
                                               placeholder="BS001">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="Note"><b>Chẩn đoán</b></label>
                                        <textarea class="form-control"
                                                  id="Note"
                                                  style="resize: none;"
                                                  rows="5"
                                                  name="Note"
                                                  placeholder="chẩn đoán"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions noborder" name="buttonSearchPatient">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="diagnosticView.searchPatient(this)">
                                        Tìm kiếm
                                    </button>
                                </div>
                            </div>
                            <div class="form-actions noborder" name="buttonAddNewTreatmentPackages"
                                 style="display: none">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="diagnosticView.addNew(this)">
                                        Lưu
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
<div id="page-wrapper" name="report" style="display: none">
    <div class="row">
        <div class="col-lg-12">

            <button type="button" name="cancelReport" onclick="diagnosticView.cancelReport()"
                    class="btn default pull-right">Huỷ
            </button>
            <button type="button" id="printReport" style="background-color: #00a859;margin-right: 0.3%;"
                    onclick="diagnosticView.printReport()" class="btn default pull-right">In
            </button>
            <div class="form-group form-md-line-input pull-right col-md-12 col-lg-3">
                <select class="form-control" name="Date" id="Date"
                        onchange="diagnosticView.loadDateCreateProfessional()">
                    {{--@if($doctors)--}}
                    {{--@foreach($doctors as $item)--}}
                    {{--<option value="{{$item->code}}">{{$item->code}}</option>--}}
                    {{--@endforeach--}}
                    {{--@endif--}}
                </select>
            </div>
            {{--<label for="Date" class="pull-right"><b>Ngày</b></label>--}}
            <h4 style="color: #00a859">Report</h4>

            <hr style="margin-top: 0px;color: #00a859">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="report">
            <div style="width: 95%;margin: 0 auto">
                <div class="row" style="text-align: center; font-family: 'Times New Roman'">
                    <h4><b>HỒ SƠ BỆNH ÁN VẬT LÝ TRỊ LIỆU</b></h4>
                </div>
                <div class="row" style="font-family: 'Times New Roman'">
                    <div class="col-md-6 pull-right ">
                        {{--<span>Mã BS:</span>--}}
                        {{--<span name="CodeDoctor"></span>--}}
                        <span><br>Mã BN:</span>
                        <span name="CodePatient"></span>
                    </div>

                </div>
                <div style="font-family: 'Times New Roman'">
                    <div class="row col-md-12">
                        <h4><b>I-HÀNH CHÍNH</b></h4>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-12 col-sm-12">
                                    <span>1. Họ và tên:</span>
                                    <span name="FullName"></span>

                                <span class="pull-right">Giới tính:
                                <span name="Sex"></span>
                            </span>


                             <span style="margin-left: 12%;">Năm sinh:
                                <span name="Birthday"></span>
                            </span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-12 col-sm-12">
                                    <span>2. Nghề nghiệp:</span>
                                    <span name="Job"></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-6 col-sm-6">
                                    <span>3. Địa chỉ:</span>
                                    <span name="Address"></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-6 col-sm-6">
                                    <span>4. Huyết áp:</span>
                                    <span name="BloodPressure"></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-6 col-sm-6">
                                    <span>5. Mạch:</span>
                                    <span name="Pulse"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <h4><b>II-BỆNH SỬ</b></h4>
                        <div class="col-md-12">
                            <span>1. Quá trình bệnh lý:</span>
                            <span name="PathologicalProcess"></span>
                        </div>
                        <div class="col-md-12">
                            <span>2. Tiền sử bệnh:</span>
                            <span name="Anamnesis"></span>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <h4><b>III-CẬN LÂM SÀNG:</b></h4>
                        <span name="Subclinical"></span>
                    </div>
                    <div class="row col-md-12">
                        <h4><b>IV-CHẨN ĐOÁN:</b></h4>
                        <span name="Diagnose"></span>
                    </div>
                    <div class="row col-md-12">
                        <h4><b>V-PHÁC ĐỒ:</b></h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover order-column" id="tableRegimen"
                                   style="margin-bottom: 0px;">
                                <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Vùng</th>
                                    <th class="text-center">Thời gian</th>
                                    <th class="text-center">Điều trị chuyên môn</th>
                                    <th class="text-center">Vị trí điều trị</th>
                                    <th class="text-center">Phút</th>
                                    <th class="text-center">Bác sĩ</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th class="text-center">Gói</th>
                                </tr>
                                </thead>
                                <tbody id="tbodyRegimen">
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    $(function () {
        deleteTreatmentPackage = null;
        if (typeof (diagnosticView) === 'undefined') {
            //setup before functions

            diagnosticView = {
                dataPatient: null,
                dataPackage: null,
                dataRegimen: null,
                goBack: null,
                checkPackagesId:null,
                idTreatmentPackage: null,
                idDiagnostic: null,
                data: null,
                count: null,
                DiagnosticObject: {
                    Id: null,
                    Umpteenth: null,
                    CodeDoctor: null,
                    Code: null,
                    FullName: null,
                    Birthday: null,
                    Sex: null,
                    AddNewId: null,
                    PackagesId: null,
                    PatientId: null,
                    TreatmentPackageCode: null,
                    Note: null,
                    Location: null,
                    Professional: null,
                    Sesame: null,
                    Minute: null,

                    Time: null,
                    DoctorCode: null,
                    CodeDoctor: null,
                    CodePatient: null,
                    FullName: null,
                    Birthday: null,
                    Sex: null,
                    Job: null,
                    Phone: null,
                    Address: null,
                    BloodPressure: null,
                    Pulse: null,
                    PathologicalProcess: null,
                    Anamnesis: null,
                    Subclinical: null,
                    Diagnose: null,
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
                        $("div#modalConfirm").modal("show");
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

                    $("input[name=Code]").val("");
                    $("input[name=FullName]").val("");
                    $("input[name=Id]").val("");
                    $("input[name=Sex]").val("");
                    $("input[name=Birthday]").val("");
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
                        $("div#addProfessional").find(allinput).val("");

                    } else {
                    }
                },
                checked: function (element) {
                    var number = Number($("input[name=Umpteenth]").val());
                    if ($(element).prop("checked") === true) {
                        number += 1;
                        $("input[name=Umpteenth]").val(number);
                    } else {

                        $("input[name=Umpteenth]").empty().val(number - 1);
                    }
                },
                fillTbody: function (data, IdPatient) {

                    $("tbody#tbodyDiagnosticList").empty();
                    var row = "";

                    for (var i = 0; i < data[0].length; i++) {
                        var tr = "";
                        if (data[0][i]["active"] === 0) {
                            tr += "<tr id=" + data[0][i]["id"] + " data-note='" + data[0][i]["note"] + "' data-code='" + data[0][i]["code"] + "' data-patientId='" + IdPatient + "' data-packageId='" + data[0][i]["packageId"] + "' onclick='diagnosticView.getIdPackage(this)' ondblclick='diagnosticView.updateTreatmentPackage(this)' style='cursor: pointer;background-color: #e6e4e4'>";
                        } else {
                            tr += "<tr id=" + data[0][i]["id"] + " style='cursor: pointer' data-note='" + data[0][i]["packagesNote"] + "' data-codeDoctor='" + data[0][i]["codeDoctor"] + "' data-code='" + data[0][i]["code"] + "' data-patientId='" + IdPatient + "' data-packageId='" + data[0][i]["packageId"] + "' onclick='diagnosticView.getIdPackage(this)' ondblclick='diagnosticView.updateTreatmentPackage(this)'>";
                        }

                        tr += "<td>" + data[0][i]["codeDoctor"] + "</td>";
                        tr += "<td>" + data[0][i]["packagesNote"] + "</td>";
                        tr += "<td>" + data[0][i]["createdDate"] + "</td>";
                        tr += "<td><select class='form-control' id='PackagesId' name='PackagesId' idTreatmentPackage='" + data[0][i]["id"] + "' onchange='diagnosticView.updatePackageForTreatmentPackage(this)' style='min-width: 100px;'><option value='0'></option>";
                        for (var j = 0; j < data[1].length; j++) {
                            if (data[0][i]["packageId"] !== 0 && data[1][j]["id"] === data[0][i]["packageId"]) {
                                tr += "<option value='" + data[1][j]["id"] + "' selected='true'>" + data[1][j]["name"] + "</option>";
                            } else {
                                tr += "<option value='" + data[1][j]["id"] + "'>" + data[1][j]["name"] + "</option>";
                            }
                        }
                        tr += "</select></td>";
                        if (data[0][i]["status"] === 0) {
                            tr += "<td></td>";
                        } else if (data[0][i]["status"] === 1) {
                            tr += "<td>Giảm</td>";
                        } else if (data[0][i]["status"] === 2) {
                            tr += "<td>Không giảm</td>";
                        } else if (data[0][i]["status"] === 3) {
                            tr += "<td>Đau hơn</td>";
                        }
                        tr += "<td>" + data[0][i]["regimensNote"] + "</td>";
                        tr += "<td style='min-width: 100px;'><button  type='button' style='margin-left: 20%; background-color: #999999; border-color: #999999' class='btn btn-info btn-circle' data-active='" + data[0][i]["active"] + "' data-date='" + data[0][i]["createdDate"] + "' data-Id='" + data[0][i]["id"] + "' data-umpteenth='" + data[0][i]["umpteenth"] + "' onclick='diagnosticView.fillUpdateToTable(this,String(\"\"))' ><i class='fa fa-cog' ></i></button></td>";//<button type='button' style='margin-left: 5%;border-color: rgb(212, 0, 0);background-color: rgb(212, 0, 0);' class='btn btn-info btn-circle' data-Id='" + data[i]["id"] + "' onclick='diagnosticView.deleteTreatmentPackages(this)'><i class='fa fa-times' ></i></button>
                        row += tr;
                    }
                    $("tbody#tbodyDiagnosticList"
                    ).append(row);
                    diagnosticView.idDiagnostic = null;
                    //diagnosticView.addNewDiagnostic(result);
                },
                updatePackageForTreatmentPackage: function (element) {
                    $.post(url + "admin/updatePackageForTreatmentPackage", {
                        _token: _token,
                        idTreatmentPackage: $(element).attr("idTreatmentPackage"),
                        idPackage: $(element).val()
                    }, function (data) {
                    })
                },
                getIdPackage: function (element) {
                    $("tbody#tbodyDiagnosticList").find("tr").css("background-color", "#ffffff").css("color", "#000000");;
                    $("tbody#tbodyDiagnosticList").find("tr[id=" + $(element).attr("id") + "]").css("background-color", "#00a859").css("color", "#ffffff");
                    diagnosticView.dataRegimen = $(element).attr("id");
                    deleteTreatmentPackage = $(element).attr("id");
                    diagnosticView.checkPackagesId = $(element).find("td").find("select").val();
                }
                ,
                updateTreatmentPackage: function (element) {
                    $("input[name=PatientId]").val($(element).attr("data-patientId"));
                    $("input[name=AddNewId]").val($(element).attr("id"));
                    //$("select[name=PackagesId]").val($(element).attr("data-packageId"));
                    $("input[name=CodeDoctor]").val($(element).attr("data-codeDoctor"));
                    $("input[name=TreatmentPackageCode]").val($(element).attr("data-code"));
                    $("textarea[name=Note]").val($(element).attr("data-note"));
                    diagnosticView.idTreatmentPackage = $(element).attr("data-packageId");
                    diagnosticView.addNewTreatmentPackages();
                }
                ,
                setValueObject: function () {
                    diagnosticView.resetDiagnosticObject();
                    for (var i = 0; i < Object.keys(diagnosticView.DiagnosticObject).length; i++) {
                        diagnosticView.DiagnosticObject[Object.keys(diagnosticView.DiagnosticObject)[i]] = $("#" + Object.keys(diagnosticView.DiagnosticObject)[i]).val();
                    }
                }
                ,
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
                                if (data[i]["sex"] === 1) {
                                    tr += "<td>Nam</td>";
                                } else {
                                    tr += "<td>Nữ</td>";
                                }
                                tr += "<td>" + data[i]["birthday"] + "</td>";
                                tr += "<td <button type='button' style='margin-left: 30%;' class='btn btn-info btn-circle' data-code='" + data[i]["code"] + "' data-Id='" + data[i]["id"] + "' onclick='diagnosticView.fillToInput(this)'><i class='fa fa-check '></i></button></td>";
                                tr += "</tr>";
                                row += tr;
                            }
                            $("tbody#AutoCompleteTableBody").empty().append(row);
                            $("div#Table").show();
                            //$("div#Table").css("left", position.left).css("top", (position.top - 235));
                        } else {
                            $("div#modalConfirm").modal("show");
                            $("button[name=modalAgree]").hide();
                            $("div#modalContent").empty().append("Không tìm thấy thông tin bệnh nhân");
                        }

                    });
                }
                ,
                fillToInput: function (element) {
                    var a = $("tbody[id=AutoCompleteTableBody]").find("tr[id=" + $(element).attr("data-Id") + "]");
                    diagnosticView.dataPatient = $(element).attr("data-code");
                    $("div#Table").hide();
                    $("input[name=Id]").val($(element).attr("data-Id"));
                    $("input[name=Code]").val(a.find("td").eq(0).text());
                    $("input[name=FullName]").val(a.find("td").eq(1).text());
                    $("input[name=Sex]").val(a.find("td").eq(2).text());
                    $("input[name=Birthday]").val(a.find("td").eq(3).text());
                    diagnosticView.SearchTreatmentPackages($(element).attr("data-code"));
                }
                ,
                SearchTreatmentPackages: function (element) {
                    $.post(url + "admin/SearchTreatmentPackages", {
                        _token: _token,
                        IdPatient: element
                    }, function (data) {
                        diagnosticView.dataPackage = data;
                        diagnosticView.fillTbody(data, element)
                    })
                }
                ,
                fillUpdateToTable: function (element, result, umpteenth) {
                    var check = true;
                    var d = new Date();
                    var year = d.getFullYear();
                    var month = d.getMonth() + 1;
                    var date = d.getDate();
                    if (month < 10) month = "0" + month;
                    if (date < 10) date = "0" + date;
                    var strDate = year + "-" + month + "-" + date;

                    if (result !== "") {
                        $("div[id=addProfessional]").show();
                        $("button[name=CompleteTreatmentPackage]").show();
                        $("button[name=cancelTreatment]").text("Trở về");
                        diagnosticView.idTreatmentPackage = result;
                    } else {
                        diagnosticView.idTreatmentPackage = $(element).attr("data-Id");
                        $("div[id=addProfessional]").show();
                        $("button[name=CompleteTreatmentPackage]").show();
                        $("button[name=cancelTreatment]").text("Trở về");
                    }
                    $.post(url + "admin/searchProfessional", {
                        _token: _token,
                        idPackageTreatment: diagnosticView.idTreatmentPackage
                    }, function (data) {
                        if (data.length !== 0) {
                            var bs = data[0]["createdBy"];
                            $("select#DoctorCode").val(bs);
                            diagnosticView.data = data;
                            if (data.length !== 0) {
                                var row = "";
                                var stt = 1;
                                $("tbody#PackagesTable").empty();
                                for (var i = 0; i < data.length; i++) {
                                    var tr = "";
                                    tr += "<tr id=" + data[i]["detailId"] + ">";
                                    tr += "<td>" + stt + "</td>";
                                    tr += "<td>" + data[i]["locationName"] + "</td>";
                                    tr += "<td>" + data[i]["time"] + "</td>";
                                    tr += "<td>" + data[i]["professional"] + "</td>";
                                    tr += "<td>" + data[i]["detailLocation"] + "</td>";
                                    tr += "<td>" + data[i]["minute"] + "</td>";
                                    tr += "<td>" + data[i]["createdBy"] + "</td>";
                                    tr += "<td>" + data[i]["createdDate"] + "</td>";
                                    if (check === true) {
                                        tr += "<td <button type='button' style='margin-left: 30%;margin-top: 2%;' class='btn btn-danger btn-circle' data-Id='" + data[i]["detailId"] + "' onclick='diagnosticView.deleteTable(this)'><i class='fa fa-times '></i></button></td>";
                                    } else {
                                    }
                                    tr += "</tr>";
                                    row += tr;
                                    stt++;
                                }
                                $("tbody#PackagesTable").append(row);
//                            diagnosticView.resetForm();
                                if (diagnosticView.count !== null) {
                                    if (typeof(umpteenth) === 'undefined') {
                                        $("input[name=Umpteenth]").val(diagnosticView.count);
                                    } else {
                                        diagnosticView.count = umpteenth;
                                        $("input[name=Umpteenth]").val(diagnosticView.count);
                                    }
                                } else if (diagnosticView.count === null) {
                                    $("input[name=Umpteenth]").val($(element).attr("data-umpteenth"));
                                }
                                //$(element).attr("data-umpteenth", null);
                            } else {
                                $("tbody#PackagesTable").empty();
                            }
                        } else {
                            $("tbody#PackagesTable").empty();
                        }
                    });
                    $("div#TablePackages").show();
                    $("div#menuPackageTreatment").hide();
                }
                ,
                fillAddNewToTable: function () {
                    $("tbody#PackagesTable").children().children().css("background-color", "white").css('color', '#555555');
                    $("tbody#PackagesTable").children().children().find("input").removeAttr("checked");
                    $("div#TablePackages").show();
                    $("div#menuPackageTreatment").hide();

                }
                ,
                deleteTreatmentPackages: function (element) {
                    if (deleteTreatmentPackage === null) {
                        $("div#modalConfirm").modal("show");
                        $("button[name=modalAgree]").hide();
                        $("div#modalContent").empty().append("Vui lòng chọn phiếu cần xoá");
                    } else {
                        $("div#modalConfirm").modal("show");
                        $("button[name=modalAgree]").show();
                        $("div#modalContent").empty().append("Xoá phiếu điều trị ?");

                    }


                }
                ,
                modalAgree: function () {
                    $.post(url + "admin/deleteTreatmentPackage", {
                        _token: _token,
                        id: deleteTreatmentPackage
                    }, function (data) {
                        if (data === "1") {
                            diagnosticView.SearchTreatmentPackages($("input[name=Code]").val());
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Xoá thành công");
                            $("button[name=modalAgree]").hide();
                            deleteTreatmentPackage = null;
                        } else {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Phiếu đã được xoá");
                            $("button[name=modalAgree]").hide();
                        }
                    })
                }
                ,
                cancelTreatment: function () {
                    if ($("button[name=cancelTreatment]").text() === "Trở về") {
                        $("div#TablePackages").hide();
                        $("div#menuPackageTreatment").show();
                        $("input[name=checkbox]").prop("checked", false);
                    }
                }
                ,
                CompleteTreatmentPackage: function () {
                    diagnosticView.count = $("input[name=Umpteenth]").val();
                    if ($("input[name=checkbox]").prop("checked") === true) {
                        diagnosticView.setValueObject();
                            $.post(url + "admin/updateUmpteenthTreatmentPackages", {
                            _token: _token,
                            idTreatmentPackage: diagnosticView.idTreatmentPackage,
                            data: diagnosticView.DiagnosticObject,
                            idPatient: $("input[name=Code]").val()
                        }, function (data) {
                            if (data[0] === 1) {
                                diagnosticView.fillUpdateToTable('', diagnosticView.idTreatmentPackage, diagnosticView.count);
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Lưu thành công");
                                $("button[name=modalAgree]").hide();
                            }
                        });
                    } else {
                        $("#addProfessional").validate({
                            rules: {
                                Professional: "required",
                                Location: "required",
                            },
                            messages: {
                                Professional: "Không được rỗng",
                                Location: "Không được rỗng",
                            }
                        });
                        if ($("#addProfessional").valid()) {
                            diagnosticView.setValueObject();
                            $.post(url + "admin/updateUmpteenthTreatmentPackages", {
                                _token: _token,
                                idTreatmentPackage: diagnosticView.idTreatmentPackage,
                                data: diagnosticView.DiagnosticObject,
                                idPatient: $("input[name=Code]").val()
                            }, function (data) {
                                if (data[0] === 1) {
                                    diagnosticView.fillUpdateToTable('', diagnosticView.idTreatmentPackage, data[1]["umpteenth"]);
                                    $("div#modalConfirm").modal("show");
                                    $("div#modalContent").empty().append("Lưu thành công");
                                    $("button[name=modalAgree]").hide();
                                }
                            });
                        } else {
                            $("form#addProfessional").find("label[class=error]").css("color", "red");
                        }
                    }

                }
                ,
                addNewTreatmentPackages: function () {
                    var d = new Date();
                    var year = d.getFullYear();
                    var month = d.getMonth() + 1;
                    var date = d.getDate();
                    if (month < 10) month = "0" + month;
                    if (date < 10) date = "0" + date;
                    var strDate = year + "" + month + "" + date;

                    var b = "PDT" + Math.floor((Math.random() * 1000) + 1) + strDate;
                    $("input[name=TreatmentPackageCode]").prop("readOnly", true);
                    $("input[name=TreatmentPackageCode]").val(b);

                    $("input[name=PatientId]").val($("input[name=Code]").val());
                    $("div[name=tableSearchPatient]").hide();
                    $("div[name=buttonSearchPatient]").hide();
                    $("div[name=tableAddNewTreatmentPackages]").show();
                    $("div[name=buttonAddNewTreatmentPackages]").show();
                    $("div[name=searchPatient]").hide();
                    $("div[name=addNewTreatment]").show();
                }
                ,
                addNew: function () {
                    diagnosticView.setValueObject();
                    $("#formDiagnostic").validate({
                        rules: {
                            TreatmentPackageCode: "required",
                            Doctor: "required"
                        },
                        messages: {
                            TreatmentPackageCode: "Mã phiếu không được rỗng",
                            Doctor: "Mã bác sĩ không được rỗng"
                        }
                    });
                    if ($("#formDiagnostic").valid()) {
                        $.post(url + "admin/addNewTreatment", {
                            _token: _token,
                            data: diagnosticView.DiagnosticObject,
                            idTreatmentPackage:diagnosticView.idTreatmentPackage
                        }, function (data) {
                            if (data === "1") {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm phiếu thành công");
                                $("button[name=modalAgree]").hide();

                                $("div[name=tableSearchPatient]").show();
                                $("div[name=buttonSearchPatient]").show();
                                $("div[name=tableAddNewTreatmentPackages]").hide();
                                $("div[name=buttonAddNewTreatmentPackages]").hide();
                                $("div[name=searchPatient]").show();
                                $("div[name=addNewTreatment]").hide();
                                diagnosticView.resetForm();
                            } else if (data === "2") {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Sửa phiếu thành công");
                                $("button[name=modalAgree]").hide();

                                $("div[name=tableSearchPatient]").show();
                                $("div[name=buttonSearchPatient]").show();
                                $("div[name=tableAddNewTreatmentPackages]").hide();
                                $("div[name=buttonAddNewTreatmentPackages]").hide();
                                $("div[name=searchPatient]").show();
                                $("div[name=addNewTreatment]").hide();
                                //$("tbody#tbodyDiagnosticList").empty();

                                diagnosticView.resetForm();
                            } else if (data === "0") {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Sửa phiếu KHÔNG thành công");
                                $("button[name=modalAgree]").hide();
                            } else {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm phiếu KHÔNG thành công");
                                $("button[name=modalAgree]").hide();
                            }
                        })
                    }
                }
                ,
                loadDetailByDoctor: function () {
                    diagnosticView.setValueObject();
                    $.post(url + "admin/loadDetailByDoctor", {
                        _token: _token,
                        data: diagnosticView.DiagnosticObject,
                        idPackageTreatment: diagnosticView.idTreatmentPackage
                    }, function (data) {
                        if (data[0].length !== 0) {
                            var row = "";
                            var stt = 1;
                            $("tbody#PackagesTable").empty();
                            for (var i = 0; i < data[0].length; i++) {
                                var tr = "";
                                tr += "<tr id=" + data[0][i]["detailId"] + ">";
                                tr += "<td>" + stt + "</td>";
                                tr += "<td>" + data[0][i]["locationName"] + "</td>";
                                tr += "<td>" + data[0][i]["time"] + "</td>";
                                tr += "<td>" + data[0][i]["professional"] + "</td>";
                                tr += "<td>" + data[0][i]["detailLocation"] + "</td>";
                                tr += "<td>" + data[0][i]["minute"] + "</td>";
                                tr += "<td>" + data[0][i]["createdBy"] + "</td>";
                                tr += "<td>" + data[0][i]["createdDate"] + "</td>";
                                if (data[0][i]["createdDate"] === data[1][0]["now"] && data[0][i]["createdBy"] === $("select#DoctorCode option:selected").text()) {
                                    tr += "<td <button type='button' style='margin-left: 30%;margin-top: 2%;' class='btn btn-danger btn-circle' data-Id='" + data[0][i]["detailId"] + "' onclick='diagnosticView.deleteTable(this)'><i class='fa fa-times '></i></button></td>";
                                } else {
                                }
                                tr += "</tr>";
                                row += tr;
                                stt++;
                            }
                            $("tbody#PackagesTable").append(row);

                        } else {
                            $("tbody#PackagesTable").empty();
                        }
                        ;
                    })
                }
                ,
                deleteProTm: function () {
                    $("tbody#PackagesTable").empty();
                }
                ,
                report: function () {
                    if(diagnosticView.checkPackagesId !== "0") {
                        if (diagnosticView.dataRegimen !== null) {
                            $.post(url + "admin/report", {
                                _token: _token,
                                dataPatient: diagnosticView.dataPatient,
                                idPackageTreatment: diagnosticView.dataRegimen
                            }, function (data) {
                                $("div[name=report]").show();
                                $("div[name=page-wrapper]").hide();
                                var value = 0;
                                var select = "";
                                $("select#Date").empty();
                                for (var propertyName in data[3]) {
                                    var option = "";
                                    option += "<option value='" + value + "'>Lần thứ: " + (data[3].length - value) + " Ngày: " + data[3][propertyName] + "</option>"
                                    select += option;
                                    value += 1;
                                }
                                select += "<option></option>"
                                $("select#Date").append(select);

                                for (var propertyName in data[0]) {
                                    $("span[name=" + diagnosticView.firstToUpperCase(propertyName) + "]").text(data[0][propertyName]);
                                    if (propertyName === "sex") {
                                        if (data[0][propertyName] === 1) {
                                            $("span[name=Sex]").text("Nam");
                                        } else {
                                            $("span[name=Sex]").text("Nữ");
                                        }
                                    } else if (propertyName === "code") {
                                        $("span[name=CodePatient]").text(data[0][propertyName]);
                                    }
                                }
                                for (var propertyName in data[1]) {
                                    $("span[name=" + diagnosticView.firstToUpperCase(propertyName) + "]").text(data[1][propertyName]);
                                }
                                if (data[2].length !== 0) {
                                    var row = "";
                                    var stt = 1;
                                    $("tbody#tbodyRegimen").empty();
                                    for (var i = 0; i < data[2].length; i++) {
                                        var tr = "";
                                        tr += "<tr id=" + data[2][i]["detailId"] + " style='text-align:center '>";
                                        tr += "<td>" + stt + "</td>";
                                        tr += "<td>" + data[2][i]["locationName"] + "</td>";
                                        tr += "<td>" + data[2][i]["time"] + "</td>";
                                        tr += "<td>" + data[2][i]["professional"] + "</td>";
                                        tr += "<td>" + data[2][i]["detailLocation"] + "</td>";
                                        tr += "<td>" + data[2][i]["minute"] + "</td>";
                                        tr += "<td>" + data[2][i]["createdBy"] + "</td>";
                                        tr += "<td>" + data[2][i]["createdDate"] + "</td>";
                                        tr += "<td>" + data[2][i]["packageName"] + "</td>";
                                        tr += "</tr>";
                                        row += tr;
                                        stt++;
                                    }
                                    $("tbody#tbodyRegimen").append(row);

                                } else {
                                    $("tbody#tbodyRegimen").empty();
                                };
                                if(data[4].lenght !== 0){
                                    $("span[name=Diagnose]").text(data[4]["note"]);

                                }
                            });
                            $("span[name=CodeDoctor]").text(diagnosticView.dataPackage[0]["codeDoctor"]);
                            $("span[name=Diagnose]").text(diagnosticView.dataPackage[0]["packagesNote"]);
                        } else {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Chưa chọn phiếu để in");
                            $("button[name=modalAgree]").hide();
                        }
                        diagnosticView.checkPackagesId = null;
                    }else{
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Chưa chọn gói cho phiếu điều trị");
                        $("button[name=modalAgree]").hide();
                    }
                },
                loadDateCreateProfessional: function () {
                    $.post(url + "admin/loadDateCreateProfessional", {
                        _token: _token,
                        idPackageTreatment: diagnosticView.dataRegimen,
                        date: $("select#Date option:selected").text().slice(17)
                    }, function (data) {
                        if (data.length !== 0) {
                            var row = "";
                            var stt = 1;
                            $("tbody#tbodyRegimen").empty();
                            for (var i = 0; i < data.length; i++) {
                                var tr = "";
                                tr += "<tr id=" + data[i]["detailId"] + " style='text-align:center '>";
                                tr += "<td>" + stt + "</td>";
                                tr += "<td>" + data[i]["locationName"] + "</td>";
                                tr += "<td>" + data[i]["time"] + "</td>";
                                tr += "<td>" + data[i]["professional"] + "</td>";
                                tr += "<td>" + data[i]["detailLocation"] + "</td>";
                                tr += "<td>" + data[i]["minute"] + "</td>";
                                tr += "<td>" + data[i]["createdBy"] + "</td>";
                                tr += "<td>" + data[i]["createdDate"] + "</td>";
                                tr += "<td>" + data[i]["packageName"] + "</td>";
                                tr += "</tr>";
                                row += tr;
                                stt++;
                            }
                            $("tbody#tbodyRegimen").append(row);

                        } else {
                            $("tbody#tbodyRegimen").empty();
                        }
                        ;
                    })
                }
                ,
                printReport: function () {
                    $(".report").printThis({
                        debug: false,
                        importCSS: true,
                        importStyle: false,
                        loadCSS: "bower_components/dist/css/bootstrap.min.css",
                        removeInline: false,
                        printDelay: 2000,
                        header: null,
                        formValues: true
                    });
                }
                ,
                cancelReport: function () {
                    $("div[name=report]").hide();
                    $("div[name=page-wrapper]").show();
                }
                ,
                deleteTable: function (element) {
                    $.post(url + "admin/deleteProfessional", {
                        _token: _token,
                        id: $(element).attr("data-Id")
                    }, function (data) {
                        if (data === "1") {
                            diagnosticView.fillUpdateToTable('', diagnosticView.idTreatmentPackage);
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Xoá thành công");
                            $("button[name=modalAgree]").hide();
                        } else {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Xoá KHÔNG thành công");
                            $("button[name=modalAgree]").hide();
                        }
                    })
                }
                ,
                enternumber: function () {
                    var keypressed = null;
                    if (window.event) {
                        keypressed = window.event.keyCode;
                    }
                    else {
                        keypressed = e.which;
                    }

                    if (keypressed <= 48 || keypressed >= 57) {
                        if (keypressed == 8 || keypressed == 127) {
                            return true;
                        }
                        return false;
                    }
                }

            }
        }

        //setup before functions
        var typingTimer;                //timer identifier
        var doneTypingInterval = 500;  //time in ms, 3 second for example
        var $inputProfessional = $("input#Professional");

        //on keyup, start the countdown
        $inputProfessional.on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTypingProfessional, doneTypingInterval);
        });

        //on keydown, clear the countdown
        $inputProfessional.on('keydown', function () {
            clearTimeout(typingTimer);
        });

        //user is "finished typing," do something
        function doneTypingProfessional() {
            $.get(url + 'admin/getSearchCodeProfessional', {
                _token: _token,
                Name: $inputProfessional.val()
            }, function (data) {
                if (data === "0") {
                    $("div#modalContent").empty().append("Không tìm thấy mã vừa nhập");
                    $("button[name=modalAgree]").hide();
                    $("input[name=Id]").val("");
                    $("div#modalConfirm").modal("show");
                    $inputProfessional.val("");
                } else if (data === "2") {
//                        $("div#modalContent").empty().append("Vui lòng nhập mã chính xác");
//                        $("button[name=modalAgree]").hide();
//                        $("input[name=Id]").val("");
//                        $("div#modalConfirm").modal("show");
                } else {
                    $inputProfessional.val(data[0]["name"]);
                }
            });
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

        //setup before functions
        var typingTimer;                //timer identifier
        var doneTypingInterval = 500;  //time in ms, 3 second for example
        var $inputPatient = $("input#PatientId");

        //on keyup, start the countdown
        $inputPatient.on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTypingPatient, doneTypingInterval);
        });

        //on keydown, clear the countdown
        $inputPatient.on('keydown', function () {
            clearTimeout(typingTimer);
        });

        //user is "finished typing," do something
        function doneTypingPatient() {
            $.get(url + 'admin/getSearchCodePatient', {
                _token: _token,
                Code: $inputPatient.val()
            }, function (data) {
                if (data === "0") {
                    $("div#modalContent").empty().append("Không tìm thấy mã vừa nhập");
                    $("button[name=modalAgree]").hide();
                    $("input[name=Id]").val("");
                    $("div#modalConfirm").modal("show");
                    $inputPatient.val("");
                } else if (data === "2") {
//                        $("div#modalContent").empty().append("Vui lòng nhập mã chính xác");
//                        $("button[name=modalAgree]").hide();
//                        $("input[name=Id]").val("");
//                        $("div#modalConfirm").modal("show");
                } else {
                    $inputPatient.val(data[0]["code"]);
                }
            });
        }

        //setup before functions
        var typingTimer;                //timer identifier
        var doneTypingInterval = 500;  //time in ms, 3 second for example
        var $input = $("input#CodeDoctor");

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
            $.get(url + 'admin/getSearchCodeDoctor', {
                _token: _token,
                Code: $input.val()
            }, function (data) {
                if (data === "0") {
                    $("div#modalContent").empty().append("Không tìm thấy mã vừa nhập");
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
    });
</script>