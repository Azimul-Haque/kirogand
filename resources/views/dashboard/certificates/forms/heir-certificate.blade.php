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

    // Helper function to render the external sub-heir table block for existing data
    function renderSubHeirTable($index, $heir) {
        $parentName = $heir['name'] ?? 'নামবিহীন';
        $subHeirs = $heir['sub_heirs'] ?? [];
        $displayStyle = empty($subHeirs) ? 'display: none;' : '';

        $html = '<div class="sub-heir-table-block card card-secondary mt-3" id="sub-heir-block-' . $index . '" data-parent-id="' . $index . '" style="' . $displayStyle . '">';
        $html .= '<div class="card-header"><h3 class="card-title"><i class="fas fa-sitemap"></i> সাব-ওয়ারিশের তালিকা (ওয়ারিশ: <strong class="parent-heir-name">' . $parentName . '</strong>)</h3></div>';
        $html .= '<div class="card-body p-0">';
        $html .= '<table class="table table-sm table-striped sub-heir-table mb-0">';
        $html .= '<thead class="bg-light">';
        $html .= '<tr><th>নাম</th><th>সম্পর্ক</th><th>জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন</th><th>জন্ম তারিখ</th><th>মন্তব্য</th><th style="width: 5%;">কার্যসম্পাদন</th></tr>';
        $html .= '</thead>';
        $html .= '<tbody class="sub-heir-body" data-parent-index="' . $index . '">';

        foreach ($subHeirs as $sub_index => $sub_heir) {
            $html .= '<tr class="sub-heir-row">';
            $html .= '<td><input type="text" class="form-control form-control-sm" name="heirs_data[' . $index . '][sub_heirs][' . $sub_index . '][name]" placeholder="সাব-ওয়ারিশের নাম" value="' . ($sub_heir['name'] ?? '') . '" required></td>';
            $html .= '<td><input type="text" class="form-control form-control-sm" name="heirs_data[' . $index . '][sub_heirs][' . $sub_index . '][relation]" placeholder="যেমন: পুত্র, কন্যা" value="' . ($sub_heir['relation'] ?? '') . '" required></td>';
            $html .= '<td><input type="text" class="form-control form-control-sm" name="heirs_data[' . $index . '][sub_heirs][' . $sub_index . '][id_data]" placeholder="এনআইডি/জন্ম নিবন্ধন" value="' . ($sub_heir['id_data'] ?? '') . '"></td>';
            $html .= '<td><input type="text" class="form-control form-control-sm" name="heirs_data[' . $index . '][sub_heirs][' . $sub_index . '][dob]" placeholder="জন্মতারিখ" value="' . ($sub_heir['dob'] ?? '') . '"></td>';
            $html .= '<td><input type="text" class="form-control form-control-sm" name="heirs_data[' . $index . '][sub_heirs][' . $sub_index . '][remark]" placeholder="যেমন: নাবালক" value="' . ($sub_heir['remark'] ?? '') . '"></td>';
            $html .= '<td><button type="button" class="btn btn-danger btn-xs remove-subheir-button" title="ডিলেট করুন"><i class="fas fa-times"></i></button></td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table></div>';
        $html .= '<div class="card-footer"><button type="button" class="btn btn-secondary btn-sm add-subheir-row-button" data-parent-index="' . $index . '"><i class="fas fa-plus"></i> সাব-ওয়ারিশ যোগ করুন</button></div>';
        $html .= '</div>'; // close sub-heir-table-block
        return $html;
    }
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
            <!-- Applicant Details Section (Unchanged) -->
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
                <div class="form-group col-md-4">
                    <label for="name">নাম (আবেদনকারী) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $applicant['name'] ?? '') }}" placeholder="আবেদনকারীর নাম" required>
                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="id_type">জাতীয় পরিচয়পত্র / জন্ম নিবন্ধন নং <span class="text-danger">*</span></label>
                    <div class="input-group">
                        @php
                            $idType = old('id_type', $applicant['id_type'] ?? 'এনআইডি');
                        @endphp
                        <div class="input-group-prepend">
                            <select class="custom-select @error('id_type') is-invalid @enderror" id="id_type" name="id_type" required style="width: 110px;">
                                <option value="এনআইডি" {{ $idType == 'এনআইডি' ? 'selected' : '' }}>এনআইডি</option>
                                <option value="জন্ম সনদ" {{ $idType == 'জন্ম সনদ' ? 'selected' : '' }}>জন্ম সনদ</option>
                            </select>
                        </div>
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
                <div class="form-group col-md-6">
                    <label for="father">পিতার নাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('father') is-invalid @enderror" id="father" name="father"
                        value="{{ old('father', $applicant['father'] ?? '') }}" placeholder="পিতার নাম" required>
                    @error('father') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="mother">মাতার নাম <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('mother') is-invalid @enderror" id="mother" name="mother"
                        value="{{ old('mother', $applicant['mother'] ?? '') }}" placeholder="মাতার নাম" required>
                    @error('mother') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>
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
                    @php
                        $unionValue = old('union', $applicant['union'] ?? (Auth::user()->localOffice->name_bn ?? ''));
                    @endphp
                    <input type="text" class="form-control @error('union') is-invalid @enderror" id="union" name="union"
                        value="{{ $unionValue }}" placeholder="ইউনিয়ন / পৌরসভা" required>
                    @error('union') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- End Applicant Details Section -->

            <hr class="my-4">

            <!-- ২. ওয়ারিশগণের তালিকা (Main Table) -->
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
                                        <button type="button" class="btn btn-info btn-sm add-subheir-button" title="সাব-ওয়ারিশ যোগ করুন">
                                            <i class="fas fa-sitemap"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm remove-heir-button" title="ডিলেট করুন">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <!-- Dynamic primary rows will be added here via JS -->
                </tbody>
            </table>

            <button type="button" class="btn btn-success mt-3" id="add-heir-button">
                <i class="fas fa-plus"></i> নতুন ওয়ারিশ যোগ করুন
            </button>
            
            {{-- *** NEW CONTAINER FOR EXTERNAL SUB-HEIR TABLES *** --}}
            <div id="sub-heir-tables-container">
                @if ($isEdit && !empty($heirs))
                    {{-- Render existing sub-heir tables here --}}
                    @foreach (old('heirs_data', $heirs) as $index => $heir)
                        {{-- Only render the table if the primary heir has a sub_heirs array --}}
                        @if (isset($heir['sub_heirs']))
                            {!! renderSubHeirTable($index, $heir) !!}
                        @endif
                    @endforeach
                @endif
            </div>
            {{-- *** END NEW CONTAINER *** --}}

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
</script>

<script type="text/template" id="sub-heir-table-template">
    {{-- This template creates the full card/table structure outside the main table --}}
    <div class="sub-heir-table-block card card-secondary mt-3" id="sub-heir-block-__INDEX__" data-parent-id="__INDEX__" style="display: none;">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-sitemap"></i> সাব-ওয়ারিশের তালিকা (ওয়ারিশ: <strong class="parent-heir-name">__INDEX__</strong>)
            </h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm table-striped sub-heir-table mb-0">
                <thead class="bg-light">
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
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-secondary btn-sm add-subheir-row-button" data-parent-index="__INDEX__">
                <i class="fas fa-plus"></i> সাব-ওয়ারিশ যোগ করুন
            </button>
        </div>
    </div>
</script>

<script type="text/template" id="sub-heir-row-template">
    <tr class="sub-heir-row">
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__PARENT_INDEX__][sub_heirs][__SUB_INDEX__][name]" placeholder="সাব-ওয়ারিশের নাম" required>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__PARENT_INDEX__][sub_heirs][__SUB_INDEX__][relation]" placeholder="যেমন: পুত্র, কন্যা" required>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__PARENT_INDEX__][sub_heirs][__SUB_INDEX__][id_data]" placeholder="এনআইডি/জন্ম নিবন্ধন">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__PARENT_INDEX__][sub_heirs][__SUB_INDEX__][dob]" placeholder="জন্মতারিখ">
        </td>
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
    let rowCounter = {{ $isEdit ? count(old('heirs_data', $heirs)) : 0 }};

    /**
     * Attaches all listeners to a primary heir row.
     * @param {HTMLElement} row The primary heir row element (<tr>).
     */
    function attachHeirRowListeners(row) {
        const parentIndex = row.dataset.rowId;
        const subHeirBlock = document.getElementById(`sub-heir-block-${parentIndex}`);

        // --- 1. Remove Primary Heir Listener ---
        row.querySelector('.remove-heir-button').addEventListener('click', function() {
            // Remove the main row and its associated sub-heir table block
            if (subHeirBlock) {
                subHeirBlock.remove();
            }
            row.remove();
        });

        // --- 2. Toggle Sub-Heir List Listener ---
        const subHeirToggleButton = row.querySelector('.add-subheir-button');
        subHeirToggleButton.addEventListener('click', function() {
            if (!subHeirBlock) return;
            
            // Toggle visibility of the external sub-heir table block
            if (subHeirBlock.style.display === 'none' || subHeirBlock.style.display === '') {
                subHeirBlock.style.display = 'block';
            } else {
                subHeirBlock.style.display = 'none';
            }
        });

        // --- 3. Link Name Change to Sub-Table Title ---
        const nameInput = row.querySelector('.heir-name-input');
        const nameDisplay = subHeirBlock ? subHeirBlock.querySelector('.parent-heir-name') : null;

        if (nameDisplay) {
            // Initial update in case of existing data/old input
            nameDisplay.textContent = nameInput.value || nameInput.placeholder;

            nameInput.addEventListener('input', function() {
                nameDisplay.textContent = this.value || nameInput.placeholder;
            });
        }
    }

    /**
     * Attaches listeners for adding and removing individual sub-heir rows within a sub-container.
     * This is called for both dynamically added and pre-populated sub-heir tables.
     * @param {HTMLElement} subHeirBlock The external sub-heir table block container.
     */
    function attachSubHeirBlockListeners(subHeirBlock) {
        const parentIndex = subHeirBlock.dataset.parentId;
        const subHeirBody = subHeirBlock.querySelector('.sub-heir-body');

        // Function to find the next available sub-index (to avoid array key conflicts)
        function getNextSubIndex() {
            const existingRows = subHeirBody.querySelectorAll('.sub-heir-row');
            let maxIndex = -1;
            existingRows.forEach(subRow => {
                const nameAttribute = subRow.querySelector('input').name;
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
        subHeirBlock.querySelector('.add-subheir-row-button').addEventListener('click', function() {
            const nextSubIndex = getNextSubIndex();
            const template = document.getElementById('sub-heir-row-template').innerHTML;
            
            let newRowHtml = template.replace(/__PARENT_INDEX__/g, parentIndex);
            newRowHtml = newRowHtml.replace(/__SUB_INDEX__/g, nextSubIndex);

            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = newRowHtml;
            const newRow = tempDiv.firstElementChild; // This is the new <tr> element

            subHeirBody.appendChild(newRow);
            
            // Attach the remove listener to the newly created button
            const newButton = newRow.querySelector('.remove-subheir-button');
            attachRemoveSubHeirListener(newButton);
        });

        // --- Attach Remove Listener to Pre-existing Sub-Heir Buttons ---
        subHeirBody.querySelectorAll('.remove-subheir-button').forEach(button => {
             attachRemoveSubHeirListener(button);
        });
    }

    /**
     * Attaches a remove listener directly to the remove button element.
     */
    function attachRemoveSubHeirListener(button) {
        button.addEventListener('click', function() {
            // Find the closest ancestor row (<tr>) and remove it
            this.closest('.sub-heir-row').remove();
        });
    }

    /**
     * Creates a new primary heir row and its associated external sub-heir table block.
     */
    function createNewHeirElements(index) {
        // 1. Create Main Heir Row
        const mainRowHtml = document.getElementById('heir-row-template').innerHTML.replace(/__INDEX__/g, index);
        const tempRowContainer = document.createElement('tbody');
        tempRowContainer.innerHTML = mainRowHtml;
        const mainRow = tempRowContainer.firstElementChild;

        // 2. Create External Sub-Heir Table Block (initially hidden)
        const subTableHtml = document.getElementById('sub-heir-table-template').innerHTML.replace(/__INDEX__/g, index);
        const tempTableContainer = document.createElement('div');
        tempTableContainer.innerHTML = subTableHtml;
        const subHeirBlock = tempTableContainer.firstElementChild;
        
        // The sub-container name display should default to the placeholder
        const nameInput = mainRow.querySelector('.heir-name-input');
        subHeirBlock.querySelector('.parent-heir-name').textContent = nameInput.placeholder;

        return { mainRow, subHeirBlock };
    }

    /**
     * Initializes the dynamic table functionality.
     */
    function initHeirsTable() {
        const heirsContainer = document.getElementById('heirs-container');
        const subHeirTablesContainer = document.getElementById('sub-heir-tables-container');
        
        // 1. Attach listeners to pre-populated (edit mode) rows and external blocks
        heirsContainer.querySelectorAll('.heir-row').forEach(row => {
            attachHeirRowListeners(row);
        });
        subHeirTablesContainer.querySelectorAll('.sub-heir-table-block').forEach(block => {
            attachSubHeirBlockListeners(block);
        });

        // 2. If it's a new form and no old data exists, add the first row
        if (rowCounter === 0) {
            const { mainRow, subHeirBlock } = createNewHeirElements(rowCounter++);
            heirsContainer.appendChild(mainRow);
            subHeirTablesContainer.appendChild(subHeirBlock);
            attachHeirRowListeners(mainRow);
            attachSubHeirBlockListeners(subHeirBlock);
        }

        // 3. Attach listener for the "Add New Heir" button (Primary)
        document.getElementById('add-heir-button').addEventListener('click', function() {
            const { mainRow, subHeirBlock } = createNewHeirElements(rowCounter);
            
            // Append both elements to their respective containers
            heirsContainer.appendChild(mainRow);
            subHeirTablesContainer.appendChild(subHeirBlock);
            
            // Attach listeners
            attachHeirRowListeners(mainRow);
            attachSubHeirBlockListeners(subHeirBlock);
            
            rowCounter++; // Increment counter for the next new row
        });
    }

    // Run initialization logic when the page content is fully loaded
    document.addEventListener('DOMContentLoaded', initHeirsTable);
</script>