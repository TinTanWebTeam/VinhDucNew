{{--Model--}}

<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Are you sure delete ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Hủy</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="proTreatmentView.modalAgree()">Đồng Ý
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
            <h4 style="color: #00a859">Danh mục > Điều Trị chuyên môn</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Điều Trị chuyên môn</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">
                        <button type="button" class="btn btn-danger btn-circle"
                                onclick="proTreatmentView.deleteProTm()"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <table class="table table-bordered table-hover order-column" id="tableProTreatmentList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Phương pháp điều trị</th>
                            <th>Vị trí điều trị</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyProTreatmentList">
                        @foreach($proTms as $item)
                            <tr id="{{$item->id}}" onclick="proTreatmentView.viewListProTm(this)"
                                style="cursor: pointer">
                                <td>{{$item->name}}</td>
                                <td>{{$item->localTreatment()->name}}</td>
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
                    <div style="color: #00a859;font-size: 17px;">Thêm mới | Chỉnh sửa</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">
                        <button type="button" class="btn btn-info btn-circle"
                                onclick="proTreatmentView.addNewProTreatment('')"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>

                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formProTm">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id">
                                    </div>
                                    <div class="form-group form-md-line-input"></div>
                                    <div class="form-group form-md-line-input">
                                        <label for="TmName">Phương Pháp Điều Trị</label>
                                        <input type="text" class="form-control"
                                               id="Name"
                                               name="Name"
                                               placeholder="Phương Pháp Điều Trị">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Location">Vị Trí Điều Trị</label>
                                        <select class="form-control" id="LocationTreatmentId">
                                            <option value="0">-- Chọn Vị Trí --</option>
                                            @if($Locations)
                                                @foreach($Locations as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <label for="Note">Ghi chú</label>
                                        <textarea class="form-control" id="Note" name="Note" rows="5" cols="10"
                                                  placeholder="Nhập ghi chú"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="form-actions noborder">
                        <div class="form-group" style="padding-left: 15px;">
                            <button type="button" class="btn blue"
                                    onclick="proTreatmentView.addNewAndUpdateProTreatment()">
                                Hoàn tất
                            </button>
                            <button type="button" class="btn default" onclick="proTreatmentView.Cancel()">Hủy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        if (typeof (proTreatmentView) === 'undefined') {
            proTreatmentView = {
                idProTreatment: null,
                goBack: null,
                proTreatmentObject: {
                    Id: null,
                    Name: null,
                    LocationTreatmentId: null,
                    Note: null,

                },
                resetProTreatmentObject: function () {
                    for (var propertyName in proTreatmentView.proTreatmentObject) {
                        if (proTreatmentView.proTreatmentObject.hasOwnProperty(propertyName)) {
                            proTreatmentView.proTreatmentObject.propertyName = null;
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
                        $("div[class=form-body]").find("select").val("0");
                        $("div[class=form-body]").find(allinput).val("");
                        $("div[class=form-body]").find(alltextarea).val("");
                    } else {
                        proTreatmentView.viewListProTm(proTreatmentView.goBack);
                    }
                },
                Cancel: function () {
                    proTreatmentView.resetForm();
                },
                addNewProTreatment: function (result) {
                    if (result === "") {
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        proTreatmentView.resetForm();
                    } else if (result === "delete") {
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        proTreatmentView.resetForm();
                    }
                },
                viewListProTm: function (element) {
                    proTreatmentView.goBack = element;
                    idProTreatment = $(element).attr("id");
                    proTreatmentView.idProTreatment = $(element).attr("id");
                    $("tbody#tbodyProTreatmentList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewProvince", {
                        _token: _token,
                        idProTreatment: proTreatmentView.idProTreatment
                    }, function (data) {
                        $("input[name=Id]").empty().val(proTreatmentView.idProTreatment)
                        for (var propertyName in data) {
                            $("select[id=" + proTreatmentView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("input[id=" + proTreatmentView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("textarea[id=" + proTreatmentView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    });
                },
                fillTbody: function (data, result) {
                    $("tbody#tbodyProTreatmentList").empty();
                    var row = "";
                    for (var i = 0; i < data["listProTreatment"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listProTreatment"][i]["Id"] + " onclick='proTreatmentView.viewListProTm(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listProTreatment"][i]["Name"] + "</td>";
                        tr += "<td>" + data["listProTreatment"][i]["LocationTreatmentId"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyProTreatmentList").append(row);
                    proTreatmentView.idProTreatment = null;
                    proTreatmentView.addNewProTreatment(result);

                },
                deleteProTm: function () {
                    if ($("input[name=Id]").val() === "") {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Vui lòng chọn điều trị cần xoá");
                        $("button[name=modalAgree]").hide();
                    } else {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Bạn có chắc xóa ?");
                        $("button[name=modalAgree]").show();
                    }
                },
                modalAgree: function () {
                    if (idProTreatment !== null) {
                        $.post(url + "admin/deleteProTreatment", {
                            _token: _token,
                            idProTreatment: idProTreatment
                        }, function (data) {
                            if (data[0] === 1) {
                                proTreatmentView.fillTbody(data, 'delete');
                            }
                        });
                    }

                },
                addNewAndUpdateProTreatment: function () {
                    proTreatmentView.resetProTreatmentObject();
                    for (var i = 0; i < Object.keys(proTreatmentView.proTreatmentObject).length; i++) {
                        proTreatmentView.proTreatmentObject[Object.keys(proTreatmentView.proTreatmentObject)[i]] = $("#" + Object.keys(proTreatmentView.proTreatmentObject)[i]).val();
                    }
                    $("#formProTm").validate({
                        rules: {
                            Name: "required",
                        },
                        messages: {
                            Name: "Phương pháp điều trị khôg được rỗng",
                        }
                    });
                    if ($("#formProTm").valid()) {
                        $.post(url + "admin/addNewAndUpdateProTreatment", {
                            _token: _token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataProTreatment: proTreatmentView.proTreatmentObject
                        }, function (data) {
                            if (data[0] === 1) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                proTreatmentView.fillTbody(data, '');
                            } else if (data[0] === 2) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                proTreatmentView.fillTbody(data, '');
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
                },
            }
        }
    })
</script>