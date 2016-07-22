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
            <h4>Quản lí > Người dùng</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #158cba;font-size: 17px;">User List</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">
                        <button type="button" class="btn btn-danger btn-circle" onclick="userView.deleteUser()"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <table class="table table-bordered table-hover order-column" id="tableUserList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Tài khoản</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
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
                    <div style="color: #158cba;font-size: 17px;">AddNew | UpDate</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">
                        <button type="button" class="btn btn-info btn-circle" onclick="userView.addNewUser()"><i class="fa fa-plus"></i>
                        </button>
                    </div>

                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="addAndUpdateId">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="RoleId">Quyền</label>
                                        <select class="form-control" id="RoleId">
                                            @foreach($roles as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Name">Tên đăng nhập</label>
                                        <input type="text" class="form-control"
                                               id="Name"
                                               placeholder="Tên đăng nhập">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Password">Mật khẩu</label>
                                        <input type="password" class="form-control"
                                               id="Password"
                                               placeholder="Nhập mật khẩu">
                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <label for="Password">Nhập lại mật khẩu</label>
                                        <input type="Password" class="form-control"
                                               id="Password"
                                               placeholder="Nhập lại mật khẩu">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="FullName">Họ và tên</label>
                                        <input type="text" class="form-control"
                                               id="FullName"
                                               placeholder="Nhập họ tên">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Email">Email</label>
                                        <input type="text" class="form-control"
                                               id="Email"
                                               placeholder="Nhập email">
                                    </div>
                                    <div class="form-actions noborder">
                                        <button type="button" class="btn blue">Submit</button>
                                        <button type="button" class="btn default">Cancel</button>
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
        if (typeof (userView) === 'undefined') {
            userView = {
                idUser: null,
                UserObject: {
                    Id: null,
                    Name: null,
                    Email: null,
                    FullName: null,
                    Password: null,
                    RoleId: null
                },
                firstToUpperCase: function (str) {
                    return str.substr(0, 1).toUpperCase() + str.substr(1);
                },
                resetForm:function () {
                    if($("input[name=addAndUpdateId]").val()===""){
                        var allinput = $("input");
                        $("div[class=form-body]").find(allinput).val("");
                    }
                },
                viewListUser: function (element) {
                    userView.idUser = $(element).attr("id");
                    $("tbody#tbodyUserList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewUser", {
                        _token: _token,
                        idUser: userView.idUser
                    }, function (data) {
                        $("input[name=addAndUpdateId]").empty().val($(element).attr("data-userId"))
                        for (var propertyName in data) {
                            $("select[id=" + userView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                            $("input[id=" + userView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                deleteUser: function () {
                    if(userView.idUser!==null) {
                        $.post(url + "admin/deleteUser", {
                            _token: _token,
                            idUser: userView.idUser
                        }, function (data) {
                            if (data[0] === 1) {

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
                                userView.idUser=null;
                                userView.addNewUser();
                            }
                        });
                    }
                    else{
                        $("div#modalConfirm").modal("show");
                        $("div#modalContent").empty().append("Vui lòng chọn tài khoản cần xoá");
                        $("button[name=modalAgree]").hide();
                    }
                },
                addNewUser:function () {
                    $("input[name=addAndUpdateId]").val("");
                    userView.resetForm();
                }
            }
        }
    })
</script>