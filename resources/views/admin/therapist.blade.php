{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Chắt chắn xoá ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Đóng</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="therapistView.modalAgree()">Tiếp tục
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
            <h4 style="color: #00a859">Quản lí > Điều trị viên</h4>
            <hr style="margin-top: 0px;color: #00a859">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6" style="height: 500px; overflow: scroll">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Danh sách điều trị viên
                        <button type="button" class="btn btn-danger btn-circle pull-right"
                                onclick="therapistView.deleteTherapist()"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover order-column" id="tableTherapistList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Họ và tên</th>
                            <th>Giới tính</th>
                            <th>Số điện thoại</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyTherapistList">
                        @if($therapists)
                            @foreach($therapists as $item)
                                <tr id="{{$item->id}}" onclick="therapistView.viewListTherapist(this)"
                                    style="cursor: pointer">
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->sex}}</td>
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
                        <button type="button" class="btn btn-info btn-circle pull-right" onclick="therapistView.addNewTherapist('')">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>

                </div>

                    <div class="portlet-body form">
                        <form role="form" id="formTherapist">
                            <div class="form-body">
                                <div class="form-group form-md-line-input" style="display:none">
                                    <input type="text" class="form-control" name="Id" id="Id">
                                </div>
                                <div class="form-group form-md-line-input col-md-12">
                                    <label for="Code"><b>Mã</b></label>
                                    <input type="text" class="form-control"
                                           id="Code"
                                           name="Code"
                                           placeholder="DTV001">
                                </div>
                                <div>
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="Name"><b>Họ và tên</b></label>
                                        <input type="text" class="form-control"
                                               id="Name"
                                               name="Name"
                                               placeholder="Nguyễn Văn A">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="Sex"><b>Giới tính</b></label>
                                        <input type="text" class="form-control"
                                               id="Sex"
                                               name="Sex"
                                               placeholder="Nam">
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
                                    <label id="Email" style="display: none">Email đã tồn tại</label>
                                </div>
                                <div>
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
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="Phone"><b>Số điện thoại</b></label>
                                        <input type="text" class="form-control"
                                               id="Phone"
                                               name="Phone"
                                               onclick=""
                                               onchange=""
                                               placeholder="093266xxx">
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <button type="button" class="btn blue"
                                                onclick="therapistView.addNewAndUpdateTherapist()">
                                            Hoàn tất
                                        </button>
                                        <button type="button" class="btn default"   onclick="therapistView.Cancel()">Huỷ</button>
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
        Therapist=null;
        if (typeof (therapistView) === 'undefined') {
            therapistView = {
                checkDelete:false,
                goBack:null,
                idTherapist: null,
                TherapistObject: {
                    Id: null,
                    Code: null,
                    Name: null,
                    Address:null,
                    Phone:null,
                    Sex:null,
                    AgeId:null,
                    ProvincialId:null,
                },
                resetTherapistObject: function () {
                    for (var propertyName in therapistView.resetTherapistObject) {
                        if (therapistView.TherapistObject.hasOwnProperty(propertyName)) {
                            therapistView.TherapistObject.propertyName = null;
                        }
                    }
                },
                addNewTherapist: function (result) {
                    if(result===""){
                        $("input[name=Id]").val("");
                        therapistView.resetForm();
                    }else if(result==="delete"){
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                        $("input[name=Id]").val("");
                        therapistView.resetForm();
                    }
                },
                Cancel:function () {
                    therapistView.resetForm();
                },
                firstToUpperCase: function (str) {
                    return str.substr(0, 1).toUpperCase() + str.substr(1);
                },
                resetForm: function () {
                    if ($("input[name=Id]").val() === "") {
                        var allinput = $("input");
                        $("div[class=form-body]").find(allinput).val("");
                        $("div[class=form-body]").find("select").val(1);
                    }else{
                        therapistView.viewListTherapist(therapistView.goBack);
                    }
                },
                fillTbody: function (data,result) {
                    $("tbody#tbodyTherapistList").empty();
                    var row = "";
                    for (var i = 0; i < data["listTherapist"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listTherapist"][i]["id"] + " onclick='therapistView.viewListTherapist(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listTherapist"][i]["code"] + "</td>";
                        tr += "<td>" + data["listTherapist"][i]["name"] + "</td>";
                        tr += "<td>" + data["listTherapist"][i]["sex"] + "</td>";
                        tr += "<td>" + data["listTherapist"][i]["phone"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyTherapistList").append(row);
                    therapistView.idTherapist = null;
                    therapistView.addNewTherapist(result);
                },
                deleteTherapist:function () {
                    $("div#modalConfirm").modal("show");
                },
                viewListTherapist: function (element) {
                    therapistView.goBack = element;
                    Therapist=$(element).attr("id");
                    therapistView.idTherapist = $(element).attr("id");
                    $("tbody#tbodyTherapistList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewTherapist", {
                        _token: _token,
                        idTherapist: therapistView.idTherapist
                    }, function (data) {
                        $("input[name=Id]").empty().val(therapistView.idTherapist)
                        for (var propertyName in data) {
                            $("select[id=" + therapistView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("input[id=" + therapistView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                modalAgree:function () {
                    if (Therapist !== null) {
                        $.post(url + "admin/deleteTherapist", {
                            _token: _token,
                            idTherapist: Therapist
                        }, function (data) {
                            if (data[0] === 1) {
                                therapistView.fillTbody(data,'delete');
                            }
                        });
                    }
                    else {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Vui lòng chọn chuyên viên cần xoá");
                        $("button[name=modalAgree]").hide();
                    }
                },
                addNewAndUpdateTherapist:function () {
                    therapistView.resetTherapistObject();
                    for (var i = 0; i < Object.keys(therapistView.TherapistObject).length; i++) {
                        therapistView.TherapistObject[Object.keys(therapistView.TherapistObject)[i]] = $("#" + Object.keys(therapistView.TherapistObject)[i]).val();
                    }
                    $("#formTherapist").validate({
                        rules:{
                            Code:"required",
                            Name:"required",
                            Address:"required",
                            Phone:"required"
                        },
                        messages:{
                            Code:"Mã chuyên viên không được rỗng",
                            Name:"Tên chuyên viên khoog được rỗng",
                            Address:"Địa chỉ nhân viên không được rỗng",
                            Phone:"Số điện thoại chuyên viên không được rỗng"
                        }
                    });
                    if($("#formTherapist").valid()){
                        $.post(url+"admin/addNewAndUpdateTherapist",{
                            _token:_token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataTherapist: therapistView.TherapistObject
                        },function (data) {
                            if (data[0] === 1) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                therapistView.fillTbody(data,'');
                            } else if (data[0] === 2) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                therapistView.fillTbody(data,'');
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