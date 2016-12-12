{{--Model--}}

<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Bạn có chắc xóa ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Hủy</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="">Đồng ý
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

        <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Đổi mật khẩu

                    </div>

                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formChangePassword">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id" value="">
                                    </div>
                                    <div class="form-group form-md-line-input"></div>
                                    <div class="form-group form-md-line-input">
                                        <label for="packageName">Nhập mật khẩu mới</label>
                                        <input type="password" class="form-control"
                                               id="Password"
                                               name="Password">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="price">Nhập lại mật khẩu</label>
                                        <input type="password" class="form-control"
                                               id="PasswordConfirm"
                                               name="PasswordConfirm">
                                    </div>

                                </div>
                                <div class="form-actions noborder">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <button type="button" class="btn blue"
                                                nameUser="{{\Auth::user()->name}}"
                                                onclick="changePassword.success(this)">
                                            Hoàn tất
                                        </button>
                                        <button type="button" class="btn default" onclick="changePassword.cancel()">Hủy
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
    if (typeof (changePassword) === 'undefined') {
        changePassword = {
            success:function (element) {

                $("#formChangePassword").validate({
                    rules: {
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
                        }
                    },
                    messages: {
                        Password: {
                            required: "Mật khẩu không được rỗng",
                            minlength: "Mật khẩu nhập phải ít nhất 6 kí tự"
                        },
                        PasswordConfirm: {
                            required: "Nhập lại mật khẩu không đúng",
                            equalTo: "Nhập lại mật khẩu không đúng",
                            minlength: "Mật khẩu nhập phải ít nhất 6 kí tự",
                        }
                    }
                });
                if ($("#formChangePassword").valid()) {
                    $.post(url + "admin/changePassword", {
                        _token: _token,
                        nameUser:$(element).attr("nameUser"),
                        Password:$("input#Password").val()
                    }, function (data) {
                        if (data === "1") {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Đổi mật khẩu thành công");
                            $("button[name=modalAgree]").hide();
                        } else {
                            $("div#modalConfirm").modal("show");
                            $("div#modalContent").empty().append("Đổi mật khẩu KHÔNG thành công");
                            $("button[name=modalAgree]").hide();
                        }
                    })

                }
            },
            cancel:function () {
                $("input#Password").val("");
                $("input#PasswordConfirm").val("");
            }
        }
    }
</script>
