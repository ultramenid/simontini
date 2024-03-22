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

        </div>

       </div>

</div>


