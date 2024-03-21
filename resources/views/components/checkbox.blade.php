<div class=" mb-2 " >
    <div class="flex gap-2">
        <label for="{{$idAttribute}}" class="flex  cursor-pointer select-none text-dark dark:text-white" >
            <div class="relative" >
                <input type="checkbox" id="{{$idAttribute}}" class="peer sr-only checkelement" onchange="show(this)"/>
                <div class="block h-5 rounded-full  bg-gray-200 w-9 peer-checked:bg-red-500" ></div>
                <div class="absolute w-[13px] h-[13px] transition bg-white rounded-full  left-1 bottom-1 top-[3.5px] peer-checked:translate-x-full peer-checked:bg-white "></div>
            </div>
        </label>
        <a class="text-sm">{{$slot}}</a>
       </div>
    {{-- <div id="legendHGU" class=" pb-4" style="display: none !important;">
        <div class="pl-9 " >
            <div class="flex items-center rounded mt-2">
                <div class="w-4 h-3 ml-2" style="background-color: #3C7A89"></div>
                <label for="asetpemerintahdaerah" class="w-full ml-1 text-xs ">HGU</label>
            </div>
        </div>
    </div> --}}
</div>


