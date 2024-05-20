<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>New Notifications</h1>

                </div>
            </div>
        </div>
    </div>

    <div class="pb-10">
        @if (session()->has('message'))
            <div class="w-1/2 mx-auto bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-5 border rounded-lg"
                role="alert">
                <p class="font-bold">Success! {{ session()->get('message') }} </p>

            </div>
        @endif

        <div class=" w-1/2 bg-neutral-100 mx-auto  p-6 shadow-md rounded-lg ">
            <p class="text-center font-bold text-xl">Form</p>
            <form action="{{ route('admin.store') }}" method="post">
                @csrf
                <!-- Name Input -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-grey">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name"
                        class="mt-1 p-2 w-full border rounded-md">
                    <div class="w-1/3 mt-2 bg-red-100  border-l-4 border-red-500 rounded-lg">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-grey">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com"
                        class="mt-1 p-2 w-full border rounded-md">
                    <div class="w-1/3 mt-2 bg-red-100  border-l-4 border-red-500 rounded-lg">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <!-- Password Input -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-grey">Password</label>
                    <input type="password" id="password" name="password" placeholder="*****"
                        class="mt-1 p-2 w-full border rounded-md">
                    <div class="w-1/2 mt-2 bg-red-100  border-l-4 border-red-500 rounded-lg">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray">Confirmed Password</label>
                    <input type="password" id="password" name="password_confirmation" placeholder="*****"
                        class="mt-1 p-2 w-full border rounded-md">
                </div>

                <!-- Submit Button -->
                <div class="mb-2 text-center">
                    <button type="submit"
                        class=" p-2 bg-blue-600  rounded-lg hover:bg-blue-100 focus:outline-none focus:bg-neutral-200">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="w-1/2 bg-neutral-100 mx-auto  p-6 shadow-lg mb-4 rounded-lg">
        <table id="myTable" class="w-full border border-grey-900 text-center" >
            <thead>
                <tr class="border text-center">
                    <th colspan=4 class="font-bold:lg p-2 ">Table Data</th>

                </tr>
                <tr class="border ">
                    <th class="p-2">Name</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Password</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $data)
                <tr class="border ">
                    <td class="p-2">{{$data->name}}</td>
                    <td class="p-2">{{$data->email}}</td>
                    <td class="p-2" >{{$data->password}}</td>
                    <td class="p-2"><a href="" class=" bg-green-600 rounded-lg p-1 text-white hover:bg-green-700 focus:bg-green-800"> Edit</a>
                     <a href="" class=" text-white bg-red-600 rounded-lg p-1 hover:bg-red-700 focus:bg-red-900"> Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- modal start --}}

<!-- Button to toggle modal -->

<!-- Modal toggle -->
<button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    Toggle modal
  </button>

  <!-- Main modal -->



<!-- Modal toggle -->

    </div>

<script>

document.addEventListener('DOMContentLoaded', function () {
    let modal = document.getElementById('authentication-modal');
    let modalToggles = document.querySelectorAll('[data-modal-toggle]');
    let modalHides = document.querySelectorAll('[data-modal-hide]');

    modalToggles.forEach(button => {
        button.addEventListener('click', function() {

            modal.style.display = 'block';
        });
    });

    modalHides.forEach(button => {
        button.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    });
});

</script>
</x-admin-layout>
