<!-- Card structure common in AdminLTE 3 -->
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-alt"></i> Heirship Declaration Certificate Form
        </h3>
    </div>
    
    <form action="{{ route('dashboard.certificates.store', $certificate_type) }}" method="POST">
        @csrf
        
        <!-- Hidden field for type recognition in the Controller -->
        <input type="hidden" name="certificate_type" value="heir-certificate">

        <div class="card-body">
            
            <!-- 1. FIXED MANDATORY APPLICANT DETAILS (Deceased/Applicant Info) -->
            <h4 class="mb-4 text-primary">Applicant/Deceased Mandatory Details</h4>
            <div class="row">
                <!-- Name -->
                <div class="form-group col-md-6">
                    <label for="name">Name (Deceased or Applicant) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <!-- NID/Birth Registration -->
                <div class="form-group col-md-6">
                    <label for="nid_birth_registration">NID / Birth Registration No. <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nid_birth_registration') is-invalid @enderror" id="nid_birth_registration" name="nid_birth_registration" value="{{ old('nid_birth_registration') }}" required>
                    @error('nid_birth_registration') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <!-- Father's Name -->
                <div class="form-group col-md-6">
                    <label for="father">Father's Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('father') is-invalid @enderror" id="father" name="father" value="{{ old('father') }}" required>
                    @error('father') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <!-- Mother's Name -->
                <div class="form-group col-md-6">
                    <label for="mother">Mother's Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('mother') is-invalid @enderror" id="mother" name="mother" value="{{ old('mother') }}" required>
                    @error('mother') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Address Details -->
            <h5 class="mt-3 mb-3 text-secondary">Address Details</h5>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="village">Village <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('village') is-invalid @enderror" id="village" name="village" value="{{ old('village') }}" required>
                    @error('village') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="ward">Ward No. <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('ward') is-invalid @enderror" id="ward" name="ward" value="{{ old('ward') }}" required>
                    @error('ward') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="post_office">Post Office <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('post_office') is-invalid @enderror" id="post_office" name="post_office" value="{{ old('post_office') }}" required>
                    @error('post_office') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="union">Union / Upazila <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('union') is-invalid @enderror" id="union" name="union" value="{{ old('union') }}" required>
                    @error('union') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <hr class="my-4">

            <!-- 2. DYNAMIC TABULAR DATA (Heirs List) -->
            <h4 class="mb-4 text-success">List of Heirs</h4>

            <table class="table table-bordered table-striped" id="heirs-table">
                <thead class="bg-success">
                    <tr>
                        <th style="width: 1%;">#</th>
                        <th>Name</th>
                        <th>Relation</th>
                        <th>NID / Birth Reg.</th>
                        <th>DOB</th>
                        <th>Remark</th>
                        <th style="width: 5%;">Action</th>
                    </tr>
                </thead>
                <tbody id="heirs-container">
                    <!-- Dynamic rows will be added here -->
                </tbody>
            </table>
            
            <button type="button" class="btn btn-success mt-3" id="add-heir-button">
                <i class="fas fa-plus"></i> নতুন ওয়ারিশ যোগ (Add New Heir)
            </button>

        </div>
        <!-- /.card-body -->
        
        <div class="card-footer">
            <button type="submit" class="btn btn-lg btn-primary float-right">
                Generate Heir Certificate
            </button>
        </div>
    </form>
</div>
<!-- /.card -->

<!-- Row Template (Hidden) -->
<script type="text/template" id="heir-row-template">
    <tr class="heir-row" data-row-id="__INDEX__">
        <td><span class="row-number">1</span></td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__INDEX__][name]" placeholder="Heir Name" required>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__INDEX__][relation]" placeholder="e.g., Son, Wife" required>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__INDEX__][nid_birth_registration]" placeholder="NID/BR No." required>
        </td>
        <td>
            <input type="date" class="form-control form-control-sm" name="heirs_data[__INDEX__][dob]" required>
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="heirs_data[__INDEX__][remark]" placeholder="Notes">
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm remove-heir-button" title="Remove Row">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
</script>

<script>
    // Global counter to ensure unique array indices (crucial for PHP/Laravel processing)
    let rowCounter = 0;

    /**
     * Adds a new dynamic row to the heirs table.
     */
    function addHeirRow() {
        // 1. Get the template content
        const template = document.getElementById('heir-row-template').innerHTML;
        
        // 2. Replace the placeholder with the current unique index
        const newRowHtml = template.replace(/__INDEX__/g, rowCounter);
        
        // 3. Create a new table row element
        const newRow = document.createElement('tr');
        newRow.innerHTML = newRowHtml;
        newRow.classList.add('heir-row');
        newRow.dataset.rowId = rowCounter;

        // 4. Append the new row to the container
        document.getElementById('heirs-container').appendChild(newRow);
        
        // 5. Update row numbering and counter
        updateRowNumbers();
        rowCounter++;
        
        // 6. Attach remove event listener to the new button
        newRow.querySelector('.remove-heir-button').addEventListener('click', function() {
            newRow.remove();
            updateRowNumbers();
        });
    }

    /**
     * Updates the visible row numbers (1, 2, 3...) after adding or removing a row.
     */
    function updateRowNumbers() {
        const rows = document.querySelectorAll('#heirs-container .heir-row');
        rows.forEach((row, index) => {
            row.querySelector('.row-number').textContent = index + 1;
        });
    }

    // Initialize: Add one row when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Add the first row automatically
        addHeirRow(); 

        // Attach event listener to the "Add New Heir" button
        document.getElementById('add-heir-button').addEventListener('click', addHeirRow);

        // Include Font Awesome (AdminLTE uses it)
        const faScript = document.createElement('script');
        faScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js';
        faScript.crossOrigin = 'anonymous';
        document.head.appendChild(faScript);

        // Include Bootstrap JS dependencies (required for full Bootstrap functionality, though minimal for this form)
        const jqueryScript = document.createElement('script');
        jqueryScript.src = 'https://code.jquery.com/jquery-3.5.1.slim.min.js';
        document.head.appendChild(jqueryScript);

        const popperScript = document.createElement('script');
        popperScript.src = 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js';
        document.head.appendChild(popperScript);

        const bsScript = document.createElement('script');
        bsScript.src = 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js';
        document.head.appendChild(bsScript);
    });
</script>
