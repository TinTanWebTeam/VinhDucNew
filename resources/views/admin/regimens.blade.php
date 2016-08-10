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
                                    style="margin-left: 20%;" class="btn btn-default">Đau</button>
                            <button type="button"
                                    id="notAil"
                                    name="notAil"
                                    onclick="regimensView.notAil()"
                                    style="margin-left: 20%;" class="btn btn-default">Không đau</button>
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
        <div class="col-sm-6">
            <div class="row" id="menuPackageTreatment">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div style="color: #00a859;font-size: 17px;">Danh sách phác đồ </div>
                    </div>
                    <div class="table-responsive" >
                        <table class="table table-responsive table-bordered table-hover order-column" id="tableregimensList"
                               style="margin-bottom: 0px;">
                            <thead>
                            <tr>

                                <th>Mã</th>
                                <th>Ngày tạo</th>
                                <th>Tình trạng</th>
                                <th>Ghi chú</th>
                                <th>Chi tiết</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyregimensList">
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
                                        @foreach(array_chunk($professional->all(),2)as $rows)
                                            <tr>
                                                <td style="width: 3%;"></td>
                                                @foreach($rows as $item)
                                                    <td id="check" name="{{$item->id}}" ondblclick="regimensView.survey(this)" ><input type="checkbox"
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
                            <button type="button" name="cancelTreatment" onclick="regimensView.goBack(this)" class="btn default">Trở về</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-sm-6" id="seachPatient">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Tìm kiếm bệnh nhân
                        <button type="button" class="btn btn-info btn-circle pull-right"
                                onclick="regimensView.addNewregimens('')"><i
                                    class="fa fa-refresh"></i>
                        </button>
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
                                    <div class="table-responsive row col-md-12" style="display:none" id="Table">
                                        <table class="table table-hover table-light" id="AutoCompleteTable">
                                            <thead>
                                            <tr class="AutoCompleteTableHeader">
                                                <th>Mã bệnh nhân</th>
                                                <th>Họ và tên</th>
                                                <th>Mã phác đồ</th>
                                                <th>Ngày tạo</th>
                                                <th>Choose</th>
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
                                        <div class="form-group form-md-line-input col-md-6">
                                            <label for="CodeRegimen"><b>Mã phác đồ</b></label>
                                            <input type="text" class="form-control"
                                                   id="CodeRegimen"
                                                   name="CodeRegimen"
                                                   placeholder="PD001">
                                        </div>
                                        <div class="form-group form-md-line-input col-md-6">
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
                                            onclick="regimensView.searchPatient(this)">
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
    if (typeof (regimensView) === 'undefined') {
        regimensView = {
            goBack: null,
            idTreatmentPackage:null,
            idregimens: null,
            data:null,
            deleteTreatmentPackage:null,
            AilOrNotAilId:null,
            regimensObject: {
                Id: null,
                CodePatient: null,
                FullName: null,
                CodeRegimen: null,
                CreatedDate: null
            },
            resetregimensObject: function () {
                for (var propertyName in regimensView.regimensObject) {
                    if (regimensView.regimensObject.hasOwnProperty(propertyName)) {
                        regimensView.regimensObject.propertyName = null;
                    }
                }
            },
            addNewregimens: function (result) {
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

                } else {
                    //regimensView.viewListPatient(patientView.goBack);
                }
            },
            fillTbody: function (data) {
                $("tbody#tbodyregimensList").empty();
                var row = "";
                for (var i = 0; i < data.length; i++) {
                    var tr = "";
                    if(data[i]["active"]===0){
                        tr += "<tr id=" + data[i]["id"] + " style='cursor: pointer;background-color: #e6e4e4'>";
                    }else{
                        tr += "<tr id=" + data[i]["id"] + " style='cursor: pointer'>";
                    }
                    tr += "<td>" + data[i]["code"] + "</td>";
                    tr += "<td>" + data[i]["note"] + "</td>";
                    tr += "<td>" + data[i]["createdDate"] + "</td>";
                    tr += "<td>" + data[i]["namePackage"] + "</td>";
                    tr += "<td style='min-width: 50px;'><button  type='button' style='margin-left: 10%; background-color: #999999; border-color: #999999' class='btn btn-info btn-circle' data-active='"+ data[i]["active"] +"' data-date='"+ data[i]["createdDate"] +"' data-Id='" + data[i]["id"] + "' onclick='regimensView.fillUpdateToTable(this,String(\"\"))' ><i class='fa fa-cog' ></i></button></td>";
                    row += tr;
                }
                $("tbody#tbodyregimensList").append(row);
                regimensView.idregimens = null;
                //regimensView.addNewregimens(result);
            },
            setValueObject: function () {
                regimensView.resetregimensObject();
                for (var i = 0; i < Object.keys(regimensView.regimensObject).length; i++) {
                    regimensView.regimensObject[Object.keys(regimensView.regimensObject)[i]] = $("#" + Object.keys(regimensView.regimensObject)[i]).val();
                }
            },
            searchPatient: function (element) {
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
                            tr += "<td>" + data[i]["maPD"] + "</td>";
                            tr += "<td>" + data[i]["createdDate"] + "</td>";
                            tr += "<td <button type='button' style='margin-left: 30%;' class='btn btn-info btn-circle' data-Id='" + data[i]["id"] + "' onclick='regimensView.fillToInput(this)'><i class='fa fa-check '></i></button></td>";
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
                $("input[name=CodePatient]").val($(element).parent().parent().find("td").eq(0).text());
                $("input[name=FullName]").val($(element).parent().parent().find("td").eq(1).text());
                $("input[name=CodeRegimen]").val($(element).parent().parent().find("td").eq(2).text());
                $("input[name=CreatedDate]").val($(element).parent().parent().find("td").eq(3).text());
                regimensView.SearchTreatmentPackages($(element).attr("data-Id"));
            },
            SearchTreatmentPackages: function (element) {
                $.post(url + "admin/SearchTreatmentPackages", {
                    _token: _token,
                    IdPatient: element

                }, function (data) {
                    regimensView.fillTbody(data)
                })
            },
            fillUpdateToTable: function (element,result) {
                var d = new Date();
                var year = d.getFullYear();
                var month = d.getMonth()+1;
                var date = d.getDate();
                if(month<10) month ="0" + month;
                if(date<10) date ="0" + date;
                var strDate = year + "-" + month + "-" + date;
                if($(element).attr("data-date") < strDate || $(element).attr("data-active")==="0"){
                }
                if(result!=="") {
                    regimensView.idTreatmentPackage =result;

                }else {
                    regimensView.idTreatmentPackage = $(element).attr("data-Id");
                }
                $.post(url + "admin/searchProfessional", {
                    _token: _token,
                    idPackageTreatment: regimensView.idTreatmentPackage
                }, function (data) {
                    if(data!==null) {
                        regimensView.data = data;
                        $("tbody#PackagesTable").children().children().css("background-color", "white").css('color', '#555555');
                        $("tbody#PackagesTable").children().children().find("input").removeAttr("checked");
                        for (var i = 0; i < data.length; i++) {
                            if ($("tbody#PackagesTable").children().find("td[name=" + data[i]["professionalId"] + "]")) {
                                $("td[name=" + data[i]["professionalId"] + "]").css("background-color", "#00a859").css('color', '#ffffff');
                                $("td[name=" + data[i]["professionalId"] + "]").find("input").prop("checked", true).attr("disabled", true);
                            }
                        }
                    }
                });
                $("div#TablePackages").show();
                $("div#menuPackageTreatment").hide();
                //$(element).parent().parent().addClass("active");
            },
            fillAddNewToTable:function () {
                $("tbody#PackagesTable").children().children().css("background-color", "white").css('color', '#555555');
                $("tbody#PackagesTable").children().children().find("input").removeAttr("checked");
                $("div#TablePackages").show();
                $("div#menuPackageTreatment").hide();

            },
            survey:function (element) {
                var professionalId = $(element).attr("name");
                $.post(url+"admin/checkAilOrNotAil",{
                    _token:_token,
                    professionalId:  professionalId
                },function (data) {
                    regimensView.AilOrNotAilId = data["id"];
                    if(data["ail"]=== 0){
                        $("button[name=notAil]").css("background-color", "#00a859").css("border-color", "#00a859").css('color', '#ffffff');
                        $("button[name=ail]").css("background-color", "#eeeeee").css("border-color", "#e2e2e2").css('color', '#555555');
                        $("div#modalConfirm").modal("show");
                    }else if(data["ail"]===1){
                        $("button[name=ail]").css("background-color", "#00a859").css("border-color", "#00a859").css('color', '#ffffff');
                        $("button[name=notAil]").css("background-color", "#eeeeee").css("border-color", "#e2e2e2").css('color', '#555555');
                        $("div#modalConfirm").modal("show");
                    }else{
                        $("button[name=ail]").css("background-color", "#eeeeee").css("border-color", "#e2e2e2").css('color', '#555555');
                        $("button[name=notAil]").css("background-color", "#eeeeee").css("border-color", "#e2e2e2").css('color', '#555555');
                        $("div#modalConfirm").modal("show");
                    }
                })
            },
            Ail:function () {
                $.post(url+"admin/updateAil",{
                    _token:_token,
                    id: regimensView.AilOrNotAilId
                },function (data) {
                    $("div#modalConfirm").modal("hide");
                })
            },
            notAil:function () {
                $.post(url+"admin/updateNotAil",{
                    _token:_token,
                    id: regimensView.AilOrNotAilId
                },function (data) {
                    $("div#modalConfirm").modal("hide");
                })
            },
            goBack:function () {
                $("div#TablePackages").hide();
                $("div#menuPackageTreatment").show();
            }
        }
    }
</script>