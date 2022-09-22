<div class="max-w-6xl mx-auto">
    <div class="flex justify-end m-2 p-2">
        <x-jet-button wire:click="showPostModal">Create Post</x-jet-button>
    </div>
    <div class="m-2 p-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Id</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Title</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Body</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Image</th>
                                <th scope="col" class="relative px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($posts as $post )
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->body }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img class="w-8 h-8 rounded-full" src="{{ Storage::url($post->image) }}" />
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <div class="flex space-x-2">
                                        <x-jet-button wire:click="showEditPostModal({{ $post->id }})">Edit</x-jet-button>
                                        
                                        <x-jet-button class="bg-red-400" wire:click="deletePost({{ $post->id }})">Delete</x-jet-button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <!-- More items... -->
                        </tbody>
                    </table>
                    <div class="m-2 p-2">Pagination</div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <x-jet-dialog-modal wire:model="showingPostModal">
            @if ($isEditMode)
                <x-slot name="title">Edit Post</x-slot>
            @else
                <x-slot name="title">Create Post</x-slot>
            @endif
            
            <x-slot name="content">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form enctype="multipart/form-data">
                        <div class="sm:col-span-6">
                            @error('title') <span class="error">{{ $message }}</span> @enderror
                            <label for="title" class="block text-sm font-medium text-gray-700"> Post Title </label>
                            <div class="mt-1">
                                <input type="text" id="title" wire:model.lazy="title" name="title"
                                    class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Post Image </label>
                            @if ($oldImage)
                            Old Photo:
                            <img src="{{ Storage::url($oldImage) }}">
                            @endif

                            @if ($newImage)
                            Photo Preview:
                            <img src="{{ $newImage->temporaryUrl() }}">
                            @endif
                            <div class="mt-1">
                                <input type="file" id="image" wire:model="newImage" name="image"
                                    class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                        </div>

                        <div class="sm:col-span-6 pt-5">
                            @error('body') <span class="error">{{ $message }}</span> @enderror
                            <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                            <div class="mt-1">
                                <textarea id="body" rows="3" wire:model.lazy="body"
                                    class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </x-slot>
            <x-slot name="footer">
                @if ($isEditMode)
                   <x-jet-button wire:click="updatePost">Update Post</x-jet-button> 
                @else
                   <x-jet-button wire:click="storePost">Create Post</x-jet-button> 
                @endif
                
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>