<div x-data="{showPassword : false}" @class(['mt-8'=>$page!=="profile", 'grow'=>$page=="profile"])>
    @if ($page !== 'profile')  <label for="{{ $id }}" class="text-gray-800 text-xs block mb-2">{{ $label }}</label>@endif
                <div @class(['relative flex items-center', 'rounded-md shadow-sm' => $errors->has($name) && $type !== 'file'])>
                  <input  id="{{ $id }}" name="{{ $name }}" x-bind:type="showPassword ? 'text' : '{{ $type }}'" value="{{ old($name) ?? $value }}"
                  @if($page == 'profile' && $id=='city_other') style="display:none;" @endif
                  @if ($type !== 'file')
                  @class([
                'w-full text-gray-800 text-sm border-b border-gray-300 focus:border-blue-600 px-2 py-3 outline-none',
                'pr-10 text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500' => $errors->has($name),
                'text-gray-900 shadow-sm ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600' => ! $errors->has($name),
            ])
                  placeholder="{{ $placeholder }}" />
                  @endif
                  @if($name=="email")
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 682.667 682.667">
                    <defs>
                      <clipPath id="a" clipPathUnits="userSpaceOnUse">
                        <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                      </clipPath>
                    </defs>
                    <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                      <path fill="none" stroke-miterlimit="10" stroke-width="40" d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z" data-original="#000000"></path>
                      <path d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z" data-original="#000000"></path>
                    </g>
                  </svg>
                  @endif
                  @if($type=="password")
                  <div x-on:click="showPassword = !showPassword">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2 cursor-pointer" viewBox="0 0 128 128">
                    <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
                  </svg></div>
                  @endif
                  @if($name && $type !== 'file')
                  @error($name)
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
        </div>
        @enderror
        @endif
                </div>
                    @error($name)
        <p @class(['mt-2 absolute bottom--4 text-sm text-red-600' => $page=="profile" && $type!=="file", 'mt-2 absolute right-4 text-sm text-red-600' => $page=="profile" && $type=="file", 'mt-2 text-sm text-red-600' => $page!=="profile" ])> {{ $message }}</p> <!-- On a utilisé absolute (par rapport à relative dans la vue profile (div au dessus de username)) et descendu le message de -4 avec bottom--4 de l'élement div -->
    @enderror
    @if ($help)
    <p class="mt-2 text-sm text-gray-500">{{ $help }}</p>
    @endif

    @if ($type === 'file' && $value && $page!="profile")
    <p class="mt-3 text-sm text-gray-500">Fichier actuel : {{ $value }}</p>
    @if ($isImage())
    <img class="mt-2 max-w-full max-h-48" src="{{ asset('storage/' . $value) }}" alt="Image {{ $value }}">
    @endif
    @endif
</div>
