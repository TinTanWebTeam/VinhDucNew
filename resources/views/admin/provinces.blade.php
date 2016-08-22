{{--Model--}}

<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Bạn có chắc xóa ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Hủy</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="provinceView.modalAgree()">Đồng ý
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
            <h4 style="color: #00a859">Danh mục > Tỉnh thành</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default" >
                <div class="panel-heading"  >
                    <div style="color: #00a859;font-size: 17px;">Tỉnh thành</div>
                </div>
                <div style="height: 300px;overflow: scroll;">
                    <table class="table table-bordered table-hover order-column" id="tableProvinceList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>tỉnh thành</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyProvinceList">
                        @foreach($Provinces as $item)
                            <tr id="{{$item->id}}" onclick="provinceView.viewListProvince(this)" style="cursor: pointer">
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
                    <div style="color: #00a859;font-size: 17px;">Thêm mới | Chỉnh sửa
                        <button type="button" class="btn btn-info btn-circle pull-right" onclick="provinceView.addNewProvince('')"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formProvince">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id" value="">
                                    </div>
                                    <div class="form-group form-md-line-input"></div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Name">Tỉnh thành</label>
                                        <input type="text" class="form-control"
                                               id="Name"
                                               name="Name"
                                               placeholder="Tên tỉnh thành">
                                    </div>

                                </div>
                                <div class="form-actions noborder">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <button type="button" class="btn blue"
                                                onclick="provinceView.addNewAndUpdateProvince()">
                                            Hoàn tất
                                        </button>
                                        <button type="button" class="btn default" onclick="provinceView.Cancel()">Hủy
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
        if (typeof (provinceView) === 'undefined') {
            provinceView = {
                goBack: null,
                idProvince: null,
                ProvinceObject: {
                    Id: null,
                    Name: null,
                },
                resetProvinceObject: function () {
                    for (var propertyName in provinceView.ProvinceObject) {
                        if (provinceView.ProvinceObject.hasOwnProperty(propertyName)) {
                            provinceView.ProvinceObject.propertyName = null;
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
                        provinceView.viewListProvince(provinceView.goBack);
                    }
                },
                Cancel: function () {
                    provinceView.resetForm();
                },

                addNewProvince: function (result) {
                    if (result === "") {
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        provinceView.resetForm();
                    } else if (result === "delete") {
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        provinceView.resetForm();
                    }
                },

                viewListProvince: function (element) {
                    provinceView.goBack = element;
                    idProvince = $(element).attr("id");
                    provinceView.idProvince = $(element).attr("id");
                    $("tbody#tbodyProvinceList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewProvince", {
                        _token: _token,
                        idProvince: provinceView.idProvince
                    }, function (data) {
                        $("input[name=Id]").empty().val(provinceView.idProvince)
                        for (var propertyName in data) {
                            $("input[id=" + provinceView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("textarea[id=" + provinceView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                fillTbody: function (data, result) {
                    $("tbody#tbodyProvinceList").empty();
                    var row = "";
                    for (var i = 0; i < data["listProvince"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listProvince"][i]["id"] + " onclick='provinceView.viewListProvince(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listProvince"][i]["Name"] + "</td>";
                        tr += "<td>" + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyProvinceList").append(row);
                    provinceView.idProvince = null;
                    provinceView.addNewProvince(result);

                },
                deleteProvince: function () {
                    if ($("input[name=Id]").val() === "")
                    {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Vui lòng chọn gói cần xoá");
                        $("button[name=modalAgree]").hide();
                    }else{
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Bạn có chắc xóa ?");
                        $("button[name=modalAgree]").show();
                    }
                },

                modalAgree: function () {
                    if (idProvince !== null) {
                        $.post(url + "admin/deleteProvince", {
                            _token: _token,
                            idProvince: idProvince
                        }, function (data) {
                            if (data[0] === 1) {
                                ProvinceView.fillTbody(data, 'delete');
                            }
                        });
                    }

                },

                addNewAndUpdateProvince: function () {
                    provinceView.resetProvinceObject();
                    for (var i = 0; i < Object.keys(provinceView.ProvinceObject).length; i++)
                    {
                        provinceView.ProvinceObject[Object.keys(provinceView.ProvinceObject)[i]] = $("#" + Object.keys(provinceView.ProvinceObject)[i]).val();
                    }
                    $("#formProvince").validate({
                        rules: {
                            Name: "required",
                        },
                        messages: {
                            Name: "Tên tỉnh thành không được rỗng",
                        }
                    });
                    if ($("#formProvince").valid()) {
                        $.post(url + "admin/addNewAndUpdateProvince", {
                            _token: _token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataProvince: provinceView.ProvinceObject
                        }, function (data) {
                            if (data[0] === 1) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                provinceView.fillTbody(data, '');
                            } else if (data[0] === 2) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                provinceView.fillTbody(data, '');
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
                        $("form#formProvince").find("label[class=error]").css("color","red");
                    }
                },
            }
        }
    });
</script>