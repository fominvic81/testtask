@props(['name', 'label', 'value', 'highlighted'])

{{-- TODO: fix styles when too many tags are added --}}
<div>
    <label for="{{ $name }}-id" class="block indent-2 w-full">{{ $label }}</label>
    <div
        class="flex p-2 w-fill h-12 bg-white border border-gray-300 rounded-md"
        x-data="{
            tags: {{ json_encode(empty($value) ? [] : $value) }},
            highlighted: {{ json_encode(empty($highlighted) ? [] : $highlighted) }},
            input: '',
            highlight: '',
            addTag () {
                this.highlight = this.tags.includes(this.input) ? this.input : '';
                if (this.input && !this.tags.includes(this.input)) {
                    this.tags.push(this.input);
                }
                this.input = '';
            },
        }"
    >
        <template x-for="(tag, index) in tags">
            <div x-bind:class="`px-2 mx-1 rounded-md flex items-center ${highlight === tag ? 'bg-blue-300' : highlighted.includes(tag) ? 'bg-red-400' : 'bg-gray-200'} border border-gray-300`">
                <span x-text="tag"></span>
                <button type="button" x-on:click="tags = tags.filter(x => x !== tag)" class="block hover:bg-red-400 rounded-sm w-4 h-4 ml-1">
                    <x-svg name="cross" class=""></x-svg>
                </button>
                <input type="hidden" x-bind:name="`{{ $name }}[${index}]`" x-bind:value="tag">
            </div>
        </template>
        <input class="mx-1 grow outline-none" id="{{ $name }}-id" type="text" placeholder="Введіть теги" x-model="input"
            x-on:keydown.space.prevent="addTag()"
            x-on:keydown.enter.prevent="addTag()"
            x-on:keydown.escape="input = ''"
            x-on:keydown.backspace="!input && tags.pop()"
            x-on:input="$event.target.value = $event.target.value.replaceAll(/[^\p{L}\p{M}\p{N}\s]/gu, '').toLowerCase()"
            x-on:click.outside="addTag()"
            x-on:blur="addTag()"
            x-on:paste.prevent.stop="tags = [...new Set([...tags, ...($event.clipboardData || window.clipboardData).getData('Text').replaceAll(/[\s,]+/g, ' ').replaceAll(/[^\p{L}\p{M}\p{N}\s]/gu, '').toLowerCase().split(' ')])]"
        >
    </div>
</div>
