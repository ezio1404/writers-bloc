<div class="w-3/12 bg-white rounded p-3 shadow-lg fixed h-full">
    <div class="flex items-center space-x-4 p-2 mb-5">
        <img class="h-12 rounded-full"
            src="http://www.gravatar.com/avatar/2acfb745ecf9d4dccb3364752d17f65f?s=260&d=mp" alt="James Bhatta">
        <div>
            <h4 class="font-semibold text-lg text-gray-700 capitalize font-poppins tracking-wide">{{ Auth::user()->name}}</h4>
        </div>
    </div>
    <ul class="space-y-2 text-sm">
        <li>
            <a href="{{ route('teacher-home')}}"
                class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 @if(Request::path() === 'teacher') bg-gray-200 font-bold @else focus:bg-gray-200 @endif focus:shadow-outline">
                <span class="text-gray-600">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('teacher-lesson')}}"
                class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 @if(Request::path() === 'teacher/lesson') bg-gray-200 font-bold @else focus:bg-gray-200 @endif  focus:shadow-outline">
                <span class="text-gray-600">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                        </path>
                    </svg>
                </span>
                <span> {{ __('Lessons') }}</span>
            </a>
        </li>

        <li>
            <a href="{{ route('teacher-student')}}"
                class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 @if(Request::path() === 'teacher/student') bg-gray-200 font-bold @else focus:bg-gray-200 @endif  focus:shadow-outline">
                <span class="text-gray-600">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <span> {{ __('Students') }}</span>
            </a>
        </li>
        <div class="border border-red-500">
            <ul>
                <li class="text-red-500 font-bold">
                    backlog:
                    my profile, settings, change password
                </li>
                <li >
                    <a href="#"
                        class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 @if(Request::path() === 'teacher/profile') bg-gray-200 font-bold @else focus:bg-gray-200 @endif focus:shadow-outline">
                        <span class="text-gray-600">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span>My profile</span>
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 @if(Request::path() === 'teacher/settings') bg-gray-200 font-bold @else focus:bg-gray-200 @endif focus:shadow-outline">
                        <span class="text-gray-600">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                                </path>
                            </svg>
                        </span>
                        <span>Settings</span>
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 @if(Request::path() === 'teacher/change-password') bg-gray-200 font-bold @else focus:bg-gray-200 @endif focus:shadow-outline">
                        <span class="text-gray-600">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <span>Change password</span>
                    </a>
                </li>
            </ul>
        </div>


        <li>
            <a  href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
                class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                <span class="text-gray-600">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </span>
                <span>{{ __('Logout') }}</span>
            </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            {{ csrf_field() }}
        </form>
        </li>
    </ul>
</div>
