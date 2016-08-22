{{--Model--}}

<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Bạn có chắc xóa ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Hủy</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="ageView.modalAgree()">Đồng ý
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
            <h4 style="color: #00a859">Danh mục > Độ tuổi</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Độ tuổi</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">

                    </div>
                </div>
                <div style="height: 300px;overflow: scroll;">
                    <table class="table table-bordered table-hover order-column" id="tableAgeList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Độ tuổi</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyAgeList">
                        @foreach($Ages as $item)
                            <tr id="{{$item->id}}" onclick="ageView.viewListAge(this)" style="cursor: pointer">
                                <td>{{$item->age}}</td>
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
                        <button type="button" class="btn btn-info btn-circle pull-right" onclick="ageView.addNewAge('')"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formAge">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id" value="">
                                    </div>
                                    <div class="form-group form-md-line-input"></div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Age">Độ tuổi</label>
                                        <input type="text" class="form-control"
                                               id="Age"
                                               name="Age"
                                               placeholder="Độ Tuổi">
                                    </div>

                                </div>
                                <div class="form-actions noborder">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <button type="button" class="btn blue"
                                                onclick="ageView.addNewAndUpdateAge()">
                                            Hoàn tất
                                        </button>
                                        <button type="button" class="btn default" onclick="ageView.Cancel()">Hủy
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
        if (typeof (ageView) === 'undefined') {
            ageView = {
                goBack: null,
                idAge: null,
                AgeObject: {
                    Id: null,
                    Age: null,
                },
                resetAgeObject: function () {
                    for (var propertyName in ageView.AgeObject) {
                        if (ageView.AgeObject.hasOwnProperty(propertyName)) {
                            ageView.AgeObject.propertyName = null;
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
                        ageView.viewListAge(ageView.goBack);
                    }
                },
                Cancel: function () {
                    ageView.resetForm();
                },

                addNewAge: function (result) {
                    if (result === "") {
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        ageView.resetForm();
                    } else if (result === "delete") {
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        ageView.resetForm();
                    }
                },

                viewListAge: function (element) {
                    ageView.goBack = element;
                    idAge = $(element).attr("id");
                    ageView.idAge = $(element).attr("id");
                    $("tbody#tbodyAgeList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewAge", {
                        _token: _token,
                        idAge: ageView.idAge
                    }, function (data) {
                        $("input[name=Id]").empty().val(ageView.idAge)
                        for (var propertyName in data) {
                            $("input[id=" + ageView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("textarea[id=" + ageView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                fillTbody: function (data, result) {
                    $("tbody#tbodyAgeList").empty();
                    var row = "";
                    for (var i = 0; i < data["listAge"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listAge"][i]["id"] + " onclick='ageView.viewListAge(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listAge"][i]["Age"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyAgeList").append(row);
                    ageView.idAge = null;
                    ageView.addNewAge(result);

                },
                deleteAge: function () {
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
                    if (idAge !== null) {
                        $.post(url + "admin/deleteAge", {
                            _token: _token,
                            idAge: idAge
                        }, function (data) {
                            if (data[0] === 1) {
                               ageView.fillTbody(data, 'delete');
                            }
                        });
                    }

                },

                addNewAndUpdateAge: function () {
                    ageView.resetAgeObject();
                    for (var i = 0; i < Object.keys(ageView.AgeObject).length; i++)
                    {
                        ageView.AgeObject[Object.keys(ageView.AgeObject)[i]] = $("#" + Object.keys(ageView.AgeObject)[i]).val();
                    }
                    $("#formAge").validate({
                        rules: {
                            Age: "required",
                        },
                        messages: {
                            Age: "Tuổi không được rỗng",
                        }
                    });
                    if ($("#formAge").valid()) {
                        $.post(url + "admin/addNewAndUpdateAge", {
                            _token: _token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataAge: ageView.AgeObject
                        }, function (data) {
                            if (data[0] === 1) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                ageView.fillTbody(data, '');
                            } else if (data[0] === 2) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                ageView.fillTbody(data, '');
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
    });
</script>