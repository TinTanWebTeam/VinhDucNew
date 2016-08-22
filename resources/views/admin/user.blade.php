{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Chắt chắn xoá ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Đóng</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="userView.modalAgree()">Tiếp tục
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
            <h4 style="color: #00a859">Quản lý > Người dùng</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6" style="height: 660px; overflow: scroll">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Danh sách người dùng
                        {{--<button type="button" class="btn btn-danger btn-circle pull-right"--}}
                                {{--onclick="userView.deleteUser()"><i--}}
                                    {{--class="fa fa-times"></i>--}}
                        {{--</button>--}}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover order-column" id="tableUserList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Tài khoản</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Chức vụ</th>
                            <th>Quyền</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyUserList">
                        @if($users)
                            @foreach($users as $item)
                                <tr id="{{$item->id}}" onclick="userView.viewListUser(this)"
                                    style="cursor: pointer">
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->fullName}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->Position()->name}}</td>
                                    <td>{{$item->Role()->name}}</td>
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
                        <button type="button" class="btn btn-info btn-circle pull-right"
                                onclick="userView.addNewUser('')"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form" id="formUser">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input" style="display:none">
                                    <input type="text" class="form-control" name="Id" id="Id">
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label for="RoleId"><b>Quyền</b></label>
                                    <select class="form-control" id="RoleId">
                                        @foreach($roles as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label for="PositionId"><b>Chức vụ</b></label>
                                    <select class="form-control" id="PositionId">
                                        @foreach($positions as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label for="Name"><b>Tên đăng nhập</b></label>
                                    <input type="text" class="form-control"
                                           id="Name"
                                           name="Name"
                                           maxlength="20"
                                           minlength="6"
                                           placeholder="Tên đăng nhập có ít nhất 6 kí tự">
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label for="Password"><b>Mật khẩu</b></label>
                                    <input type="password" class="form-control"
                                           id="Password"
                                           name="Password"
                                           maxlength="20"
                                           minlength="6"
                                           placeholder="Mật khẩu có ít nhất 6 kí tự">
                                </div>
                                <div class="form-group form-md-line-input ">
                                    <label for="PasswordConfirm"><b>Nhập lại mật khẩu</b></label>
                                    <input type="Password" class="form-control"
                                           id="PasswordConfirm"
                                           name="PasswordConfirm"
                                           maxlength="20"
                                           minlength="6"
                                           placeholder="Nhập lại mật khẩu">
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label for="FullName"><b>Họ và tên</b></label>
                                    <input type="text" class="form-control"
                                           id="FullName"
                                           name="FullName"
                                           placeholder="Nhập họ tên">
                                </div>
                                <div class="form-group form-md-line-input">
                                    <label for="Email"><b>Email</b></label>
                                    <input type="text" class="form-control"
                                           id="Email"
                                           name="Email"
                                           onclick="userView.checkEmail()"
                                           onchange="userView.checkEmail()"
                                           placeholder="Nhập email">
                                    <label id="Email" style="display: none">Email đã tồn tại</label>
                                </div>
                            </div>
                            <div class="form-actions noborder">
                                <div class="form-group" style="padding-left: 15px;">
                                    <button type="button" class="btn blue"
                                            onclick="userView.addNewAndUpdateUser()">
                                        Hoàn tất
                                    </button>
                                    <button type="button" class="btn default" onclick="userView.Cancel()">Huỷ</button>
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
        idUsers = null;
        if (typeof (userView) === 'undefined') {
            userView = {
                goBack: null,
                idUser: null,
                UserObject: {
                    Id: null,
                    Name: null,
                    Email: null,
                    FullName: null,
                    Password: null,
                    RoleId: null,
                    PositionId: null
                },
                resetUserObject: function () {
                    for (var propertyName in userView.UserObject) {
                        if (userView.UserObject.hasOwnProperty(propertyName)) {
                            userView.UserObject.propertyName = null;
                        }
                    }
                },
                firstToUpperCase: function (str) {
                    return str.substr(0, 1).toUpperCase() + str.substr(1);
                },
                resetForm: function () {
                    if ($("input[name=Id]").val() === "") {
                        var allinput = $("input");
                        $("div[class=form-body]").find(allinput).val("");
                    } else {
                        userView.viewListUser(userView.goBack);
                    }
                },
                Cancel: function () {
                    userView.resetForm();
                },
                viewListUser: function (element) {
                    userView.goBack = element;
                    idUser = $(element).attr("id");
                    userView.idUser = $(element).attr("id");
                    $("tbody#tbodyUserList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewUser", {
                        _token: _token,
                        idUser: userView.idUser
                    }, function (data) {
                        $("input[name=Id]").empty().val(userView.idUser)
                        for (var propertyName in data) {
                            $("select[id=" + userView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("input[id=" + userView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                fillTbody: function (data, result) {
                    $("tbody#tbodyUserList").empty();
                    var row = "";
                    for (var i = 0; i < data["listUser"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listUser"][i]["id"] + " onclick='userView.viewListUser(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listUser"][i]["name"] + "</td>";
                        tr += "<td>" + data["listUser"][i]["fullName"] + "</td>";
                        tr += "<td>" + data["listUser"][i]["email"] + "</td>";
                        tr += "<td>" + data["listUser"][i]["position"] + "</td>";
                        tr += "<td>" + data["listUser"][i]["role"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyUserList").append(row);
                    userView.idUser = null;
                    userView.addNewUser(result);
                },
                deleteUser: function () {
                    if(idUsers==null) {
                        $("div#modalContent").empty().append("Vui lòng chọn người dùng để xoá");
                        $("button[name=modalAgree]").hide();
                        $("div#modalConfirm").modal("show");
                    }else{
                        $("div#modalContent").empty().append("Chắc chắn xoá ?");
                        $("button[name=modalAgree]").show();
                        $("div#modalConfirm").modal("show");
                    }
                },
                modalAgree: function () {
                    if (idUser !== null) {
                        $.post(url + "admin/deleteUser", {
                            _token: _token,
                            idUser: idUser
                        }, function (data) {
                            if (data[0] === 1) {
                                idUsers==null,
                                userView.fillTbody(data, 'delete');
                            }
                        });
                    }
                    else {
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Vui lòng chọn tài khoản cần xoá");
                        $("button[name=modalAgree]").hide();
                    }
                },
                addNewUser: function (result) {
                    if (result === "") {
                        //$("div#modalConfirm").modal("hide");
                        $("input[name=Id]").val("");
                        userView.resetForm();
                    } else if (result === "delete") {
                        $("div#modalContent").empty().append("Xoá thành công");
                        $("button[name=modalAgree]").hide();
                        $("input[name=Id]").val("");
                        therapistView.resetForm();
                    }

                },
                checkEmail: function () {
                    $("label#Email").hide();
                },
                addNewAndUpdateUser: function () {
                    userView.resetUserObject();
                    for (var i = 0; i < Object.keys(userView.UserObject).length; i++) {
                        userView.UserObject[Object.keys(userView.UserObject)[i]] = $("#" + Object.keys(userView.UserObject)[i]).val();
                    }
                    if ($("input[name=Id]").val().length == 0 || ($("input[name=Id]").val().length > 0 && $("input[name=Password]").val().length > 0)) {
                        $("#formUser").validate({
                            rules: {
                                Name: {
                                    required: true,
                                    minlength: 6,
                                    maxlength: 20
                                },
                                Password: {
                                    required: true,
                                    minlength: 6,
                                    maxlength: 20
                                },
                                PasswordConfirm: {
                                    required: true,
                                    equalTo: "#Password",
                                    minlength: 6,
                                    maxlength: 20
                                },
                                Email: {
                                    required: true,
                                    email: true
                                }
                            },
                            messages: {
                                Name: {
                                    required: "Tên đăng nhập không được rỗng",
                                    minlenght: "Tên đăng nhập phải từ 6 kí tự đến 20 kí tự",
                                    maxlenght: "Tên đăng nhập phải từ 6 kí tự đến 20 kí tự"
                                },
                                Password: {
                                    required: "Mật khẩu không được rỗng",
                                    minlenght: "Mật khẩu phải từ 6 kí tự đến 20 kí tự",
                                    maxlenght: "Mật khẩu nhập phải từ 6 kí tự đến 20 kí tự"
                                },
                                PasswordConfirm: {
                                    required: "Nhập lại mật khẩu không đúng",
                                    equalTo: "Nhập lại mật khẩu không đúng",
                                    minlenght: "Mật khẩu nhập phải từ 6 kí tự đến 20 kí tự",
                                    maxlenght: "Mật khẩu nhập phải từ 6 kí tự đến 20 kí tự"
                                },
                                Email: {
                                    required: "Email không được rỗng.",
                                    email: 'Email không đúng định dạng'
                                }
                            }
                        });
                    } else if ($("input[name=Id]").val().length > 0 && $("input[name=Password]").val().length == 0) {
                        $("#formUser").validate({
                            rules: {
                                Name: {
                                    required: true,
                                    minlength: 6,
                                    maxlength: 20

                                },
                                Email: {
                                    required: true,
                                    email: true
                                }
                            },
                            messages: {
                                Name: {
                                    required: "Tên đăng nhập không được rỗng,",
                                    minlenght: "Tên đăng nhập phải từ 6 kí tự đến 20 kí tự",
                                    maxlenght: "Tên đăng nhập phải từ 6 kí tự đến 20 kí tự"
                                },
                                Email: {
                                    required: "Email không được rỗng.",
                                    email: 'Email không đúng định dạng'
                                }
                            }
                        });
                    }
                    if ($("#formUser").valid()) {
                        $.post(url + "admin/addNewAndUpdateUser", {
                            _token: _token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataUser: userView.UserObject
                        }, function (data) {
                            console.log(data);
                            if (data[0] !== 3) {
                                if (data[0] === 1) {
                                    idUsers=null;
                                    $("div#modalConfirm").modal("show");
                                    $("div#modalContent").empty().append("Thêm mới thành công");
                                    $("button[name=modalAgree]").hide();
                                    userView.fillTbody(data, '');
                                } else if (data[0] === 2) {
                                    idUsers=null;
                                    $("div#modalConfirm").modal("show");
                                    $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                    $("button[name=modalAgree]").hide();
                                    userView.fillTbody(data, '');
                                } else if (data[0] === 0) {
                                    $("div#modalConfirm").modal("show");
                                    $("div#modalContent").empty().append("Chỉnh sửa KHÔNG thành công");
                                    $("button[name=modalAgree]").hide();
                                }
                                else {
                                    $("div#modalConfirm").modal("show");
                                    $("div#modalContent").empty().append("Thêm mới KHÔNG thành công. Kiểm tra tài khoản");
                                    $("button[name=modalAgree]").hide();
                                }
                            } else {
                                $("label#Email").show();
                            }
                        })
                    }else{
                        $("form#formUser").find("label[class=error]").css("color","red");
                    }
                }
            }
        }
    })
</script>