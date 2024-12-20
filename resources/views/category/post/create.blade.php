<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un post') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @foreach ($errors->all() as $error)
            <span class="block text-red-500">{{ $error }}</span>
        @endforeach

        <form action="{{ route('categories.posts.store', $category) }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-input-label for="title" value="Titre du post" />
            <x-text-input id="title" name="title" />

            <x-input-label for="content" value="Contenu du post" />
            <textarea id="content" name="content"></textarea>

            <x-input-label for="image" value="Image du post" />
            <x-text-input type="file" id="image" name="image"/>

            <x-primary-button style="display: block !important" class="mt-10">Créer mon post</x-primary-button>
        </form>
    </div>
</x-app-layout>