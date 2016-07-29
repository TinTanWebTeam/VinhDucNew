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
        <div class="col-md-6 col-sm-6">
            <div class="row" id="menuPackageTreatment">
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
                                        @foreach(array_chunk($professional->all(),4)as $rows)
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
                            <button type="button" class="btn blue"
                                    onclick="diagnosticView.CompleteTreatmentPackage(this)">
                                Hoàn tất
                            </button>
                            <button type="button" class="btn default">Huỷ</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6 col-sm-6" id="seachPatient">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Tìm kiếm bệnh nhân
                        <button type="button" class="btn btn-info btn-circle pull-right"
                                onclick="diagnosticView.addNewDiagnostic('')"><i
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
                                    <div class="row col-md-12" style="display:none" id="Table">
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
                            </div>
                            <div class="form-actions noborder">
                                <div class="form-group" style="padding-left: 15px;">
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
                    diagnosticView.resetForm();
                } else if (result === "delete") {
                    $("div#modalContent").empty().append("Xoá thành công");
                    $("button[name=modalAgree]").hide();
                    $("input[name=Id]").val("");
                    diagnosticView.resetForm();
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
            checked: function (element) {
                1
                if ($(element).prop("checked") !== true) {
                    $(element).parent().css("background-color", "white").css('color', '#555555');
                    $(element).removeAttr("checked");
                } else {
                    $(element).parent().css('background-color', '#00a859').css('color', '#fff');

                }
            },
            fillTbody: function (data, result) {
                $("tbody#tbodyDiagnosticList").empty();
                var row = "";
                for (var i = 0; i < data.length; i++) {
                    var tr = "";
                    tr += "<tr id=" + data[i]["id"] + " onclick='diagnosticView.delete(this)' style='cursor: pointer'>";
                    tr += "<td>" + data[i]["namePackage"] + "</td>";
                    tr += "<td>" + data[i]["note"] + "</td>";
                    tr += "<td>" + data[i]["createdDate"] + "</td>";
                    tr += "<td style='min-width: 100px;'><button type='button' style='margin-left: 20%;' class='btn btn-info btn-circle' data-Id='" + data[i]["id"] + "' onclick='diagnosticView.fillAddNewToTable(this)'><i class='fa fa-plus' ></i></button><button  type='button' style='margin-left: 5%; background-color: #999999; border-color: #999999' class='btn btn-info btn-circle' data-Id='" + data[i]["id"] + "' onclick='diagnosticView.fillUpdateToTable(this)'><i class='fa fa-cog' ></i></button><button type='button' style='margin-left: 5%;border-color: rgb(212, 0, 0);background-color: rgb(212, 0, 0);' class='btn btn-info btn-circle' data-Id='" + data[i]["id"] + "' onclick='diagnosticView.fillDeleteToTable(this)'><i class='fa fa-times' ></i></button></td>";
                    row += tr;
                }
                $("tbody#tbodyDiagnosticList").append(row);
                diagnosticView.idDiagnostic = null;
                //diagnosticView.addNewDiagnostic(result);
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
                    diagnosticView.fillTbody(data, '')
                })
            },
            fillUpdateToTable: function (element) {
                $.post(url + "admin/searchProfessional", {
                    _token: _token,
                    idPackageTreatment: $(element).attr("data-Id")
                }, function (data) {
                    $("tbody#PackagesTable").children().children().css("background-color", "white").css('color', '#555555');
                    $("tbody#PackagesTable").children().children().find("input").removeAttr("checked");
                    for (var i = 0; i < data.length; i++) {
                        if ($("tbody#PackagesTable").children().find("td[name=" + data[i]["professionalId"] + "]")) {
                            $("td[name=" + data[i]["professionalId"] + "]").css("background-color", "#00a859").css('color', '#ffffff');
                            $("td[name=" + data[i]["professionalId"] + "]").find("input").prop("checked", true);
                        }
                    }
                });
                $("div#TablePackages").show();
                $("div#menuPackageTreatment").hide();
                //$(element).parent().parent().addClass("active");
            },
            CompleteTreatmentPackage: function () {
                $("div#TablePackages").hide();
                $("div#menuPackageTreatment").show();
            },
            fillDeleteToTable: function () {
                alert("1");
            }

        }
    }
</script>