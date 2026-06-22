<x-app-layout>
    <style>
        button {
            border: 1px solid #333;
            padding: 4px 12px;
            cursor: pointer;
            background-color: #f0f0f0;
            border-radius: 4px;
        }
        a button {
            display: inline-block;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            アニメレビューサイト
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="/2026-winter"><button>2026冬アニメ</button></a>
        </div>
    </div>
</x-app-layout>
