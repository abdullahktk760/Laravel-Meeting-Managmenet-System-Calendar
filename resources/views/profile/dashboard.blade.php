<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>New Notifications</h1>
                        @foreach (auth()->user()->unreadNotifications as $item)
                         <div class="bg-blue-300 p-3 m-2">

                            <b>{{$item->data['name']}}</b> Are Following You!!
                            <a href="{{url('mark-read/'.$item->id)}}" class="bg-red-300 text-dark px-4 py-2 rounded-lg">Mark As Read</a>

                        </div>
                        @endforeach
                </div>
                <h1>Read Notifications</h1>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach (auth()->user()->notifications as $item)
                     <div class="bg-blue-300 p-3 m-2">

                        <b>{{$item->data['name']}}</b> Are Following You!!
                        <a href="{{url('mark-read/'.$item->id)}}" class="bg-red-300 text-dark px-4 py-2 rounded-lg">Mark As Read</a>

                    </div>
                    @endforeach
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
