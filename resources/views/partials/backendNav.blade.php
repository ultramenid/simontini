<div class="border-b border-gray-300 bg-gray-100 dark:bg-newgray-900 bg-opacity-90 dark:border-opacity-20  z-10 ">
    <div class="max-w-6xl mx-auto px-6 "  x-data="{ pages: false }">
        <nav class="-mb-px flex space-x-4 text-sm leading-5 overflow-x-auto scrollbar-hide text-gray-500">
            <div class="hover:bg-gray-200 dark:hover:bg-newgray-700 py-3 px-2 rounded @if($nav == 'dashboard' )border-b-2  dark:border-gray-300 border-newgray-900 @endif ">
                <a href="{{url('/cms/dashboard')}}" class=" px-0.5  @if($nav == 'dashboard' )   text-newgray-900 dark:text-gray-300 @endif   hover:text-newgray-900 dark:hover:text-gray-300 cursor-pointer" >Dashboard</a>
            </div>

            <div class="hover:bg-gray-200 dark:hover:bg-newgray-700 py-3 px-2 rounded @if($nav == 'faq' )border-b-2  dark:border-gray-300 border-newgray-900 @endif ">
                <a href="{{url('/cms/listfaq')}}" class=" px-0.5  @if($nav == 'faq' )   text-newgray-900 dark:text-gray-300 @endif   hover:text-newgray-900 dark:hover:text-gray-300 cursor-pointer" >faq</a>
            </div>

            <div class="hover:bg-gray-200 dark:hover:bg-newgray-700 py-3 px-2 rounded @if($nav == 'news' )border-b-2  dark:border-gray-300 border-newgray-900 @endif ">
                <a href="{{url('/cms/listnews')}}" class=" px-0.5  @if($nav == 'news' )   text-newgray-900 dark:text-gray-300 @endif   hover:text-newgray-900 dark:hover:text-gray-300 cursor-pointer" >news</a>
            </div>

            <div @click="pages = ! pages" @click.away="pages=false" class=" cursor-pointer flex-col flex hover:bg-gray-200 dark:hover:bg-newgray-700 py-3  rounded @if($nav == 'pages' )border-b-2  dark:border-gray-300 border-newgray-900 @endif " x-data="{pages:false}">
                <a   class="px-2 hover:text-newgray-900 dark:hover:text-gray-300 cursor-pointer inline-flex   items-center @if($nav == 'pages') text-newgray-900 dark:text-gray-300 @endif"  >Pages
                    <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': pages, 'rotate-0': !pages}" class="w-4 ml-1 -mb-1 transition-transform duration-200 transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
                <div class=" flex flex-col space-y-3  w-40  rounded absolute sm:mt-10 mt-10 z-20 bg-gray-200 dark:bg-newgray-700  px-4 py-2" x-show="pages" x-cloak style="display: none !important">
                    <a  href="{{url('/cms/pageabout')}}" class="hover:text-newgray-900 dark:hover:text-gray-300">about</a>
                    <a  href="{{url('/cms/termofuse')}}" class="hover:text-newgray-900 dark:hover:text-gray-300">termofuse</a>
                    <a  href="{{url('/cms/cmsatbd')}}" class="hover:text-newgray-900 dark:hover:text-gray-300">ATBD</a>

                </div>
            </div>


        </nav>
    </div>
</div>
