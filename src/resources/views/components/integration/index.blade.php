<div>
    <div>
        <div class="relative p-5 mt-5">
            <div class="max-w-sm rounded overflow-hidden shadow-lg" data-tilt data-tilt-glare
                 data-tilt-max-glare="0.2" data-tilt-perspective="1000">
                <img class="mx-auto"
                     src={{$image}}
                     height="200px"
                     width="200px" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{$title}}</div>
                    <p class="text-gray-700 text-base">
                        {{$description}}
                    </p>
                </div>
                @if(!$route)
                    <div class="mb-2">
                        <button class="bg-wave-400 ml-5 hover:bg-wave-500 text-white font-bold py-1.5 px-4 rounded-full"
                                type="button" data-modal-toggle="authentication-modal">
                            Submit
                        </button>
                    </div>
                @else
                    <div class="mb-4">
                        <a href='{{$route}}' role="button" id="click"
                           class="bg-wave-400 my-5 ml-5 hover:bg-wave-500 text-white font-bold py-2 px-4 rounded-full">
                            Submit
                        </a>
                    </div>
                @endif

            </div>

        </div>
    </div>
</div>