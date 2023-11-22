<div class="gap-2">
    <div class="flex justify-between gap-4">
        <div class="flex gap-2 my-1 py-1   justify-center">
            <x-label  for="radio1" value="{{ __('بالتجميعي') }}"/>
            <x-input type="radio" class="ml-4" wire:model="By" name="radio1" value="1" />

            <x-label  for="radio2" value="{{ __('بفروع المصارف') }}"/>
            <x-input type="radio" class="ml-4" wire:model="By" name="radio2" value="2"/>
        </div>

        <div class="flex gap-1">
            <span>طباعة</span>
                <a  href="{{route('pdfbanksum',['By'=>$By])}}"  class="text-blue-400">
                    <x-icon.print/>
                </a>
        </div>
    </div>
    <div x-show="$wire.By==2">
    <x-table  class="table-fixed font-medium ">
        <x-slot name="head">
            <x-table.heading  class="w-4/12 text-right ">المصرف</x-table.heading>
            <x-table.heading  class="w-2/12 text-right">العدد</x-table.heading>
            <x-table.heading  class="w-2/12 text-right">اجمالي العقود</x-table.heading>
            <x-table.heading  class="w-2/12 text-right">المدفوع</x-table.heading>
            <x-table.heading  class="w-2/12 text-right">الباقي</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @forelse ($BankSum as $item)
                <x-table.row  wire:loading.class.delay="opacity-75" class=" text-sm py-2 " >
                    <x-table.cell py="py-1" >{{$item->bank_name}}</x-table.cell>
                    <x-table.cell  >{{$item->count}}</x-table.cell>
                    <x-table.cell  >{{$item->sul}}</x-table.cell>
                    <x-table.cell  >{{$item->pay}}</x-table.cell>
                    <x-table.cell  >{{$item->raseed}}</x-table.cell>
                </x-table.row>
            @empty
                <x-table.row colspan="9">
                    <x-table.cell colspan="9">
                        <div class="flex justify-center items-center space-x-2">
                            <span>لم يتم ادخال أقساط بعد ..</span>

                        </div>

                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table>
    {{$BankSum->links('Mypaginator')}}
</div>
<div x-show="$wire.By==1">
    <x-table x-show="$wire.By==1" class="table-fixed font-medium ">
        <x-slot name="head">
            <x-table.heading  class="w-4/12 text-right "> المصرف التجميعي</x-table.heading>
            <x-table.heading  class="w-2/12 text-right">العدد</x-table.heading>
            <x-table.heading  class="w-2/12 text-right">اجمالي العقود</x-table.heading>
            <x-table.heading  class="w-2/12 text-right">المدفوع</x-table.heading>
            <x-table.heading  class="w-2/12 text-right">الباقي</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @forelse ($TajSum as $item)
                <x-table.row  wire:loading.class.delay="opacity-75" class=" text-sm py-2 " >
                    <x-table.cell py="py-1" >{{$item->taj_name}}</x-table.cell>
                    <x-table.cell  >{{$item->count}}</x-table.cell>
                    <x-table.cell  >{{$item->sul}}</x-table.cell>
                    <x-table.cell  >{{$item->pay}}</x-table.cell>
                    <x-table.cell  >{{$item->sul-$item->pay}}</x-table.cell>
                </x-table.row>
            @empty
                <x-table.row colspan="9">
                    <x-table.cell colspan="9">
                        <div class="flex justify-center items-center space-x-2">
                            <span>لم يتم ادخال أقساط بعد ..</span>

                        </div>

                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table>
    {{$TajSum->links('Mypaginator')}}
</div>

</div>

</div>
