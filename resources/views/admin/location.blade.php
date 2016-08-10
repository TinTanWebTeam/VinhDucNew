{{--Model--}}

<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Are you sure delete ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Hủy</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="locationView.modalAgree()">Đồng Ý
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
            <h4 style="color: #00a859">Danh mục > Vị trí Điều trị</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Vị trí Điều Trị</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">
                        <button type="button" class="btn btn-danger btn-circle"
                                onclick="locationView.deleteLocation()"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <table class="table table-bordered table-hover order-column" id="tableProTreatmentList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Vị trí điều trị</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyLocationList">
                        @foreach($locaTions as $item)
                            <tr id="{{$item->id}}" onclick="locationView.viewListLocation(this)"
                                style="cursor: pointer">
                                <td>{{$item->name}}</td>
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
                                onclick="locationView.addNewLocation('')"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>

                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formLocation">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id">
                                    </div>
                                    <div class="form-group form-md-line-input"></div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Location">Vị Trí Điều Trị</label>
                                        <input type="text" class="form-control"
                                               id="Name"
                                               name="Name"
                                               placeholder="Vị Trí Điều Trị">
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
                                    onclick="locationView.addNewAndUpdateLocation()">
                                Hoàn tất
                            </button>
                            <button type="button" class="btn default" onclick="locationView.Cancel()">Hủy
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
        if (typeof (locationView) === 'undefined') {
            locationView = {
                idLocation: null,
                goBack: null,
               locationObject: {
                    Id: null,
                    Name: null,
                    Note: null,

                },
                resetLocationObject: function () {
                    for (var propertyName in locationView.locationObject) {
                        if (locationView.locationObject.hasOwnProperty(propertyName)) {
                            locationView.locationObject.propertyName = null;
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
                        $("div[class=form-body]").find(allinput).val("");
                        $("div[class=form-body]").find(alltextarea).val("");
                    } else {
                        locationView.viewListLocation(locationView.goBack);
                    }
                },
                Cancel: function () {
                    locationView.resetForm();
                },
                addNewLocation: function (result) {
                    if (result === "") {
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        locationView.resetForm();
                    } else if (result === "delete") {
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        locationView.resetForm();
                    }
                },
                viewListLocation: function (element) {
                    locationView.goBack = element;
                    idLocation = $(element).attr("id");
                    locationView.idLocation = $(element).attr("id");
                    $("tbody#tbodyLocationList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewLocation", {
                        _token: _token,
                        idLocation: locationView.idLocation
                    }, function (data) {
                        $("input[name=Id]").empty().val(locationView.idLocation)
                        for (var propertyName in data) {
                            $("input[id=" + locationView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("textarea[id=" + locationView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    });
                },
                fillTbody: function (data, result) {
                    $("tbody#tbodyLocationList").empty();
                    var row = "";
                    for (var i = 0; i < data["listLocation"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listLocation"][i]["id"] + " onclick='locationView.viewListLocation(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listLocation"][i]["Name"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyLocationList").append(row);
                    locationView.idProTreatment = null;
                    locationView.addNewLocation(result);

                },
                deleteLocation: function () {
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
                    if (idLocation !== null) {
                        $.post(url + "admin/deleteLocation", {
                            _token: _token,
                            idLocation: idLocation
                        }, function (data) {
                            if (data[0] === 1) {
                                locationView.fillTbody(data, 'delete');
                            }
                        });
                    }

                },
                addNewAndUpdateLocation: function () {
                    locationView.resetLocationObject();
                    for (var i = 0; i < Object.keys(locationView.locationObject).length; i++) {
                        locationView.locationObject[Object.keys(locationView.locationObject)[i]] = $("#" + Object.keys(locationView.locationObject)[i]).val();
                    }
                    $("#formLocation").validate({
                        rules: {
                            Name: "required",
                        },
                        messages: {
                            Name: "Vị trí điều trị không được rỗng",
                        }
                    });
                    if ($("#formLocation").valid()) {
                        $.post(url + "admin/addNewAndUpdateLocation", {
                            _token: _token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataLocation: locationView.locationObject
                        }, function (data) {
                            if (data[0] === 1) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                locationView.fillTbody(data, '');
                            } else if (data[0] === 2) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                locationView.fillTbody(data, '');
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