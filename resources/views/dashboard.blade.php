<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Shortened Links List -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Shortened Links</h3>
                        <ul>
                            <!-- Loop through shortened links -->
                            @foreach($links as $link)
                                <li class="mb-2 flex items-center justify-between">
                                    <div>
                                        <a href="{{ $link->slug }}" target="_blank" class="text-blue-500 hover:underline">
                                            {{ $link->slug }}
                                        </a>
                                        <span class="text-sm font-normal text-gray-500">
                                            ({{ $link->redirects_count }} {{ $link->redirects_count === 1 ? 'redirect' : 'redirects' }})
                                        </span>
                                        <p class="text-sm text-gray-500">Target: {{ $link->target }}</p>
                                    </div>
                                    <form action="{{ route('links.destroy', $link) }}" method="POST" class="ml-2">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">
                                            Remove
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        {{ $links->links() }}
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Create Shortened Link Form -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Create New Shortened Link</h3>
                        <form action="{{ route('links.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="target" class="block text-gray-700 dark:text-gray-300">Target URL</label>
                                <input type="url" id="target" name="target" required class="w-full p-2 border border-gray-300 dark:border-gray-600 dark:text-gray-800 rounded-lg">
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Shorten URL
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>