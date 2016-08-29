@if($detailedTreatments)
    @foreach($detailedTreatments as $detail)
        <tr>
            {{--<td style="width: 3%;">{{ \App\LocationTreatment::where('id',$detail->locationId)->first()->name }}</td>--}}
            {{--@foreach($rows as $item)--}}
            <td>{{$detail->sesameName}}</td>
            <td name="">{{$detail->professionalName}}</td>
            <td>{{$detail->locationName}}</td>
            <td>
                {{--<select class="form-control" id="TherapistId" name="TherapistId">--}}
                    {{--@if($detail->detailTherapist !==0 )--}}
                        {{--<option value="{{$detail->detailTherapist}}">{{\App\ManagementTherapist::where('id',$detail->detailTherapist)->first()->name}}</option>--}}
                        {{--@foreach($therapists as $item)--}}
                            {{--@if($item->id === $detail->detailTherapist)--}}
                            {{--@else--}}
                                {{--<option value="{{$item->id}}">{{$item->name}}</option>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--@else--}}
                        {{--@if($therapists)--}}
                            {{--<option value="0">Chuyên viên</option>--}}
                            {{--@foreach($therapists as $item)--}}
                                {{--<option value="{{$item->id}}">{{$item->name}}</option>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--@endif--}}
                {{--</select>--}}
                <input type="text" class="form-control"
                       id="TherapistId"
                       name="TherapistId"
                       placeholder="Nguyễn Văn A"
                        value="{{$detail->detailTherapist}}">
            </td>
            <td>
                <select class="form-control" id="Status" name="Status">
                    @if($detail->detailAil ===1 )
                        <option value="1">Đau</option>
                        <option value="0">Không đau</option>
                    @elseif($detail->detailAil ===0)
                        <option value="0">Không đau</option>
                        <option value="1">Đau</option>
                    @else
                        <option value="2">Tình trạng</option>
                        <option value="1">Đau</option>
                        <option value="0">Không đau</option>
                    @endif
                </select>
            </td>
            <td>
                @if($detail->detailAil !==2 && \Auth::User()->name === 'admin' )
                    <button type="button" class="btn blue"
                            id="{{$detail->detailId}}"
                            name="saveDetail"
                            style="background-color:#00a859;color:#ffffff"
                            role="{{\Auth::User()->name}}"
                            onclick="professionalView.saveDetail(this)">
                        Sửa
                    </button>
                @elseif($detail->detailTherapist ===0 || \Auth::User()->name === 'admin')
                    <button type="button" class="btn blue"
                            id="{{$detail->detailId}}"
                            name="saveDetail"
                            role="{{\Auth::User()->name}}"
                            onclick="professionalView.saveDetail(this)">
                        Lưu
                    </button>
                @endif

            </td>
            {{--@endforeach--}}
        </tr>
        {{--@endforeach--}}
        {{--@endfor--}}
    @endforeach
@endif
{{--<script>--}}
    {{--//setup before functions--}}
    {{--var typingTimer;                //timer identifier--}}
    {{--var doneTypingInterval = 1000;  //time in ms, 3 second for example--}}
    {{--var $input = $("input#TherapistId").focusin();--}}

    {{--//on keyup, start the countdown--}}
    {{--$input.on('keyup', function () {--}}
        {{--clearTimeout(typingTimer);--}}
        {{--typingTimer = setTimeout(doneTyping, doneTypingInterval);--}}
    {{--});--}}

    {{--//on keydown, clear the countdown--}}
    {{--$input.on('keydown', function () {--}}
        {{--clearTimeout(typingTimer);--}}
    {{--});--}}

    {{--//user is "finished typing," do something--}}
    {{--function doneTyping() {--}}
        {{--console.log($input);--}}
        {{--$.get(url + 'admin/getSearchCodeTherapist', {--}}
            {{--_token: _token,--}}
            {{--Code: $input.val()--}}
        {{--}, function (data) {--}}
            {{--console.log(data);--}}
            {{--if (data === "0") {--}}
                {{--$("div#modalContent").empty().append("Không tìm thấy mã vừa nhập");--}}
                {{--$("button[name=modalAgree]").hide();--}}
                {{--$("input[name=Id]").val("");--}}
                {{--$("div#modalConfirm").modal("show");--}}
                {{--$input.val("");--}}
            {{--} else if (data === "2") {--}}
{{--//                        $("div#modalContent").empty().append("Vui lòng nhập mã chính xác");--}}
{{--//                        $("button[name=modalAgree]").hide();--}}
{{--//                        $("input[name=Id]").val("");--}}
{{--//                        $("div#modalConfirm").modal("show");--}}
            {{--} else {--}}
                {{--//$input.val(data[0]["code"]);--}}
            {{--}--}}
        {{--});--}}
    {{--}--}}
{{--</script>--}}