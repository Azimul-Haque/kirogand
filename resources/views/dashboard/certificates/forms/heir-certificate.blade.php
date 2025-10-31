<!-- PHP Context Setup (REQUIRED) -->
@php
    // Determine if we are in Edit or Create mode based on $certificate object
    $isEdit = isset($certificate) && $certificate->exists;
    $data = $isEdit ? ($certificate->data_payload ?? []) : [];
    $applicant = $data['applicant'] ?? [];
    $heirs = $data['heirs'] ?? [];

    // Set form parameters
    $route = $isEdit
        ? route('dashboard.certificates.update', $certificate->id)
        : route('dashboard.certificates.store', 'heir-certificate');
    $buttonText = $isEdit ? 'ওয়ারিশান সনদপত্র আপডেট করুন' : 'ওয়ারিশান সনদপত্র তৈরি করুন';
    $title = $isEdit ? 'ওয়ারিশান সনদপত্র সম্পাদনা' : 'ওয়ারিশান সনদপত্র ফরম';
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
        @if ($isEdit)
            @method('PUT')
        @endif

        <!-- Hidden field for type recognition in the Controller (only needed for create/store) -->
        @if (!$isEdit)
            <input type="hidden" name="certificate_type" value="heir-certificate">
        @endif

        <div class="card-body">
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
                        <th style="width: 5%;">কার্যসম্পাদন</th>
                    </tr>
                </thead>
                <tbody id="heirs-container">
                    @if ($isEdit && !empty($heirs))
                        {{-- Pre-populate existing heirs in Edit mode --}}
                        @foreach (old('heirs_data', $heirs) as $index => $heir)
                            <tr class="heir-row" data-row-id="{{ $index }}">
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="heirs_data[{{ $index }}][name]"
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
                                    <button type="button" class="btn btn-danger btn-sm remove-heir-button" title="ডিলেট করুন">
                                        <i class="fas fa-trash"></i>
                                    </button>
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

<!-- Row Template (Hidden) -->
<script type="text/template" id="heir-row-template">
    <tr class="heir-row" data-row-id="__INDEX__">
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__INDEX__][name]" placeholder="ওয়ারিশের নাম" required>
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
            <button type="button" class="btn btn-danger btn-sm remove-heir-button" title="ডিলেট করুন">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
</script>

<script>
    // Initialize rowCounter based on existing rows for correct indexing
    let rowCounter = {{ $isEdit ? count(old('heirs_data', $heirs)) : 0 }};

    /**
     * Creates and returns a new heir row element.
     */
    function createNewHeirRow(index) {
        const template = document.getElementById('heir-row-template').innerHTML;
        const newRowHtml = template.replace(/__INDEX__/g, index);
        const newRow = document.createElement('tr');
        newRow.innerHTML = newRowHtml;
        newRow.classList.add('heir-row');
        newRow.dataset.rowId = index;
        return newRow;
    }

    /**
     * Attaches a remove listener to a row's button.
     */
    function attachRemoveListener(row) {
        row.querySelector('.remove-heir-button').addEventListener('click', function() {
            row.remove();
        });
    }

    /**
     * Initializes the dynamic table functionality.
     */
    function initHeirsTable() {
        const heirsContainer = document.getElementById('heirs-container');

        // 1. Attach listeners to pre-populated (edit mode) rows
        heirsContainer.querySelectorAll('.heir-row').forEach(row => {
            attachRemoveListener(row);
        });

        // 2. If it's a new form and no old data exists, add the first row
        if (rowCounter === 0) {
             const firstRow = createNewHeirRow(rowCounter++);
             heirsContainer.appendChild(firstRow);
             attachRemoveListener(firstRow);
        }

        // 3. Attach listener for the "Add New Heir" button
        document.getElementById('add-heir-button').addEventListener('click', function() {
            const newRow = createNewHeirRow(rowCounter);
            heirsContainer.appendChild(newRow);
            attachRemoveListener(newRow);
            rowCounter++; // Increment counter for the next new row
        });
    }

    // Run initialization logic when the page content is fully loaded
    document.addEventListener('DOMContentLoaded', initHeirsTable);
</script>