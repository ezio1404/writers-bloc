<label class="block">
    <span class="text-gray-700 font-bold">{{ $title }}<span class="text-red-500">*</span></span>
    <input type="text"
        class="mt-1 mb-2 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
        placeholder="" name="{{ $field }}" value="{{  old($field) ?? $value }}">
    @error($field )
    <span class="text-red-500">{{ $message }}</span>
    @enderror
</label>
