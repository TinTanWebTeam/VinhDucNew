{{--Model--}}

<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Bạn có chắc xóa ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Hủy</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="packageView.modalAgree()">Đồng ý
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
            <h4 style="color: #00a859">Danh mục > Tạo Gói</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Các Gói
                        <button type="button" class="btn btn-danger btn-circle pull-right" onclick="packageView.deletePackage()"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div style="height: 380px;overflow: scroll;">
                    <table class="table table-bordered table-hover order-column" id="tablePackageList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Tên Gói</th>
                            <th>Giá Tiền</th>

                        </tr>
                        </thead>
                        <tbody id="tbodyPackageList">
                        @foreach($Packages as $item)
                            <tr id="{{$item->id}}" onclick="packageView.viewListPackage(this)" style="cursor: pointer">
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
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
                        <button type="button" class="btn btn-info btn-circle pull-right" onclick="packageView.addNewPackage('')"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>

                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formPackage">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id" value="">
                                    </div>
                                    <div class="form-group form-md-line-input"></div>
                                    <div class="form-group form-md-line-input">
                                        <label for="packageName">Tên Gói</label>
                                        <input type="text" class="form-control"
                                               id="Name"
                                               name="Name"
                                               placeholder="Tên gói">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="price">Giá tiền</label>
                                        <input type="number" class="form-control"
                                               id="Price"
                                               name="Price"
                                               placeholder="Giá tiền">
                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <label for="Note">Ghi chú</label>
                                        <textarea class="form-control" id="Note" rows="5" cols="5"
                                                  name="Note"
                                                  placeholder="Nhập ghi chú"></textarea>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <button type="button" class="btn blue"
                                                onclick="packageView.addNewAndUpdatePackage()">
                                            Hoàn tất
                                        </button>
                                        <button type="button" class="btn default" onclick="packageView.Cancel()">Hủy
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
        idPackage = null;
        if (typeof (packageView) === 'undefined') {
            packageView = {
                goBack: null,
                idPackage: null,
                PackageObject: {
                    Id: null,
                    Name: null,
                    Price: null,
                    Note: null
                },
                resetPackageObject: function () {
                    for (var propertyName in packageView.PackageObject) {
                        if (packageView.PackageObject.hasOwnProperty(propertyName)) {
                            packageView.PackageObject.propertyName = null;
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
                        packageView.viewListPackage(packageView.goBack);
                    }
                },
                Cancel: function () {
                    packageView.resetForm();
                },

                addNewPackage: function (result) {
                    if (result === "") {
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        packageView.resetForm();
                    } else if (result === "delete") {
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        packageView.resetForm();
                    }
                },

                viewListPackage: function (element) {
                    packageView.goBack = element;
                    idPackage = $(element).attr("id");
                    packageView.idPackage = $(element).attr("id");
                    $("tbody#tbodyPackageList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewPackage", {
                        _token: _token,
                        idPackage: packageView.idPackage
                    }, function (data) {
                        $("input[name=Id]").empty().val(packageView.idPackage)
                        for (var propertyName in data) {
                            $("input[id=" + packageView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("textarea[id=" + packageView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                fillTbody: function (data, result) {
                    $("tbody#tbodyPackageList").empty();
                    var row = "";
                    for (var i = 0; i < data["listPackage"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listPackage"][i]["id"] + " onclick='packageView.viewListPackage(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listPackage"][i]["name"] + "</td>";
                        tr += "<td>" + data["listPackage"][i]["price"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyPackageList").append(row);
                    packageView.idPackage = null;
                    packageView.addNewPackage(result);

                },
                deletePackage: function () {
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
                    if (idPackage !== null) {
                        $.post(url + "admin/deletePackage", {
                            _token: _token,
                            idPackage: idPackage
                        }, function (data) {
                            if (data[0] === 1) {
                                packageView.fillTbody(data, 'delete');
                            }
                        });
                    }

                },

                addNewAndUpdatePackage: function () {
                    packageView.resetPackageObject();
                    for (var i = 0; i < Object.keys(packageView.PackageObject).length; i++)
                    {
                        packageView.PackageObject[Object.keys(packageView.PackageObject)[i]] = $("#" + Object.keys(packageView.PackageObject)[i]).val();
                    }
                    $("#formPackage").validate({
                        rules: {
                            Name: "required",
                        },
                        messages: {
                            Name: "Tên gói không được rỗng",
                        }
                    });

                    if ($("#formPackage").valid()) {
                        $.post(url + "admin/addNewAndUpdatePackage", {
                            _token: _token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataPackage: packageView.PackageObject
                        }, function (data) {
                            if (data[0] === 1) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                packageView.fillTbody(data, '');
                            } else if (data[0] === 2) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                packageView.fillTbody(data, '');
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
    ;
</script>