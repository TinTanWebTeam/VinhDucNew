{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Are you sure delete ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Close</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="">Save changes
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
            <h4>Quản lí > Chức vụ</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #158cba;font-size: 17px;">Danh sách chức vụ</div>
                    {{--<div style="position: absolute;margin: -25px 0px 0px 450px;">--}}
                    {{--<button type="button" class="btn btn-danger btn-circle" onclick="roleView.deleteUser()"><i--}}
                    {{--class="fa fa-times"></i>--}}
                    {{--</button>--}}
                    {{--</div>--}}
                </div>
                <div>
                    <table class="table table-bordered table-hover order-column" id="tableUserList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Tên chức vụ</th>
                            <th>Diễn giải</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyRoleList">
                        @if($roles)
                            @foreach($roles as $item)
                                <tr id="{{$item->id}}" onclick="roleView.viewListRole(this)"
                                    style="cursor: pointer">
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->description}}</td>
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
                    <div style="color: #158cba;font-size: 17px;">Thêm mới | Chỉnh sửa</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">
                        <button type="button" class="btn btn-info btn-circle" onclick="roleView.addNewUser()"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formRole">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input" style="display()">
                                        <input type="text" class="form-control" name="Id" id="Id">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Name"><b>Tên chức vụ</b></label>
                                        <input type="text" class="form-control"
                                               id="Name"
                                               name="Name"
                                               placeholder="root">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Description"><b>Diễn giải</b></label>
                                        <input type="text" class="form-control"
                                               id="Description"
                                               name="Description"
                                               placeholder="Quyền cao nhất">
                                    </div>
                                </div>

                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" onclick="roleView.addNewAndUpdateUser()">
                                        Submit
                                    </button>
                                    <button type="button" class="btn default" onclick="roleView.Cancel()">Cancel
                                    </button>
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
        if (typeof (roleView) === 'undefined') {
            roleView = {
                goBack: null,
                idRole: null,
                RoleObject: {
                    Id: null,
                    Name: null,
                    Description: null
                },
                firstToUpperCase: function (str) {
                    return str.substr(0, 1).toUpperCase() + str.substr(1);
                },
                addNewUser: function () {
                    $("input[name=Id]").val("");
                    roleView.resetForm();
                },
                resetForm: function () {
                    if ($("input[name=Id]").val() === "") {
                        var allinput = $("input");
                        $("div[class=form-body]").find(allinput).val("");
                    } else {
                        roleView.viewListRole(roleView.goBack);
                    }
                },
                viewListRole: function (element) {
                    roleView.goBack = element;
                    roleView.idRole = $(element).attr("id");
                    $("tbody#tbodyRoleList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewRole", {
                        _token: _token,
                        idRole: roleView.idRole
                    }, function (data) {
                        $("input[name=Id]").empty().val(roleView.idRole)
                        for (var propertyName in data) {
                            $("input[id=" + roleView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                Cancel: function () {
                    roleView.resetForm();
                },
                resetRoleObject: function () {
                    for (var propertyName in roleView.RoleObject) {
                        if (roleView.RoleObject.hasOwnProperty(propertyName)) {
                            roleView.RoleObject.propertyName = null;
                        }
                    }
                },
                fillTbody: function (data) {
                    $("tbody#tbodyUserList").empty();
                    var row = "";
                    for (var i = 0; i < data["listUser"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listUser"][i]["id"] + " onclick='userView.viewListUser(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listUser"][i]["name"] + "</td>";
                        tr += "<td>" + data["listUser"][i]["fullName"] + "</td>";
                        tr += "<td>" + data["listUser"][i]["email"] + "</td>";
                        tr += "<td>" + data["listUser"][i]["role"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyUserList").append(row);
                    userView.idUser = null;
                    userView.addNewUser();
                },
                addNewAndUpdateUser: function () {
                    roleView.resetRoleObject();
                    for (var i = 0; i < Object.keys(roleView.RoleObject).length; i++) {
                        roleView.RoleObject[Object.keys(roleView.RoleObject)[i]] = $("#" + Object.keys(roleView.RoleObject)[i]).val();
                    }
                    $("#formRole").validate({
                        rules: {
                            Name: "required"
                        },
                        messages: {
                            Name: "Tên chức vụ không được để trống"
                        }
                    });
                    if($("#formRole").valid()){
                        $.post(url+"admin/addNewAndUpdateRole",{
                            _token:_token,
                            addNewOrUpdateId:$("input[name=Id]").val(),
                            dataUser: roleView.RoleObject
                        },function (data) {
                            console.log(data);
                            if (data[0] === 1) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                userView.fillTbody(data);
                            } else if (data[0] === 2) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                userView.fillTbody(data);
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