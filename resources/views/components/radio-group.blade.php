<div x-data="{
    radioGroupSelectedValue: null,
    radioGroupOptions: @js($options)
}" class="space-y-3 mb-4">
    <template x-for="(option, index) in radioGroupOptions" :key="index">
        <label @click="radioGroupSelectedValue = option.value" class="flex items-start p-5 space-x-3 bg-white border rounded-md shadow-sm hover:bg-gray-50 border-neutral-200/70">
            <input
                type="radio"
                name="radio-group"
                :value="option.value"
                class="text-gray-900 translate-y-px focus:ring-red-700"
                x-model="radioGroupSelectedValue"
                required
            />
            <span class="relative flex flex-col text-left space-y-1.5 leading-none">
                <span x-text="option.title" class="font-semibold"></span>
                <span x-text="option.description" class="text-sm opacity-50"></span>
            </span>
        </label>
    </template>
</div>
