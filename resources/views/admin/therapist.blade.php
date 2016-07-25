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
            <h4>Quản lí > Điều trị viên</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #158cba;font-size: 17px;">Danh sách điều trị viên</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">
                        <button type="button" class="btn btn-danger btn-circle" onclick="roleView.deleteUser()"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <table class="table table-bordered table-hover order-column" id="tableUserList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Họ và tên</th>
                            <th>Giới tính</th>
                            <th>Số điện thoại</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyUserList">
                        {{--@if($users)--}}
                        {{--@foreach($users as $item)--}}
                        {{--<tr id="{{$item->id}}" onclick="userView.viewListUser(this)"--}}
                        {{--style="cursor: pointer">--}}
                        {{--<td>{{$item->name}}</td>--}}
                        {{--<td>{{$item->fullName}}</td>--}}
                        {{--<td>{{$item->email}}</td>--}}
                        {{--<td>{{$item->Role()->name}}</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--@endif--}}
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
                        <form role="form" id="formTherapist">
                            <div class="form-body">
                                <div class="form-group form-md-line-input" style="display:none">
                                    <input type="text" class="form-control" name="Id" id="Id">
                                </div>
                                <div class="form-group form-md-line-input col-md-12">
                                    <label for="Code"><b>Mã</b></label>
                                    <input type="text" class="form-control"
                                           id="Code"
                                           name="Code"
                                           placeholder="BN001">
                                </div>
                                <div>
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="Name"><b>Họ và tên</b></label>
                                        <input type="text" class="form-control"
                                               id="Name"
                                               name="Name"
                                               placeholder="Nguyễn Văn A">
                                    </div>
                                    <div class="form-group form-md-line-input col-md-6">
                                        <label for="Sex"><b>Giới tính</b></label>
                                        <input type="text" class="form-control"
                                               id="Sex"
                                               name="Sex"
                                               placeholder="Nam">
                                    </div>
                                </div>


                                <div class="form-group form-md-line-input col-md-12">
                                    <label for="Address"><b>Địa chỉ</b></label>
                                    <input type="text" class="form-control"
                                           id="Address"
                                           name="Address"
                                           onclick=""
                                           onchange=""
                                           placeholder="562/2A Lê Quang Định Gò Vấp">
                                    <label id="Email" style="display: none">Email đã tồn tại</label>
                                </div>
                                <div>
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="ProvincialId"><b>Thành phố/ Tỉnh</b></label>
                                        <select class="form-control" id="RoleId">
                                            {{--@foreach($roles as $item)--}}
                                            {{--<option value="{{$item->id}}">{{$item->name}}</option>--}}
                                            {{--@endforeach--}}
                                        </select>
                                    </div>
                                    <div class="form-group form-md-line-input col-md-12">
                                        <label for="Phone"><b>Số điện thoại</b></label>
                                        <input type="text" class="form-control"
                                               id="Phone"
                                               name="Phone"
                                               onclick=""
                                               onchange=""
                                               placeholder="093266xxx">
                                        <label id="Email" style="display: none">Email đã tồn tại</label>
                                    </div>
                                </div>

                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" onclick="roleView.addNewAndUpdateUser()">
                                        Submit
                                    </button>
                                    <button type="button" class="btn default">Cancel</button>
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
        if (typeof (therapistView) === 'undefined') {
            therapistView = {
                idRole: null,
                RoleObject: {
                    Id: null,
                    Name: null,
                    Descriptione: null
                },
            }
        }
    })
</script>