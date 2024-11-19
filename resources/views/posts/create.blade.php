<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un post') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="my-5 ">
        @foreach ($errors->all() as $error)
            <span class=" block text-red-500">{{ $error }}</span>    
        @endforeach
                 
        </div>
            
   

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf
            <x-input-label for="title" :value="__('Titre du post')" />
            <x-text-input id="title" type="text" name="title" />

            <x-input-label for="content" :value="__('Contenu du post')" />
            <x-text-input id="content" name="content" />

          

            <x-input-label for="image" :value="__('Image')" />
            <x-text-input id="image" type="file" name="image" />

            <x-input-label for="category" :value="__('Category du post')" />
            <select name="category" id="category">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            
            <x-primary-button style="display: block !important" class="mt-10">{{ __('Créer') }}</x-primary-button>
                           



        </form>

    </div>
</x-app-layout>
