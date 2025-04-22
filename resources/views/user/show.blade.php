<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-6">
                <h2 class="text-2xl font-semibold mb-4">User Details</h2>

                <div class="mb-4">
                    <p class="text-gray-600 text-sm">Name:</p>
                    <p class="text-lg text-gray-900 font-medium">{{ $user->name }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-gray-600 text-sm">Email:</p>
                    <p class="text-lg text-gray-900 font-medium">{{ $user->email }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-gray-600 text-sm">Role:</p>
                    <p class="text-lg text-gray-900 font-medium capitalize">{{ $user->role }}</p>
                </div>

                <div class="mt-6 flex gap-4">
                    <a href="{{ route('users.edit', $user) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded shadow">
                        Edit
                    </a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded shadow">
                            Delete
                        </button>
                    </form>
                    <a href="{{ route('users.index') }}" class="text-sm text-gray-600 hover:underline">
                        Back to list
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
