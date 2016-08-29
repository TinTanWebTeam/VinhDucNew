{{--Model--}}

<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Bạn có chắc xóa ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Hủy</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="sourcecustomerView.modalAgree()">Đồng ý
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
            <h4 style="color: #00a859">Danh mục > Nguồn khách hàng</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Nguồn khách hàng</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">

                    </div>
                </div>
                <div style="height: 300px;overflow: scroll;">
                    <table class="table table-bordered table-hover order-column" id="tableSourceCustomerList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Nguồn khách hàng</th>
                        </tr>
                        </thead>
                        <tbody id="tbodySourceCustomerList">
                        @foreach($sourcecustomers as $item)
                            <tr id="{{$item->id}}" onclick="sourcecustomerView.viewListSourceCustomer(this)" style="cursor: pointer">
                                <td>{{$item->sourceCustomer}}</td>
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
                        <button type="button" class="btn btn-info btn-circle pull-right" onclick="sourcecustomerView.addNewSourceCustomer('')"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formSourceCustomer">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id" value="">
                                    </div>
                                    <div class="form-group form-md-line-input"></div>
                                    <div class="form-group form-md-line-input">
                                        <label for="SourceCustomer">Nguồn khách hàng</label>
                                        <input type="text" class="form-control"
                                               id="SourceCustomer"
                                               name="SourceCustomer"
                                               placeholder="Nguồn khách hàng">
                                    </div>

                                </div>
                                <div class="form-actions noborder">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <button type="button" class="btn blue"
                                                onclick="sourcecustomerView.addNewAndUpdateSourceCustomer()">
                                            Hoàn tất
                                        </button>
                                        <button type="button" class="btn default" onclick="sourcecustomerView.Cancel()">Hủy
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
        if (typeof (sourcecustomerView) === 'undefined') {
            sourcecustomerView = {
                goBack: null,
                idSourceCustomer: null,
                SourceCustomerObject: {
                    Id: null,
                    SourceCustomer: null,
                },
                resetSourceCustomerObject: function () {
                    for (var propertyName in sourcecustomerView.SourceCustomerObject) {
                        if (sourcecustomerView.SourceCustomerObject.hasOwnProperty(propertyName)) {
                            sourcecustomerView.SourceCustomerObject.propertyName = null;
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
                        sourcecustomerView.viewListSourceCustomer(sourcecustomerView.goBack);
                    }
                },
                Cancel: function () {
                    sourcecustomerView.resetForm();
                },

                addNewSourceCustomer: function (result) {
                    if (result === "") {
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        sourcecustomerView.resetForm();
                    } else if (result === "delete") {
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                        $("input[name=Id]").val("");
                        $("textarea[name=Id]").val("");
                        sourcecustomerView.resetForm();
                    }
                },

                viewListSourceCustomer: function (element) {
                    sourcecustomerView.goBack = element;
                    idSourceCustomer = $(element).attr("id");
                    sourcecustomerView.idSourceCustomer = $(element).attr("id");
                    $("tbody#tbodySourceCustomerList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewSourceCustomer", {
                        _token: _token,
                        idSourceCustomer: sourcecustomerView.idSourceCustomer
                    }, function (data) {
                        $("input[name=Id]").empty().val(sourcecustomerView.idSourceCustomer)
                        for (var propertyName in data) {
                            $("input[id=" + sourcecustomerView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("textarea[id=" + sourcecustomerView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                fillTbody: function (data, result) {
                    console.log(data["listSourceCustomer"]);
                    $("tbody#tbodySourceCustomerList").empty();
                    var row = "";
                    for (var i = 0; i < data["listSourceCustomer"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listSourceCustomer"][i]["id"] + " onclick='sourcecustomerView.viewListSourceCustomer(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listSourceCustomer"][i]["sourceCustomer"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodySourceCustomerList").append(row);
                    sourcecustomerView.idSourceCustomer = null;
                    sourcecustomerView.addNewSourceCustomer(result);

                },
                deleteSourceCustomer: function () {
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
                    if (idSourceCustomer !== null) {
                        $.post(url + "admin/deleteSourceCustomer", {
                            _token: _token,
                            idSourceCustomer: idSourceCustomer
                        }, function (data) {
                            if (data[0] === 1) {
                                sourcecustomerView.fillTbody(data, 'delete');
                            }
                        });
                    }

                },

                addNewAndUpdateSourceCustomer: function () {
                    sourcecustomerView.resetSourceCustomerObject();
                    for (var i = 0; i < Object.keys(sourcecustomerView.SourceCustomerObject).length; i++)
                    {
                        sourcecustomerView.SourceCustomerObject[Object.keys(sourcecustomerView.SourceCustomerObject)[i]] = $("#" + Object.keys(sourcecustomerView.SourceCustomerObject)[i]).val();
                    }
                    $("#formSourceCustomer").validate({
                        rules: {
                            SourceCustomer: "required",
                        },
                        messages: {
                            SourceCustomer: "Nguồn khách hàng không được rỗng",
                        }
                    });
                    if ($("#formSourceCustomer").valid()) {
                        $.post(url + "admin/addNewAndUpdateSourceCustomer", {
                            _token: _token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataSourceCustomer: sourcecustomerView.SourceCustomerObject
                        }, function (data) {
                            if (data[0] === 1) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                sourcecustomerView.fillTbody(data, '');
                            } else if (data[0] === 2) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                sourcecustomerView.fillTbody(data, '');
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
                        $("form#formSourceCustomer").find("label[class=error]").css("color","red");
                    }
                },
            }
        }
    });
</script>