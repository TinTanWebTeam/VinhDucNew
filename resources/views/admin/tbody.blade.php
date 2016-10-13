@if($detailedTreatments)
    {{--{{$i = 1}}--}}
    @foreach($detailedTreatments as $detail)

        <tr>
            {{--<td style="width: 3%;">{{ \App\LocationTreatment::where('id',$detail->locationId)->first()->name }}</td>--}}
            {{--@foreach($rows as $item)--}}

            {{--<td>{{$i}}</td>--}}
            <td>{{$detail->serial}}</td>
            <td>{{$detail->sesameName}}</td>
            <td name="">{{$detail->professionalName}}</td>
            <td>{{$detail->locationName}}</td>
            <td>{{$detail->time}}</td>
            <td>{{$detail->minute}}</td>

            @foreach($arraystatus as $item)
                @if($detail->detailId === $item["detailId"])
                    <td>
                        <input type="text" class="form-control"
                               id="{{$detail->serial}}"
                               style="min-width: 73px;"
                               name="TherapistId"
                               onchange="professionalView.searchTherapist(this)"
                               placeholder="Nguyễn Văn A"
                               value="{{$item["therapistCode"]}}">
                    </td>
                    <td>


                        @if($item["id"] === "")
                            <button type="button" class="btn blue"
                                    id="{{$detail->detailId}}"
                                    name="Start"
                                    {{--role="{{\Auth::User()->name}}">--}}
                                    onclick="professionalView.Start(this)">
                                Bắt đầu
                            </button>
                        @elseif($item["ail"] !==-1 && (\Auth::User()->positionId === 1 || \Auth::User()->positionId === 5))
                            <button type="button" class="btn blue"
                                    id="{{$detail->detailId}}"
                                    name="Start"
                                    style="background-color:#00a859;color:#ffffff"
                                    onclick="professionalView.Start(this)">
                                {{$item["dateStart"]}}
                            </button>
                        @elseif($item["therapistCode"]==="" || \Auth::User()->positionId === 1 ||\Auth::User()->positionId === 5)
                            <button type="button" class="btn blue"
                                    id="{{$detail->detailId}}"
                                    name="Start"
                                    {{--role="{{\Auth::User()->name}}">--}}
                                    onclick="professionalView.Start(this)">
                                Bắt đầu
                            </button>
                        @endif


                    </td>
                    <td>
                        <select class="form-control" id="Status" name="Status" style="min-width: 132px;">
                            @if($item["ail"] === "")
                                <option value="-1">Tình trạng</option>
                                <option value="1">Có đau</option>
                                <option value="0">Không đau</option>
                                <option value="2">Có giảm</option>
                                <option value="3">Không giảm</option>
                            @elseif($item["ail"] ===1 )
                                <option value="1">Có Đau</option>
                                <option value="0">Không đau</option>
                                <option value="2">Có giảm</option>
                                <option value="3">Không giảm</option>
                            @elseif($item["ail"] ===0)
                                <option value="0">Không đau</option>
                                <option value="1">Có đau</option>
                                <option value="2">Có giảm</option>
                                <option value="3">Không giảm</option>
                            @elseif($item["ail"] ===2)
                                <option value="2">Có giảm</option>
                                <option value="3">Không giảm</option>
                                <option value="1">Có Đau</option>
                                <option value="0">Không đau</option>
                            @elseif($item["ail"] ===3)
                                <option value="3">Không giảm</option>
                                <option value="2">Có giảm</option>
                                <option value="1">Có Đau</option>
                                <option value="0">Không đau</option>
                            @else
                                <option value="-1">Tình trạng</option>
                                <option value="1">Có đau</option>
                                <option value="0">Không đau</option>
                                <option value="2">Có giảm</option>
                                <option value="3">Không giảm</option>
                            @endif
                        </select>
                    </td>
                    <td>
                        @if($item["id"] === "")
                            <button type="button" class="btn blue"
                                    id="{{$detail->detailId}}"
                                    name="saveDetail"
                                    positionId="{{\Auth::User()->positionId}}"
                                    onclick="professionalView.saveDetail(this)">
                                Kết thúc
                            </button>
                        @elseif($item["ail"] !==-1 && (\Auth::User()->positionId === 1 || \Auth::User()->positionId === 5 ))
                            <button type="button" class="btn blue"
                                    id="{{$detail->detailId}}"
                                    name="saveDetail"
                                    style="background-color:#00a859;color:#ffffff"
                                    positionId="{{\Auth::User()->positionId}}"
                                    onclick="professionalView.saveDetail(this)">
                                {{$item["dateEnd"]}}
                            </button>
                        @elseif($item["therapistCode"]==="" || \Auth::User()->positionId === 1 ||\Auth::User()->positionId === 5)
                            <button type="button" class="btn blue"
                                    id="{{$detail->detailId}}"
                                    name="saveDetail"
                                    positionId="{{\Auth::User()->positionId}}"
                                    onclick="professionalView.saveDetail(this)">
                                Kết thúc
                            </button>
                        @endif
                    </td>
                @endif
            @endforeach
            {{--@endforeach--}}
        </tr>
        {{--@endforeach--}}
        {{--@endfor--}}

        {{--{{$i++}}--}}
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