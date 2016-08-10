@if($professional)
    @foreach($professional as $pro)
        <tr>
            <td colspan="1">{{ \App\locationTreatment::where('id',$pro->locationId)->first()->name }}</td>
        </tr>
        @foreach(array_chunk($pro->toArray,2)as $rows)
            <tr>
                <td style="width: 3%;"></td>
                @foreach($rows as $item)
                    <td id="check" name="{{$item->id}}">{{$item->name}}</td>
                    <td>
                        <select class="form-control" name="TherapistId">
                            <option value="0">Chuyên viên</option>
                            {{--@if($therapists)--}}
                                {{--@foreach($therapists as $item)--}}
                                    {{--<option value="{{$item->id}}">{{$item->name}}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
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
                @endforeach
            </tr>
        @endforeach
    @endforeach
@endif