{{--Model--}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Chắc chắn xoá ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Đóng</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="">Tiếp tục
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
            <h4 style="color: #00a859">Quản lí > Chức vụ</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row" >
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Danh sách chức vụ</div>
                </div>
                <div class="table-responsive" style="height: 208px; overflow: scroll">
                    <table class="table table-bordered table-hover order-column" id="tablePositionViewList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Tên chức vụ</th>
                            <th>Diễn giải</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyPositionList">
                        @if($Positions)
                            @foreach($Positions as $item)
                                <tr id="{{$item->id}}" onclick="positionView.viewListPosition(this)"
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
                    <div style="color: #00a859;font-size: 17px;">Thêm mới | Chỉnh sửa
                        <button type="button" class="btn btn-info btn-circle pull-right" onclick="positionView.addNewPosition()"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formPosition">
                            <div class="form-body">
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
                                               placeholder="Trực tiếp điều trị cho bệnh nhân">
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <div class="form-group" style="padding-left: 15px;">
                                        <button type="button" class="btn blue"
                                                onclick="positionView.addNewAndUpdatePosition()">
                                            Hoàn tất
                                        </button>
                                        <button type="button" class="btn default" onclick="positionView.Cancel()">Huỷ</button>
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
        if (typeof (positionView) === 'undefined') {
            positionView = {
                goBack: null,
                idPositionView: null,
                PositionViewObject: {
                    Id: null,
                    Name: null,
                    Description: null
                },
                resetPositionObject: function () {
                    for (var propertyName in positionView.PositionViewObject) {
                        if (positionView.PositionViewObject.hasOwnProperty(propertyName)) {
                            positionView.PositionViewObject.propertyName = null;
                        }
                    }
                },
                addNewPosition: function () {
                    //$("div#modalConfirm").modal("hide");
                    $("input[name=Id]").val("");
                    positionView.resetForm();
                },
                Cancel: function () {
                    positionView.resetForm();
                },
                firstToUpperCase: function (str) {
                    return str.substr(0, 1).toUpperCase() + str.substr(1);
                },
                resetForm: function () {
                    if ($("input[name=Id]").val() === "") {
                        var allinput = $("input");
                        $("div[class=form-body]").find(allinput).val("");
                    } else {
                        positionView.viewListPosition(positionView.goBack);
                    }
                },
                viewListPosition: function (element) {
                    positionView.goBack = element;
                    positionView.idPositionView = $(element).attr("id");
                    $("tbody#tbodyPositionList").find("tr").removeClass("active");
                    $(element).addClass("active");
                    $.post(url + "admin/postViewPosition", {
                        _token: _token,
                        idPosition: positionView.idPositionView
                    }, function (data) {
                        $("input[name=Id]").empty().val(positionView.idPositionView)
                        for (var propertyName in data) {
                            $("input[id=" + positionView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);
                        }
                    })
                },
                fillTbody: function (data) {
                    $("tbody#tbodyPositionList").empty();
                    var row = "";
                    for (var i = 0; i < data["listPosition"].length; i++) {
                        var tr = "";
                        tr += "<tr id=" + data["listPosition"][i]["id"] + " onclick='positionView.viewListPosition(this)' style='cursor: pointer'>";
                        tr += "<td>" + data["listPosition"][i]["name"] + "</td>";
                        tr += "<td>" + data["listPosition"][i]["description"] + "</td>";
                        row += tr;
                    }
                    $("tbody#tbodyPositionList").append(row);
                    positionView.idPositionView = null;
                    positionView.addNewPosition();
                },
                addNewAndUpdatePosition: function () {
                    positionView.resetPositionObject();
                    for (var i = 0; i < Object.keys(positionView.PositionViewObject).length; i++) {
                        positionView.PositionViewObject[Object.keys(positionView.PositionViewObject)[i]] = $("#" + Object.keys(positionView.PositionViewObject)[i]).val();
                    }
                    $("#formPosition").validate({
                        rules: {
                            Name: 'required'
                        },
                        messages: {
                            Name: "Tên chức vụ không được rỗng",
                        }
                    });
                    if ($("#formPosition").valid()) {
                        $.post(url + "admin/addNewAndUpdatePosition", {
                            _token: _token,
                            addNewOrUpdateId: $("input[name=Id]").val(),
                            dataPosition: positionView.PositionViewObject
                        }, function (data) {
                            if (data[0] === 1) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Thêm mới thành công");
                                $("button[name=modalAgree]").hide();
                                positionView.fillTbody(data);
                            } else if (data[0] === 2) {
                                $("div#modalConfirm").modal("show");
                                $("div#modalContent").empty().append("Chỉnh sửa thành công");
                                $("button[name=modalAgree]").hide();
                                positionView.fillTbody(data);
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