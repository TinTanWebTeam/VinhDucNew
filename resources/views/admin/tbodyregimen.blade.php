@if($detailedTreatments)
    @foreach($detailedTreatments as $detail)
        {{--<tr>--}}
        {{--<td colspan="1"></td>--}}
        {{--</tr>--}}
        {{--@foreach($detail as $rows)--}}
        {{--@for($i = 0;$i<count($detail);$i++)--}}
        <tr>
            <td style="width: 3%;">{{ \App\LocationTreatment::where('id',$detail->locationId)->first()->name }}</td>
            {{--@foreach($rows as $item)--}}
            <td name="">{{$detail->professionalName}}</td>
            <td>
                <select class="form-control" name="TherapistId">
                    @if($detail->detailTherapist !==0 )
                        <option value="{{$detail->detailTherapist}}">{{\App\ManagementTherapist::where('id',$detail->detailTherapist)->first()->name}}</option>
                        @foreach($therapists as $item)
                            @if($item->id === $detail->detailTherapist)
                            @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    @else
                        @if($therapists)
                            <option value="0">Chuyên viên</option>
                            @foreach($therapists as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        @endif
                    @endif
                </select>
            </td>
            <td>
                <select class="form-control" name="Status">
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
            {{--<td>--}}
                {{--@if($detail->detailTherapist !==0 || $detail->detailAil !==2 )--}}
                    {{--<button type="button" class="btn blue"--}}
                            {{--id="{{$detail->professionalId}}"--}}
                            {{--style="background-color:#00a859;color:#ffffff"--}}
                            {{--onclick="professionalView.saveDetail(this)">--}}
                        {{--Sửa--}}
                    {{--</button>--}}
                {{--@else--}}
                    {{--<button type="button" class="btn blue"--}}
                            {{--id="{{$detail->professionalId}}"--}}
                            {{--onclick="professionalView.saveDetail(this)">--}}
                        {{--Lưu--}}
                    {{--</button>--}}
                {{--@endif--}}

            {{--</td>--}}
            {{--@endforeach--}}
        </tr>
        {{--@endforeach--}}
        {{--@endfor--}}
    @endforeach
@endif