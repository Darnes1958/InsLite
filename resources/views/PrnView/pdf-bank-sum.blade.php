@extends('PrnView.PrnMaster')

@section('mainrep')
    <div>

        <div style="text-align: center">
            <label style="font-size: 10pt;">{{$RepDate}}</label>

            <label style="font-size: 14pt;margin-right: 12px;" >تقرير بإجمالي العقود حسب المصارف بتاريخ : </label>
        </div>

        <table style="width:  90%; margin-left: 5%;margin-right: 5%; margin-bottom: 4%; margin-top: 2%;">
            <thead style="  margin-top: 8px;">
            <tr style="background: #9dc1d3;">

                <th style="width: 14%">المسدد</th>
                <th style="width: 14%">اجمالي العقود</th>
                <th style="width: 14%">عدد العقود</th>
                <th>اسم المصرف</th>

            </tr>
            </thead>
            <tbody id="addRow" class="addRow">
            @foreach($RepTable as  $item)
                <tr >

                    <td> {{ number_format($item->pay,2, '.', ',') }} </td>
                    <td> {{ number_format($item->sul,2, '.', ',') }} </td>
                    <td> {{ $item->count }} </td>
                   @if($By==1)
                      <td> {{ $item->taj_name }} </td>
                    @else ($By==2)
                       <td> {{ $item->bank_name }} </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>



@endsection

