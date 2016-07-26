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
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">
                        <button type="button" class="btn btn-danger btn-circle" onclick="positionView.deleteUser()"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <table class="table table-bordered table-hover order-column" id="tablePositionViewList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Họ và tên</th>
                            <th>Giới tính</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyPositionViewList">
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
                        <button type="button" class="btn btn-info btn-circle" onclick="positionView.addNewUser()"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formPatient">
                            <div class="form-body">
                                <div>
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-md-line-input">
                                            <label for="Name"><b>Tên chức vụ</b></label>
                                            <input type="text" class="form-control"
                                                   id="Name"
                                                   name="Name"
                                                   placeholder="bác sĩ">
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label for="Description"><b>Diễn giải</b></label>
                                            <input type="text" class="form-control"
                                                   id="Description"
                                                   name="Description"
                                                   placeholder="Trực tiếp điều trịc ho bệnh nhân">
                                        </div>
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
        if (typeof (positionView) === 'undefined') {
            positionView = {
                idPositionView: null,
                PositionViewObject: {
                    Id: null,
                    Name: null,
                    Description: null
                },
            }
        }
    })
</script>