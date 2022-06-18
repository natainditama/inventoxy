<nav class="w-full hidden md:block md:w-auto" id="mobile-menu">
    <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:font-medium">
        <li class="@if(Route::is('wardrobe.index')) text-blue-600 @else text-gray-700 @endif">
            <a href="{{ route('wardrobe.index') }}" class="block py-2 pr-4 pl-3 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 ">Wardrobe</a>
        </li>
        <li class="@if(Route::is('equipment.index')) text-blue-600 @else text-gray-700 @endif">
            <a href="{{ route('equipment.index') }}" class="block py-2 pr-4 pl-3 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 ">Equipment</a>
        </li>
        <li class="@if(Route::is('shooting.index')) text-blue-600 @else text-gray-700 @endif">
            <a href="{{ route('shooting.index') }}" class="block py-2 pr-4 pl-3 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 ">Shooting Activity</a>
        </li>
        <li class="@if(Route::is('pic.index')) text-blue-600 @else text-gray-700 @endif">
            <a href="{{ route('pic.index') }}" class="block py-2 pr-4 pl-3 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 ">PIC</a>
        </li>
    </ul>
</nav>