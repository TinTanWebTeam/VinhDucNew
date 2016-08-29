{{--Model--}}

<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Bạn có chắc xóa ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Hủy</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="informationView.modalAgree()">Đồng ý
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
            <h4 style="color: #00a859">Khảo sát > Ý kiến bệnh nhân > Thông tin ý kiến bệnh nhân</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Thông tin ý kiến bệnh nhân
                        <button type="button" class="btn btn-danger btn-circle pull-right" onclick="informationView.deleteInformation()"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>

                </div>
                <div style="height: 380px;overflow: scroll;">
                    <table class="table table-bordered table-hover order-column" id="tableInformationList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Ngày tạo</th>
                            <th>Ý kiến bệnh nhân</th>
                            <th>Tình trạng</th>
                            <th>Nội dung xử lý</th>
                            {{--<th>BN</th>--}}
                            {{--<th>DTV</th>--}}
                        </tr>
                        </thead>
                        <tbody id="tbodyInformationList">
                        @foreach($Informations as $item)
                            <tr id="{{$item->id}}" data-status = "{{$item->handling}}" onclick="informationView.viewListInformation(this)" style="cursor: pointer">
                                <td>{{$item->createdDate}}</td>
                                <td>{{$item->patientReviews}}</td>
                                @if($item->handling === 1)
                                     <td>Đã xử lý</td>
                                @elseif($item->handling === 2 || $item->handling === 0)
                                    <td>Chưa xử lý</td>
                                @endif
                                <td>{{$item->content}}</td>
                                {{--<td>{{$item->InformationPatientId()->fullName}}</td>--}}
                                {{--<td>{{$item->InformationTherapistId()->name}}</td>--}}

                                {{--<td>{{$item->InformationTherapist()->id}}</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Thêm mới | Chỉnh sửa
                        <button type="button" class="btn btn-info btn-circle pull-right" onclick="informationView.addNewInformation('')"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formInformation">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id" value="">
                                    </div>
                                    <div class="form-group form-md-line-input"></div>
                                    {{--<div class="form-group form-md-line-input ">--}}
                                        {{--<label for="TherapistId">Tên nhân viên</label>--}}
                                        {{--<select class="form-control" id="Therapist_id" name="Therapist_id">--}}
                                            {{--@if($therapists)--}}
                                                {{--<option value="" selected>-- Chọn nhân viên --</option>--}}
                                                {{--@foreach($therapists as $item)--}}
                                                    {{--<option value="{{$item->id}}">{{$item->name}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        {{--</select>--}}

                                    {{--</div>--}}
                                    <div class="form-group form-md-line-input ">
                                        <label for="PatientId">Tên bệnh nhân</label>
                                        <select class="form-control" id="Patient_id" name="Patient_id">
                                            @if($patients)
                                                <option value="" selected>-- Chọn bệnh nhân --</option>
                                                @foreach($patients as $item)
                                                    <option value="{{$item->id}}">{{$item->fullName}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="patientReviews">Ý kiến bệnh nhân</label>
                                        <textarea type="text" class="form-control" rows="5" cols="5"
                                                  id="PatientReviews"
                                                  name="PatientReviews"
                                                  placeholder="Ý kiến bệnh nhân"></textarea>
                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <label for="handling">Tình trạng</label>
                                        <select class="form-control" id="Handling" onchange="informationView.Processed()">
                                            <option value=""> -- Chọn tình trạng -- </option>
                                            <option value="1" >Đã xử lý</option>
                                            <option value="2">Chưa xử lý</option>
                                        </select>
                                    </div>
                                    <div class="form-group form-md-line-input" name="Content" style="display: none">
                                        <label for="Content">Nội dung xử lý</label>
                                        <textarea type="text" class="form-control" rows="5" cols="5"
                                                  id="Content"
                                                  name="Content"
                                                  placeholder="Nội dung xử lý"></textarea>
                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <label for="CreatedDate">Ngày tạo</label>
                                        <input type="date" class="form-control"
                                               id="CreatedDate"
                                               name="CreatedDate"
                                                value="{{date('Y-m-d')}}">
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <button type="button" class="btn blue"
                                                name="complete"
                                                onclick="informationView.addNewAndUpdateInformation()">
                                            Hoàn tất
                                        </button>
                                        <button type="button" class="btn default" onclick="informationView.Cancel()">Hủy
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
</div>
<script>
    $(function () {
        if (typeof (informationView) === 'undefined') {
            informationView = {
                goBack: null,
                idInformation: null,
                informationObject: {
                    Id: null,
                    Content: null,
                    PatientReviews: null,
                    Handling: null,
                    CreatedDate:null,
                    Therapist_id:null,
                    Patient_id :null,
                },
                resetInformationObject: function () {
                    for (var propertyName in informationView.informationObject) {
                        if (informationView.informationObject.hasOwnProperty(propertyName)) {
                            informationView.informationObject.propertyName = null;
                        }
                    }
                },
                firstToUpperCase: function (str) {
                    return str.substr(0, 1).toUpperCase() + str.substr(1);
                },
                resetForm: function () {
                    if ($("input[name=Id]").val() === "") {
                        var allinput = $("input");
                        var alltextarea = $("textarea");
                        var allselect = $("select");
                        $("div[class=form-body]").find(allselect).val("");
                        $("div[class=form-body]").find(allinput).val("");
                        $("div[class=form-body]").find(alltextarea).val("");
                    } else {
                        informationView.viewListInformation(informationView.goBack);
                    }
                },
                Cancel: function () {
                    informationView.resetForm();
                },
                addNewInformation: function (result) {
                    if (result === "") {
                        $("button[name=complete]").show();
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        informationView.resetForm();
                    } else if (result === "delete") {
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        informationView.resetForm();
                    }
                },
                Processed:function () {
                    if($("#Handling option:selected").val()==="1"){
                        $("div[name=Content]").show();
                    }else{
                        $("div[name=Content]").hide();
                    }
                },
                viewListInformation: function (element) {
                    if($(element).attr("data-status") === "1"){
                        $("button[name=complete]").hide();
                        $("div[name=Content]").show();
                        informationView.goBack = element;
                        idInformation = $(element).attr("id");
                        informationView.idInformation = $(element).attr("id");
                        $("tbody#tbodyInformationList").find("tr").removeClass("active");
                        $(element).addClass("active");
                        $.post(url + "admin/postViewInformation", {
                            _token: _token,
                            idInformation: informationView.idInformation
                        }, function (data) {
                            console.log(data);
                            $("input[name=Id]").empty().val(informationView.idInformation);
                            for (var propertyName in data) {
                                $("select[id=" + informationView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                                $("input[id=" + informationView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                                $("textarea[id=" + informationView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            }
                        })
                    }else {
                        $("button[name=complete]").show();
                        informationView.goBack = element;
                        idInformation = $(element).attr("id");
                        informationView.idInformation = $(element).attr("id");
                        $("tbody#tbodyInformationList").find("tr").removeClass("active");
                        $(element).addClass("active");
                        $.post(url + "admin/postViewInformation", {
                            _token: _token,
                            idInformation: informationView.idInformation
                        }, function (data) {
                            console.log(data);
                            $("input[name=Id]").empty().val(informationView.idInformation);
                            for (var propertyName in data) {
                                $("select[id=" + informationView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                                $("input[id=" + informationView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                                $("textarea[id=" + informationView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            }
                        })
                    }
                },
                deleteInformation: function () {
                    if ($("input[name=Id]").val() === "") {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Vui lòng chọn mục cần xoá");
                        $("button[name=modalAgree]").hide();
                    } else {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Bạn có chắc xóa ?");
                        $("button[name=modalAgree]").show();
                    }
                },
                modalAgree: function () {
                    if (idInformation !== null) {
                        $.post(url + "admin/deleteInformation", {
                            _token: _token,
                            idInformation: idInformation
                        }, function (data) {
                            if (data[0] === 1) {
                                informationView.fillTbody(data, 'delete');
                            }
                        });
                    }
                },
                fillTbody: function (data, result) {
                    $("tbody#tbodyInformationList").empty();
                    var row = "";
                    for (var i = 0; i < data["listInformation"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listInformation"][i]["Id"] + " data-status="+data["listInformation"][i]["Handling"]+"  onclick='informationView.viewListInformation(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listInformation"][i]["CreatedDate"] + "</td>";
                        tr += "<td>" + data["listInformation"][i]["PatientReviews"] + "</td>";
                        if(data["listInformation"][i]["Handling"] === 1) {
                            tr += "<td>" + ["Đã xử lý"] + "</td>";
                        }else if(data["listInformation"][i]["Handling"] === 2 || data["listInformation"][i]["Handling"] === 0){
                            tr += "<td>" + ["Chưa xử lý"] + "</td>";
                        }
                        tr += "<td>" + data["listInformation"][i]["Content"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyInformationList").append(row);
                    informationView.idInformation = null;
                    informationView.addNewInformation(result);
                },
                addNewAndUpdateInformation: function () {
                    informationView.resetInformationObject();
                    for (var i = 0; i < Object.keys(informationView.informationObject).length; i++) {
                        informationView.informationObject[Object.keys(informationView.informationObject)[i]] = $("#" + Object.keys(informationView.informationObject)[i]).val();
                    }
                    $("#formInformation").validate({
                        rules: {
                            Content: "required",
                            PatientReviews: "required",
                            Patient_id: "required",
                            Therapist_id:"required",
                        },
                        messages: {
                            Content: "Câu hỏi không được rỗng",
                            PatientReviews: "Câu hỏi không được rỗng",
                            Therapist_id: "Hãy chọn chuyên viên",
                            Patient_id: "Hãy chọn bệnh nhân"
                        },

                    });
                    if ($("#formInformation").valid()) {
                        $.post(url + "admin/addNewAndUpdateInformation", {
                            _token: _token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataInformation: informationView.informationObject
                        }, function (data) {
                            if (data[0] === 1) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                informationView.fillTbody(data, '');
                            } else if (data[0] === 2) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                informationView.fillTbody(data, '');
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
                        $("form#formInformation").find("label[class=error]").css("color","red");
                    }
                }
            }
        }
    });



</script>