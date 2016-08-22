{{--Model--}}

<div class="modal fade" id="modalConfirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">Are you sure delete ?</div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal" name="modalClose">Hủy</button>
                <button type="button" class="btn green" name="modalAgree"
                        onclick="tmPackageView.modalAgree()">Đồng Ý
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
            <h4 style="color: #00a859">Danh mục > Chi tiết điều trị</h4>
            <hr style="margin-top: 0px;">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Phiếu Điều Trị</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">
                        <button type="button" class="btn btn-danger btn-circle"
                                onclick="tmPackageView.deleteTmPackage()"><i
                                    class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <table class="table table-bordered table-hover order-column" id="tableTmPackageList"
                           style="margin-bottom: 0px;">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Gói</th>
                            <th>Loại điều trị</th>
                            <th>Điều Trị Chuyên Môn</th>

                        </tr>
                        </thead>
                        <tbody id="tbodyTmPackageList">
                        {{--@foreach($tmPackages as $item)--}}
                            {{--<tr id="{{$item->id}}" onclick="tmPackageView.viewListTmPackages(this)"--}}
                                {{--style="cursor: pointer">--}}
                                {{--<td>{{$item->code}}</td>--}}
                                {{--<td>{{$item->name}}</td>--}}
                                {{--<td>{{$item->package()->price}}</td>--}}
                                {{--<td>{{$item->createdDate}}</td>--}}
                                {{--<td>{{$item->updateDate}}</td>--}}
                                {{--<td hidden>{{$item->package()->name}}</td>--}}
                                {{--<td hidden>{{$item->Patient()->fullName}}</td>--}}
                                {{--<td hidden>{{$item->note}}</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="color: #00a859;font-size: 17px;">Thêm mới | Chỉnh sửa</div>
                    <div style="position: absolute;margin: -25px 0px 0px 450px;">
                        <button type="button" class="btn btn-info btn-circle"
                                onclick="tmPackageView.addNewTmPackage('')"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="portlet-body form">
                        <form role="form" id="formTmPackage">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group form-md-line-input" style="display:none">
                                        <input type="text" class="form-control" name="Id" id="Id">
                                    </div>
                                    <div class="form-group form-md-line-input"></div>
                                    <div class="form-group form-md-line-input">
                                        <label for="fullName">Tên Bênh Nhân</label>
                                        <input type="text" class="form-control"
                                               id="FullName"
                                               name="FullName"
                                               placeholder="Tên Bênh Nhân">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Code">Code</label>
                                        <input type="text" readonly="readonly" class="form-control"
                                               id="Code"
                                               name="Code"
                                               placeholder="Code">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Code">Giới Tính</label>
                                        <input type="text"  class="form-control"
                                               id="Sex"
                                               name="Sex"
                                               placeholder="Giới Tính">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="PackageId">Gói</label>
                                        <select class="form-control" id="PackageId">
                                            {{--@if($Packages)--}}
                                                <option value="0">-- Chọn Gói --</option>
                                                {{--@foreach($Packages as $item)--}}
                                                    {{--<option value="{{$item->id}}">{{$item->name}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        </select>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="Name">Điều Trị Chuyên Môn</label>
                                        <select class="form-control" id="locationTreatmentId"
                                               name="locationTreatmentId">
                                            <option value="0">-- Chọn Điều Trị --</option>
                                        </select>
                                    </div>


                                    <div class="form-group form-md-line-input ">
                                        <label for="Note">Ghi chú</label>
                                        <textarea class="form-control" id="Note" name="Note" rows="5" cols="10"
                                                  placeholder="Nhập ghi chú"></textarea>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="form-actions noborder">
                        <div class="form-group" style="padding-left: 15px;">
                            <button type="button" class="btn blue"
                                    onclick="tmPackageView.addNewAndUpdateTmPackage()">
                                Hoàn tất
                            </button>
                            <button type="button" class="btn default" onclick="tmPackageView.Cancel()">Hủy
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<script>--}}
    {{--$(function () {--}}
        {{--if (typeof (tmPackageView) === 'undefined') {--}}
            {{--tmPackageView = {--}}
                {{--idTmPackage: null,--}}
                {{--goBack: null,--}}
                {{--TmPackagesObject: {--}}
                    {{--Id: null,--}}
                    {{--FullName: null,--}}
                    {{--Code: null,--}}
                    {{--Name: null,--}}
                    {{--Price: null,--}}
                    {{--CreateDate: null,--}}
                    {{--Note: null,--}}
                    {{--PackageId: null--}}
                {{--},--}}

                {{--resetTmPackageObject: function () {--}}
                    {{--for (var propertyName in tmPackageView.TmPackagesObject) {--}}
                        {{--if (tmPackageView.TmPackagesObject.hasOwnProperty(propertyName)) {--}}
                            {{--tmPackageView.TmPackagesObject.propertyName = null;--}}
                        {{--}--}}
                    {{--}--}}
                {{--},--}}

                {{--firstToUpperCase: function (str) {--}}
                    {{--return str.substr(0, 1).toUpperCase() + str.substr(1);--}}
                {{--},--}}
                {{--resetForm: function () {--}}
                    {{--if ($("input[name=Id]").val() === "") {--}}
                        {{--var allinput = $("input");--}}
                        {{--var alltextarea = $("textarea");--}}
                        {{--$("div[class=form-body]").find("select").val("0");--}}
                        {{--$("div[class=form-body]").find(allinput).val("");--}}
                        {{--$("div[class=form-body]").find(alltextarea).val("");--}}
                    {{--} else {--}}
                        {{--tmPackageView.viewListTmPackages(tmPackageView.goBack);--}}
                    {{--}--}}
                {{--},--}}
                {{--Cancel: function () {--}}
                    {{--tmPackageView.resetForm();--}}
                {{--},--}}
                {{--addNewTmPackage: function (result) {--}}
                    {{--if (result === "") {--}}
                        {{--$("input[name=Id]").val("");--}}
                        {{--$("textarea[name=Id]").val("");--}}
                        {{--tmPackageView.resetForm();--}}
                    {{--} else if (result === "delete") {--}}
                        {{--$("div#modalContent").empty().append("Xoá thành công");--}}
                        {{--$("button[name=modalAgree]").hide();--}}
                        {{--$("input[name=Id]").val("");--}}
                        {{--$("textarea[name=Id]").val("");--}}
                        {{--tmPackageView.resetForm();--}}
                    {{--}--}}
                {{--},--}}
                {{--viewListTmPackages: function (element) {--}}
                    {{--tmPackageView.goBack = element;--}}
                    {{--idTmPackage = $(element).attr("id");--}}
                    {{--tmPackageView.idTmPackage = $(element).attr("id");--}}
                    {{--$("tbody#tbodyTmPackageList").find("tr").removeClass("active");--}}
                    {{--$(element).addClass("active");--}}
                    {{--$.post(url + "admin/postViewTmPackage", {--}}
                        {{--_token: _token,--}}
                        {{--idTmPackage: tmPackageView.idTmPackage--}}
                    {{--}, function (data) {--}}
                        {{--$("input[name=Id]").empty().val(tmPackageView.idTmPackage)--}}
                        {{--for (var propertyName in data) {--}}
                            {{--$("input[name=FullName]").val($(element).find("td").eq(6).html());--}}
                            {{--$("input[name=price]").val($(element).find("td").eq(2).html());--}}
                            {{--$("input[name=CreateDate]").val($(element).find("td").eq(3).html());--}}
                            {{--$("select[id=" + tmPackageView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);--}}
                            {{--$("input[id=" + tmPackageView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);--}}
                            {{--$("textarea[id=" + tmPackageView.firstToUpperCase(propertyName) + "]").val(data[propertyName]);--}}
                        {{--}--}}
                    {{--});--}}
                {{--},--}}

                {{--fillTbody: function (data, result) {--}}
                    {{--$("tbody#tbodyTmPackageList").empty();--}}
                    {{--var row = "";--}}
                    {{--for (var i = 0; i < data["listTmPackage"].length; i++) {--}}
                        {{--var tr = "";--}}
                        {{--tr += "<tr id=" + data["listTmPackage"][i]["id"] + " onclick='tmPackageView.viewListTmPackages(this)' style='cursor: pointer'>";--}}
                        {{--tr += "<td>" + data["listTmPackage"][i]["Code"] + "</td>";--}}
                        {{--tr += "<td>" + data["listTmPackage"][i]["Name"] + "</td>";--}}
                        {{--tr += "<td>" + data["listTmPackage"][i]["Price"] + "</td>";--}}
                        {{--tr += "<td>" + data["listTmPackage"][i]["createdDate"] + "</td>";--}}
                        {{--tr += "<td>" + data["listTmPackage"][i]["updateDate"] + "</td>";--}}
                        {{--tr += "<td hidden>" + data["listTmPackage"][i]["PackageId"] + "</td>";--}}
                        {{--tr += "<td hidden>" + data["listTmPackage"][i]["FullName"] + "</td>";--}}
                        {{--tr += "<td hidden>" + data["listTmPackage"][i]["note"] + "</td>";--}}
                        {{--row += tr;--}}
                    {{--}--}}
                    {{--$("tbody#tbodyTmPackageList").append(row);--}}
                    {{--tmPackageView.idTmPackage = null;--}}
                    {{--tmPackageView.addNewTmPackage(result);--}}
                {{--},--}}
                {{--deleteTmPackage: function () {--}}
                    {{--if ($("input[name=Id]").val() === "") {--}}
                        {{--$("div#modalConfirm").modal("show");--}}
                        {{--$("div#modalContent").empty().append("Vui lòng chọn điều trị cần xoá");--}}
                        {{--$("button[name=modalAgree]").hide();--}}
                    {{--} else {--}}
                        {{--$("div#modalConfirm").modal("show");--}}
                        {{--$("div#modalContent").empty().append("Bạn có chắc xóa ?");--}}
                        {{--$("button[name=modalAgree]").show();--}}
                    {{--}--}}
                {{--},--}}
                {{--modalAgree: function () {--}}
                    {{--if (idTmPackage !== null) {--}}
                        {{--$.post(url + "admin/deleteTmPackage", {--}}
                            {{--_token: _token,--}}
                            {{--idTmPackage: idTmPackage--}}
                        {{--}, function (data) {--}}
                            {{--if (data[0] === 1) {--}}
                                {{--tmPackageView.fillTbody(data, 'delete');--}}
                            {{--}--}}
                        {{--});--}}
                    {{--}--}}
                {{--},--}}
                {{--addNewAndUpdateTmPackage: function () {--}}
                    {{--tmPackageView.resetTmPackageObject();--}}
                    {{--for (var i = 0; i < Object.keys(tmPackageView.TmPackagesObject).length; i++) {--}}
                        {{--tmPackageView.TmPackagesObject[Object.keys(tmPackageView.TmPackagesObject)[i]] = $("#" + Object.keys(tmPackageView.TmPackagesObject)[i]).val();--}}
                    {{--}--}}
                    {{--$("#formTmPackage").validate({--}}
                        {{--rules: {--}}
                            {{--FullName: "required",--}}
                        {{--},--}}
                        {{--messages: {--}}
                            {{--FullName: "Tên gói khôg được rỗng",--}}
                        {{--}--}}
                    {{--});--}}
                    {{--if ($("#formTmPackage").valid()) {--}}
                        {{--$.post(url + "admin/addNewAndUpdateTmPackage", {--}}
                            {{--_token: _token,--}}
                            {{--addNewOrUpdateId: $("input[name=Id]").val(),--}}
                            {{--dataTmPackage: tmPackageView.TmPackagesObject--}}
                        {{--}, function (data) {--}}
                            {{--if (data[0] === 1) {--}}
                                {{--$("div#modalConfirm").modal("show");--}}
                                {{--$("div#modalContent").empty().append("Thêm mới thành công");--}}
                                {{--$("button[name=modalAgree]").hide();--}}
                                {{--tmPackageView.fillTbody(data, '');--}}
                            {{--} else if (data[0] === 2) {--}}
                                {{--$("div#modalConfirm").modal("show");--}}
                                {{--$("div#modalContent").empty().append("Chỉnh sửa thành công");--}}
                                {{--$("button[name=modalAgree]").hide();--}}
                                {{--tmPackageView.fillTbody(data, '');--}}
                            {{--} else if (data[0] === 0) {--}}
                                {{--$("div#modalConfirm").modal("show");--}}
                                {{--$("div#modalContent").empty().append("Chỉnh sửa KHÔNG thành công");--}}
                                {{--$("button[name=modalAgree]").hide();--}}
                            {{--}--}}
                            {{--else {--}}
                                {{--$("div#modalConfirm").modal("show");--}}
                                {{--$("div#modalContent").empty().append("Thêm mới KHÔNG thành công");--}}
                                {{--$("button[name=modalAgree]").hide();--}}
                            {{--}--}}
                        {{--})--}}
                    {{--}--}}
                {{--}--}}
            {{--}--}}
        {{--}--}}
    {{--})--}}
{{--</script>--}}