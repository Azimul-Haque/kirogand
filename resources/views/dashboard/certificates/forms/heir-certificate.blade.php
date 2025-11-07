<!-- PHP Context Setup (REQUIRED) -->
@php
    // Determine if we are in Edit or Create mode based on $certificate object
    $isEdit = isset($certificate) && $certificate->exists;
    $certificatetype = $isEdit ? $certificate->certificate_type : $certificate_type;
    // Ensure $data is an array and handle nested structure for sub_heirs if present
    $data = $isEdit ? ($certificate->data_payload ?? []) : [];
    $applicant = $data['applicant'] ?? [];
    $heirs = $data['heirs'] ?? [];

    // Set form parameters
    $route = $isEdit
        ? route('dashboard.certificates.update', $certificate->id)
        : route('dashboard.certificates.store', 'heir-certificate');
    $buttonText = $isEdit ? checkcertificatetype($certificatetype) . ' আপডেট করুন' : checkcertificatetype($certificatetype) . ' তৈরি করুন';
    $title = $isEdit ? checkcertificatetype($certificatetype) . ' সম্পাদনা' : checkcertificatetype($certificatetype) . ' ফরম';
@endphp

<!-- Card structure common in AdminLTE 3 -->
<div class="card card-success card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-alt"></i> {{ $title }}
        </h3>
    </div>
    <form action="{{ $route }}" method="POST">
        @csrf

        <!-- Hidden field for type recognition in the Controller (only needed for create/store) -->
        @if (!$isEdit)
            <input type="hidden" name="certificate_type" value="{{ $certificatetype }}">
        @endif

        <div class="card-body">
            <div class="row">
                @php
                    $memoValue = old('memo', $certificate->memo ?? (Auth::user()->localOffice->draft_memo ?? ''));
                @endphp
                <div class="form-group col-md-6">
                    <label for="memo">স্মারক <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('memo') is-invalid @enderror" id="memo" name="memo"
                        value="{{ $memoValue }}" placeholder="স্মারক নাম্বার" required>
                    @error('memo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <!-- নাম -->
                <div class="form-group col-md-4">
                    <label for="name">নাম (আবেদনকারী) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $applicant['name'] ?? '') }}" placeholder="আবেদনকারীর নাম" required>
                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <!-- জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন -->
                <div class="form-group col-md-4">
                    <label for="id_type">জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নং <span class="text-danger">*</span></label>
                    <div class="input-group">
                        @php
                            $idType = old('id_type', $applicant['id_type'] ?? 'এনআইডি');
                        @endphp
                        <!-- Select for Type: name="id_type" -->
                        <div class="input-group-prepend">
                            <select class="custom-select @error('id_type') is-invalid @enderror" id="id_type" name="id_type" required style="width: 110px;">
                                <option value="এনআইডি" {{ $idType == 'এনআইডি' ? 'selected' : '' }}>এনআইডি</option>
                                <option value="জন্ম সনদ" {{ $idType == 'জন্ম সনদ' ? 'selected' : '' }}>জন্ম সনদ</option>
                            </select>
                        </div>
                        <!-- Input for Value: name="id_value" -->
                        <input type="text" class="form-control @error('id_value') is-invalid @enderror" name="id_value"
                            placeholder="নম্বর দিন" value="{{ old('id_value', $applicant['id_value'] ?? '') }}" required>
                    </div>
                    @error('id_type') <span class="text-danger d-block mt-1">{{ $message }}</span> @enderror
                    @error('id_value') <span class="text-danger d-block mt-1">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="mobile">মোবাইল নং <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile"
                        value="{{ old('mobile', $applicant['mobile'] ?? '') }}" placeholder="১১ ডিজিটের মোবাইল নাম্বার" required>
                    @error('mobile') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <!-- পিতার নাম -->
                <div class="form-group col-md-6">
                    <label for="father">পিতার নাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('father') is-invalid @enderror" id="father" name="father"
                        value="{{ old('father', $applicant['father'] ?? '') }}" placeholder="পিতার নাম" required>
                    @error('father') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <!-- মাতার নাম -->
                <div class="form-group col-md-6">
                    <label for="mother">মাতার নাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('mother') is-invalid @enderror" id="mother" name="mother"
                        value="{{ old('mother', $applicant['mother'] ?? '') }}" placeholder="মাতার নাম" required>
                    @error('mother') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- ঠিকানা বিবরণ -->
            <h5 class="mt-3 mb-3 text-secondary">ঠিকানা বিবরণ</h5>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="village">গ্রাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('village') is-invalid @enderror" id="village" name="village"
                        value="{{ old('village', $applicant['village'] ?? '') }}" placeholder="গ্রাম" required>
                    @error('village') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="ward">ওয়ার্ড <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('ward') is-invalid @enderror" id="ward" name="ward"
                        value="{{ old('ward', $applicant['ward'] ?? '') }}" placeholder="ওয়ার্ড (যেমন ৪নং ভবানন্দপুর)" required>
                    @error('ward') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="post_office">ডাকঘর <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('post_office') is-invalid @enderror" id="post_office" name="post_office"
                        value="{{ old('post_office', $applicant['post_office'] ?? '') }}" placeholder="ডাকঘর" required>
                    @error('post_office') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="union">ইউনিয়ন / পৌরসভা <span class="text-danger">*</span></label>
                    {{-- Assuming union is either from old data, existing data, or authenticated user's office --}}
                    @php
                        $unionValue = old('union', $applicant['union'] ?? (Auth::user()->localOffice->name_bn ?? ''));
                    @endphp
                    <input type="text" class="form-control @error('union') is-invalid @enderror" id="union" name="union"
                        value="{{ $unionValue }}" placeholder="ইউনিয়ন / পৌরসভা" required>
                    @error('union') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <hr class="my-4">

            <!-- ২. ওয়ারিশগণের তালিকা -->
            <h4 class="mb-4 text-success">ওয়ারিশগণের তালিকা</h4>

            <table class="table table-bordered table-striped table-sm" id="heirs-table">
                <thead class="bg-success">
                    <tr>
                        <th>নাম</th>
                        <th>সম্পর্ক</th>
                        <th>জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন</th>
                        <th>জন্ম তারিখ</th>
                        <th>মন্তব্য</th>
                        <th style="width: 10%;">কার্যসম্পাদন</th>
                    </tr>
                </thead>
                <tbody id="heirs-container">
                    @if ($isEdit && !empty($heirs))
                        {{-- Pre-populate existing heirs in Edit mode --}}
                        @foreach (old('heirs_data', $heirs) as $index => $heir)
                            {{-- Primary Heir Row --}}
                            <tr class="heir-row" data-row-id="{{ $index }}">
                                <td>
                                    <input type="text" class="form-control form-control-sm heir-name-input" name="heirs_data[{{ $index }}][name]"
                                        placeholder="ওয়ারিশের নাম" value="{{ $heir['name'] ?? '' }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="heirs_data[{{ $index }}][relation]"
                                        placeholder="যেমন: স্ত্রী, পুত্র, কন্যা ইত্যাদি" value="{{ $heir['relation'] ?? '' }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="heirs_data[{{ $index }}][id_data]"
                                        placeholder="এনআইডি/জন্ম নিবন্ধন" value="{{ $heir['id_data'] ?? '' }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="heirs_data[{{ $index }}][dob]"
                                        placeholder="জন্মতারিখ" value="{{ $heir['dob'] ?? '' }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="heirs_data[{{ $index }}][remark]"
                                        placeholder="যেমন: মৃত" value="{{ $heir['remark'] ?? '' }}">
                                </td>
                                <td>
                                    <div class="btn-group">
                                        {{-- Secondary Heir Button (NEW) --}}
                                        <button type="button" class="btn btn-info btn-sm add-subheir-button" title="সাব-ওয়ারিশ যোগ করুন">
                                            <i class="fas fa-sitemap"></i>
                                        </button>
                                        {{-- Remove Button (Existing) --}}
                                        <button type="button" class="btn btn-danger btn-sm remove-heir-button" title="ডিলেট করুন">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            {{-- Sub-Heir Container Row (Hidden by default) --}}
                            <tr class="sub-heir-container-row collapse @if(isset($heir['sub_heirs']) && !empty($heir['sub_heirs'])) show @endif" data-parent-id="{{ $index }}">
                                <td colspan="6" class="p-0">
                                    <div class="p-3 bg-light">
                                        <h6>**সাব-ওয়ারিশের তালিকা** (ওয়ারিশ: <strong class="parent-heir-name">{{ $heir['name'] ?? 'নামবিহীন' }}</strong>)</h6>
                                        <table class="table table-sm table-striped sub-heir-table">
                                            <thead class="bg-secondary">
                                                {{-- UPDATED: Added ID/Birth Cert and Remark columns --}}
                                                <tr>
                                                    <th>নাম</th>
                                                    <th>সম্পর্ক</th>
                                                    <th>জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন</th>
                                                    <th>জন্ম তারিখ</th>
                                                    <th>মন্তব্য</th>
                                                    <th style="width: 5%;">কার্যসম্পাদন</th>
                                                </tr>
                                            </thead>
                                            <tbody class="sub-heir-body" data-parent-index="{{ $index }}">
                                                @if (isset($heir['sub_heirs']) && is_array($heir['sub_heirs']))
                                                    @foreach ($heir['sub_heirs'] as $sub_index => $sub_heir)
                                                        <tr class="sub-heir-row">
                                                            <td>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="heirs_data[{{ $index }}][sub_heirs][{{ $sub_index }}][name]"
                                                                    placeholder="সাব-ওয়ারিশের নাম" value="{{ $sub_heir['name'] ?? '' }}" required>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="heirs_data[{{ $index }}][sub_heirs][{{ $sub_index }}][relation]"
                                                                    placeholder="যেমন: পুত্র, কন্যা" value="{{ $sub_heir['relation'] ?? '' }}" required>
                                                            </td>
                                                            {{-- ADDED: ID/Birth Cert --}}
                                                            <td>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="heirs_data[{{ $index }}][sub_heirs][{{ $sub_index }}][id_data]"
                                                                    placeholder="এনআইডি/জন্ম নিবন্ধন" value="{{ $sub_heir['id_data'] ?? '' }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="heirs_data[{{ $index }}][sub_heirs][{{ $sub_index }}][dob]"
                                                                    placeholder="জন্মতারিখ" value="{{ $sub_heir['dob'] ?? '' }}">
                                                            </td>
                                                            {{-- ADDED: Remark --}}
                                                            <td>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="heirs_data[{{ $index }}][sub_heirs][{{ $sub_index }}][remark]"
                                                                    placeholder="যেমন: নাবালক" value="{{ $sub_heir['remark'] ?? '' }}">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger btn-xs remove-subheir-button" title="ডিলেট করুন">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-secondary btn-sm mt-2 add-subheir-row-button" data-parent-index="{{ $index }}">
                                            <i class="fas fa-plus"></i> সাব-ওয়ারিশ যোগ করুন
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <!-- Dynamic rows will be added here via JS -->
                </tbody>
            </table>

            <button type="button" class="btn btn-success mt-3" id="add-heir-button">
                <i class="fas fa-plus"></i> নতুন ওয়ারিশ যোগ করুন
            </button>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-lg btn-primary float-right">
                {{ $buttonText }}
            </button>
        </div>
    </form>
</div>
<!-- /.card -->

<!-- Templates (Hidden) -->
<script type="text/template" id="heir-row-template">
    <tr class="heir-row" data-row-id="__INDEX__">
        <td>
            <input type="text" class="form-control form-control-sm heir-name-input" name="heirs_data[__INDEX__][name]" placeholder="ওয়ারিশের নাম" required>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__INDEX__][relation]" placeholder="যেমন: স্ত্রী, পুত্র, কন্যা ইত্যাদি" required>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__INDEX__][id_data]" placeholder="এনআইডি/জন্ম নিবন্ধন">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__INDEX__][dob]" placeholder="জন্মতারিখ">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__INDEX__][remark]" placeholder="যেমন: মৃত">
        </td>
        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm add-subheir-button" title="সাব-ওয়ারিশ যোগ করুন">
                    <i class="fas fa-sitemap"></i>
                </button>
                <button type="button" class="btn btn-danger btn-sm remove-heir-button" title="ডিলেট করুন">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </td>
    </tr>
    {{-- Sub-Heir Container Structure (for JS creation) --}}
    <tr class="sub-heir-container-row collapse" data-parent-id="__INDEX__">
        <td colspan="6" class="p-0">
            <div class="p-3 bg-light">
                <h6>**সাব-ওয়ারিশের তালিকা** (ওয়ারিশ: <strong class="parent-heir-name">__INDEX__</strong>)</h6>
                <table class="table table-sm table-striped sub-heir-table">
                    <thead class="bg-secondary">
                        {{-- UPDATED: Includes all columns as requested --}}
                        <tr>
                            <th>নাম</th>
                            <th>সম্পর্ক</th>
                            <th>জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন</th>
                            <th>জন্ম তারিখ</th>
                            <th>মন্তব্য</th>
                            <th style="width: 5%;">কার্যসম্পাদন</th>
                        </tr>
                    </thead>
                    <tbody class="sub-heir-body" data-parent-index="__INDEX__">
                        <!-- Sub-heir rows go here -->
                    </tbody>
                </table>
                <button type="button" class="btn btn-secondary btn-sm mt-2 add-subheir-row-button" data-parent-index="__INDEX__">
                    <i class="fas fa-plus"></i> সাব-ওয়ারিশ যোগ করুন
                </button>
            </div>
        </td>
    </tr>
</script>

<script type="text/template" id="sub-heir-row-template">
    <tr class="sub-heir-row">
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__PARENT_INDEX__][sub_heirs][__SUB_INDEX__][name]" placeholder="সাব-ওয়ারিশের নাম" required>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__PARENT_INDEX__][sub_heirs][__SUB_INDEX__][relation]" placeholder="যেমন: পুত্র, কন্যা" required>
        </td>
        {{-- ADDED: ID/Birth Cert --}}
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__PARENT_INDEX__][sub_heirs][__SUB_INDEX__][id_data]" placeholder="এনআইডি/জন্ম নিবন্ধন">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__PARENT_INDEX__][sub_heirs][__SUB_INDEX__][dob]" placeholder="জন্মতারিখ">
        </td>
        {{-- ADDED: Remark --}}
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__PARENT_INDEX__][sub_heirs][__SUB_INDEX__][remark]" placeholder="যেমন: নাবালক">
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-xs remove-subheir-button" title="ডিলেট করুন">
                <i class="fas fa-times"></i>
            </button>
        </td>
    </tr>
</script>

<script>
    // Initialize rowCounter based on existing rows for correct primary heir indexing
    let rowCounter = {{ $isEdit ? count(old('heirs_data', $heirs)) : 0 }};

    /**
     * Attaches all listeners (remove and sub-heir toggle/add) to a primary heir row.
     * @param {HTMLElement} row The primary heir row element.
     * @param {HTMLElement} subContainerRow The immediate next sibling (sub-heir container row).
     */
    function attachHeirRowListeners(row, subContainerRow) {
        // --- 1. Remove Primary Heir Listener ---
        row.querySelector('.remove-heir-button').addEventListener('click', function() {
            // Remove the main row and its associated sub-heir container row
            subContainerRow.remove();
            row.remove();
        });

        // --- 2. Toggle Sub-Heir List Listener ---
        const subHeirToggleButton = row.querySelector('.add-subheir-button');
        subHeirToggleButton.addEventListener('click', function() {
            // Toggle the visibility of the sub-heir container row
            subContainerRow.classList.toggle('collapse');
            subContainerRow.classList.toggle('show');
        });

        // --- 3. Link Name Change to Sub-Table Title ---
        const nameInput = row.querySelector('.heir-name-input');
        const nameDisplay = subContainerRow.querySelector('.parent-heir-name');

        // Initial update in case of existing data/old input
        nameDisplay.textContent = nameInput.value || nameInput.placeholder;

        nameInput.addEventListener('input', function() {
            nameDisplay.textContent = this.value || nameInput.placeholder;
        });

        // --- 4. Attach Sub-Heir Add/Remove Listeners to the Sub-Container ---
        attachSubHeirContainerListeners(subContainerRow);
    }

    /**
     * Attaches listeners for adding and removing individual sub-heir rows within a sub-container.
     * @param {HTMLElement} subContainerRow The sub-heir container row element.
     */
    function attachSubHeirContainerListeners(subContainerRow) {
        const parentIndex = subContainerRow.dataset.parentId;
        const subHeirBody = subContainerRow.querySelector('.sub-heir-body');

        // Function to find the next available sub-index (to avoid array key conflicts)
        function getNextSubIndex() {
            const existingRows = subHeirBody.querySelectorAll('.sub-heir-row');
            let maxIndex = -1;
            // Iterate over existing sub-rows to find the highest index
            existingRows.forEach(subRow => {
                const nameAttribute = subRow.querySelector('input').name;
                // Regex to find the [sub_heirs][X] index
                const match = nameAttribute.match(/\[sub_heirs\]\[(\d+)\]/);
                if (match) {
                    const index = parseInt(match[1]);
                    if (index > maxIndex) {
                        maxIndex = index;
                    }
                }
            });
            return maxIndex + 1;
        }

        // --- Add Sub-Heir Row Listener ---
        subContainerRow.querySelector('.add-subheir-row-button').addEventListener('click', function() {
            const nextSubIndex = getNextSubIndex();
            const template = document.getElementById('sub-heir-row-template').innerHTML;
            
            let newRowHtml = template.replace(/__PARENT_INDEX__/g, parentIndex);
            newRowHtml = newRowHtml.replace(/__SUB_INDEX__/g, nextSubIndex);

            const newRow = document.createElement('tr');
            newRow.innerHTML = newRowHtml;
            newRow.classList.add('sub-heir-row');
            
            // Append and attach remove listener immediately
            // Note: We use firstElementChild because innerHTML may wrap the row in a tbody
            subHeirBody.appendChild(newRow.firstElementChild);
            attachRemoveSubHeirListener(newRow.firstElementChild);
        });

        // --- Attach Remove Listener to Pre-existing Sub-Heir Rows ---
        subHeirBody.querySelectorAll('.remove-subheir-button').forEach(button => {
             attachRemoveSubHeirListener(button.closest('.sub-heir-row'));
        });
    }

    /**
     * Attaches a remove listener to a single sub-heir row.
     */
    function attachRemoveSubHeirListener(row) {
        row.querySelector('.remove-subheir-button').addEventListener('click', function() {
            row.remove();
        });
    }

    /**
     * Creates a new primary heir row and its associated sub-heir container.
     */
    function createNewHeirRow(index) {
        const templateHtml = document.getElementById('heir-row-template').innerHTML;
        const newRowsHtml = templateHtml.replace(/__INDEX__/g, index);
        
        // Use a temporary container to parse both TRs
        const tempContainer = document.createElement('tbody');
        tempContainer.innerHTML = newRowsHtml;
        
        const mainRow = tempContainer.querySelector('.heir-row');
        const subContainerRow = tempContainer.querySelector('.sub-heir-container-row');
        
        // The sub-container name display should default to the placeholder
        const nameInput = mainRow.querySelector('.heir-name-input');
        subContainerRow.querySelector('.parent-heir-name').textContent = nameInput.placeholder;
        
        return { mainRow, subContainerRow };
    }

    /**
     * Initializes the dynamic table functionality.
     */
    function initHeirsTable() {
        const heirsContainer = document.getElementById('heirs-container');

        // 1. Attach listeners to pre-populated (edit mode) rows and containers
        // Iterate through all child elements to find paired heir and sub-heir rows
        let currentHeirRow = null;
        heirsContainer.childNodes.forEach(node => {
            if (node.nodeType === 1) { // Check if it's an element node
                if (node.classList.contains('heir-row')) {
                    currentHeirRow = node;
                } else if (currentHeirRow && node.classList.contains('sub-heir-container-row')) {
                    attachHeirRowListeners(currentHeirRow, node);
                    currentHeirRow = null; // Reset for the next pair
                }
            }
        });


        // 2. If it's a new form and no old data exists, add the first row
        if (rowCounter === 0) {
            const { mainRow, subContainerRow } = createNewHeirRow(rowCounter++);
            heirsContainer.appendChild(mainRow);
            heirsContainer.appendChild(subContainerRow);
            attachHeirRowListeners(mainRow, subContainerRow);
        }

        // 3. Attach listener for the "Add New Heir" button (Primary)
        document.getElementById('add-heir-button').addEventListener('click', function() {
            const { mainRow, subContainerRow } = createNewHeirRow(rowCounter);
            heirsContainer.appendChild(mainRow);
            heirsContainer.appendChild(subContainerRow);
            attachHeirRowListeners(mainRow, subContainerRow);
            rowCounter++; // Increment counter for the next new row
        });
    }

    // Run initialization logic when the page content is fully loaded
    document.addEventListener('DOMContentLoaded', initHeirsTable);
</script>