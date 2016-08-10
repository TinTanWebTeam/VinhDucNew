@if($detailedTreatments)
    @foreach($detailedTreatments as $detail)
        {{--<tr>--}}
            {{--<td colspan="1"></td>--}}
        {{--</tr>--}}
        {{--@foreach($detail as $rows)--}}
        {{--@for($i = 0;$i<count($detail);$i++)--}}
            <tr>
                <td style="width: 3%;">{{ \App\locationTreatment::where('id',$detail->locationId)->first()->name }}</td>
                {{--@foreach($rows as $item)--}}
                    <td id="check" name="">{{$detail->professionalName}}</td>
                    <td>
                        <select class="form-control" name="TherapistId">
                            <option value="0">Chuyên viên</option>
                            @if($therapists)
                                @foreach($therapists as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="Status">
                            <option value="2">Tình trạng</option>
                            <option value="1">Đau</option>
                            <option value="0">Không đau</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn blue"
                                onclick="professionalView.saveDetail(this)">
                            Lưu
                        </button>
                    </td>
                {{--@endforeach--}}
            </tr>
        {{--@endforeach--}}
            {{--@endfor--}}
    @endforeach
@endif