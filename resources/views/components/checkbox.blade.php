<div class=" mb-2 " x-data={download:false}>
    <div class="flex gap-2">
        <label for="{{$idAttribute}}" class="flex  cursor-pointer select-none text-dark dark:text-white" >
            <div class="relative" >
                <input type="checkbox" id="{{$idAttribute}}" class="peer sr-only checkelement" @click="download=!download" />
                <div class="block h-5 rounded-full  bg-gray-200 w-9 peer-checked:bg-red-500" ></div>
                <div class="absolute w-[13px] h-[13px] transition bg-white rounded-full  left-1 bottom-1 top-[3.5px] peer-checked:translate-x-full peer-checked:bg-white "></div>
            </div>
        </label>
        <div class="flex flex-col ">
            <a  class="text-sm">{{$slot}}</a>
            <a href="" x-show="download" class="text-xs flex items-center cursor-pointer text-atas">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                  </svg>
                  <span class="mt-1">download</span>
            </a>
        </div>

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


