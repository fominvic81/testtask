@props(['name', 'label', 'value', 'highlighted'])

<div
    x-data="{
        tags: {{ json_encode(empty($value) ? [] : $value) }},
        highlighted: {{ json_encode(empty($highlighted) ? [] : $highlighted) }},
        input: '',
        processInput () {
            this.input
                .replaceAll(/[^\p{L}\p{M}\p{N}]/gu, ' ')
                .toLowerCase()
                .split(' ')
                .filter(x => x && !this.tags.includes(x))
                .forEach(x => this.tags.push(x));
            this.input = '';
        },
    }">
    <label for="{{ $name }}-id" class="block indent-2 w-full">{{ $label }}</label>
    <input class="p-2 w-full bg-white border border-gray-300 rounded-md outline-none" id="{{ $name }}-id" type="text" placeholder="Введіть теги" x-model="input"
        x-on:keydown.enter.prevent="processInput()"
        x-on:keydown.escape="input = ''"
        x-on:click.outside="processInput()"
        x-on:blur="processInput()"
    >
    <div x-cloak x-show="tags.length" class="flex flex-wrap gap-2 m-2">
        <template x-for="(tag, index) in tags">
            <div x-bind:class="`w-min px-2 rounded-md flex items-center ${highlighted.includes(tag) ? 'bg-red-400' : 'bg-gray-50'} border border-gray-300`">
                <span x-text="tag"></span>
                <button type="button" x-on:click="tags = tags.filter(x => x !== tag)" class="block hover:bg-red-400 rounded-sm w-4 h-4 ml-1">
                    <x-svg name="cross" class=""></x-svg>
                </button>
                <input type="hidden" x-bind:name="`{{ $name }}[${index}]`" x-bind:value="tag">
            </div>
        </template>
    </div>
    
</div>
