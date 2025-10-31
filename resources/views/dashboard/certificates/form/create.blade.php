<!-- resources/views/dashboard/certificate_form.blade.php -->
<form method="POST" action="{{ route('certificates.store') }}">
    @csrf

    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* General styling for a professional look */
        body {
            font-family: 'Inter', sans-serif;
            padding: 20px;
            background-color: #f4f7f9;
            max-width: 900px;
            margin: 0 auto;
        }
        /* Style for inputs and textareas */
        .form-input-field {
            width: 100%; 
            padding: 10px;
            border: 1px solid #d1d5db; 
            border-radius: 6px; 
            margin-top: 4px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-input-field:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 1px #3b82f6;
            outline: none;
        }
    </style>

    <div class="bg-white p-8 rounded-xl shadow-2xl">
        <h1 class="text-3xl font-extrabold text-indigo-700 mb-6 border-b pb-2">Certificate Generation Dashboard</h1>

        <!-- Static field: Certificate Type Selector -->
        <div class="form-group bg-indigo-50 p-5 rounded-lg border border-indigo-200 mb-8 shadow-inner">
            <label for="certificate_type" class="text-lg font-bold text-indigo-800 mb-2 block">1. Select Certificate Type</label>
            
            <!-- Hidden input to carry the selected type for the POST request if the form is submitted via the button -->
            <input type="hidden" name="certificate_type" value="{{ old('certificate_type', $selectedType ?? '') }}">
            
            <!-- Selector sends a GET request to reload the form with the new schema -->
            <select name="certificate_type_selector" id="certificate_type_selector" 
                    onchange="window.location.href = '{{ route('certificates.create') }}?certificate_type=' + this.value"
                    class="form-input-field text-lg appearance-none bg-white cursor-pointer">
                
                <option value="">-- Select Certificate to Begin --</option>
                {{-- Loop through all available schema keys (e.g., 'heir_certificate') --}}
                @foreach($allSchemas ?? [] as $type => $schemaConfig)
                    <option value="{{ $type }}" {{ ($selectedType ?? '') == $type ? 'selected' : '' }}>
                        {{ $schemaConfig['title'] ?? Str::title(str_replace('_', ' ', $type)) }}
                    </option>
                @endforeach
            </select>
            @error('certificate_type') <span class="text-sm text-red-600 mt-1 block">Please select a valid certificate type.</span> @enderror
        </div>

        @if(isset($schema) && !empty($schema['fields']))
            <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ $schema['title'] }} Details</h2>
            
            <!-- Standard field: Recipient Selector -->
            <div class="form-group mb-6 p-4 border border-green-200 rounded-lg bg-green-50">
                <label for="recipient_user_id" class="font-medium text-green-700 block">Recipient User ID <span class="text-red-500">*</span></label>
                <input type="number" name="recipient_user_id" id="recipient_user_id" 
                       value="{{ old('recipient_user_id') }}" 
                       placeholder="Enter the recipient User ID (e.g., 42)" required
                       class="form-input-field">
                @error('recipient_user_id') <span class="error text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <hr class="my-6 border-gray-200">

            <!-- DYNAMIC FIELDS LOOP: This renders ALL fields defined in the current schema -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($schema['fields'] as $field)
                    <div class="form-group mb-4 
                        @if($field['type'] === 'json_editor' || $field['type'] === 'textarea') md:col-span-2 @endif 
                    ">
                        <label for="{{ $field['name'] }}" class="font-medium text-gray-700 block mb-1">
                            {{ $field['label'] }} 
                            @if($field['required'] ?? false)<span class="text-red-500">*</span>@endif
                        </label>
                        
                        @if (in_array($field['type'], ['text', 'date', 'number', 'email']))
                            <input type="{{ $field['type'] }}" 
                                   name="{{ $field['name'] }}" 
                                   id="{{ $field['name'] }}" 
                                   value="{{ old($field['name']) }}"
                                   {{ ($field['required'] ?? false) ? 'required' : '' }}
                                   class="form-input-field">
                                   
                        @elseif ($field['type'] === 'textarea')
                            <textarea name="{{ $field['name'] }}" 
                                      id="{{ $field['name'] }}"
                                      rows="4"
                                      {{ ($field['required'] ?? false) ? 'required' : '' }}
                                      class="form-input-field">{{ old($field['name']) }}</textarea>

                        @elseif ($field['type'] === 'json_editor')
                            <textarea name="{{ $field['name'] }}" 
                                      id="{{ $field['name'] }}"
                                      rows="10"
                                      placeholder="{{ $field['placeholder'] ?? 'Enter valid JSON array of objects...' }}"
                                      {{ ($field['required'] ?? false) ? 'required' : '' }}
                                      class="form-input-field font-mono text-sm bg-gray-50">{{ old($field['name']) }}</textarea>
                            <small class="text-gray-500 mt-2 block p-2 bg-gray-100 rounded">
                                **JSON Array Required:** Please input tabular data (like the Heirs List) as a valid JSON array.
                            </small>
                        @endif
                        
                        @error($field['name']) <span class="error text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                @endforeach
            </div>

            <button type="submit" class="w-full mt-8 py-3 bg-indigo-600 text-white font-bold text-xl rounded-lg hover:bg-indigo-700 transition duration-200 shadow-xl">
                Generate and Store {{ $schema['title'] }}
            </button>
            
        @else
            <div class="p-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded-r-lg">
                <p class="font-semibold">Certificate Schema Not Loaded</p>
                <p class="text-sm">Please select a Certificate Type from the dropdown above to load the required input fields defined by the **SDI** technique.</p>
            </div>
        @endif
    </div>

    <!-- Ensure the 'certificate_type' hidden input is updated before final submission -->
    <script>
        document.getElementById('certificate_type_selector').addEventListener('change', function() {
            document.querySelector('input[name="certificate_type"]').value = this.value;
        });
    </script>
</form>
