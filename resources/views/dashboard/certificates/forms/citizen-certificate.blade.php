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
        : route('dashboard.certificates.store', 'citizen-certificate');
    $buttonText = $isEdit ? 'নাগরিকত্ব সনদ আপডেট করুন' : 'নাগরিকত্ব সনদ তৈরি করুন';
    $title = $isEdit ? 'নাগরিকত্ব সনদ সম্পাদনা' : 'নাগরিকত্ব সনদ ফরম';
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
        {{-- @if ($isEdit)
            @method('PUT')
        @endif --}}

        <!-- Hidden field for type recognition in the Controller (only needed for create/store) -->
        @if (!$isEdit)
            <input type="hidden" name="certificate_type" value="citizen-certificate">
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

            <div id="editor" contenteditable="true" spellcheck="false">
                <p>এতদ্বারা প্রত্যয়ন করা যাচ্ছে যে, <span class="protected-token" contenteditable="false">[নাম]</span>, পিতা: [পিতার নাম]</span>, মাতা: <span class="protected-token" contenteditable="false">[মাতার নাম]</span>, গ্রাম: <span class="protected-token" contenteditable="false">[গ্রাম]</span>, ওয়ার্ড: <span class="protected-token" contenteditable="false">[ওয়ার্ড]</span>, ডাকঘর: <span class="protected-token" contenteditable="false">[ডাকঘর]</span>, উপজেলা: <span class="protected-token" contenteditable="false">[উপজেলা]</span>, জেলা: <span class="protected-token" contenteditable="false">[জেলা]-কে আমি ব্যক্তিগতভাবে চিনি ও জানি। তিনি অত্র <span class="protected-token" contenteditable="false">[ইউনিয়ন]</span>-এর স্থায়ী বাসিন্দা ও জন্মগতভাবে বাংলাদেশের নাগরিক। আমার জানামতে, তিনি কোন প্রকার সমাজবিরোধী বা রাষ্ট্রবিদ্রোহমূলক কর্মকাণ্ডের সাথে জড়িত ছিলেন না বা নেই। 
                    This certifies that <span class="protected-token" contenteditable="false">[NAME]</span> 
                    has successfully completed the 
                    <span class="protected-token" contenteditable="false">[COURSE]</span> 
                    at our main campus located at 
                    <span class="protected-token" contenteditable="false">[ADDRESS]</span>.
                </p>
                <p>
                    তার নৈতিক চরিত্র ভালো। আমি তার সর্বাঙ্গীন মঙ্গল কামনা করি।
                </p>
                <p>
                    The remaining text is fully editable. You can delete the spaces around the tokens, but you cannot edit the text inside the blue box.
                </p>
            </div>

            

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

<style>
    /* Custom styles for the editor and tokens */
    #editor {
        min-height: 300px;
        padding: 15px;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        background-color: #ffffff;
        font-size: 1rem;
        line-height: 1.6;
        outline: none; /* Remove default focus outline */
    }
    
    /* Style for the protected (non-editable) tokens */
    .protected-token {
        display: inline-block;
        background-color: #007bff; /* Primary blue from Bootstrap */
        color: white;
        padding: 2px 8px;
        margin: 0 2px;
        border-radius: 4px;
        font-weight: 600;
        cursor: default;
        user-select: none; /* Prevent selection of internal text */
    }
</style>

<script>
    // --- JAVASCRIPT LOGIC FOR PROTECTED TOKENS ---
    
    const editor = document.getElementById('editor');

    /**
     * Inserts a new token (span) at the current cursor position in the contenteditable div.
     * @param {string} tokenText - The text of the token (e.g., '[NAME]').
     */
    function insertToken(tokenText) {
        // Create the non-editable token element
        const tokenSpan = document.createElement('span');
        tokenSpan.className = 'protected-token';
        tokenSpan.setAttribute('contenteditable', 'false'); // KEY: Makes the content non-editable
        tokenSpan.textContent = tokenText;

        // Use the browser's Range/Selection API to insert the element
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            range.deleteContents(); // Delete any selected content first
            
            // Insert the token and a trailing space for better usability
            range.insertNode(tokenSpan);
            range.insertNode(document.createTextNode('\u00A0')); // Non-breaking space
            
            // Move the cursor after the inserted element
            range.setStartAfter(tokenSpan);
            range.collapse(true);
            selection.removeAllRanges();
            selection.addRange(range);
        } else {
            // If no selection, just append (less ideal, but a fallback)
            editor.appendChild(document.createTextNode('\u00A0'));
            editor.appendChild(tokenSpan);
            editor.appendChild(document.createTextNode('\u00A0'));
        }
        editor.focus(); // Ensure the editor stays focused
    }

    /**
     * Prevents partial deletion of a token by forcing the deletion of the entire token.
     * This improves the user experience for protected fields.
     */
    editor.addEventListener('keydown', function(event) {
        const selection = window.getSelection();
        if (!selection.rangeCount) return;

        const range = selection.getRangeAt(0);
        
        // 1. Check for Backspace (key: 8)
        if (event.key === 'Backspace') {
            // Check if the caret is immediately after a protected token
            let node = range.startContainer;
            let offset = range.startOffset;

            // If the cursor is at the beginning of a text node, check the previous element
            if (node.nodeType === 3 && offset === 0) {
                node = node.previousSibling;
                offset = node ? node.textContent.length : 0;
            }
            
            // Look for a token right before the cursor
            if (node && node.nodeType === 1 && node.classList.contains('protected-token')) {
                // Prevent default backspace behavior
                event.preventDefault();
                
                // Get the parent element and remove the whole token
                const parent = node.parentNode;
                parent.removeChild(node);
                
                // Set cursor position back where the token was
                range.setStart(parent, Array.from(parent.childNodes).indexOf(node));
                range.collapse(true);
                selection.removeAllRanges();
                selection.addRange(range);
                
                return;
            }
        }
        
        // 2. Check for Delete (key: 46) - Less common but good practice
        if (event.key === 'Delete') {
            // Check if the caret is immediately before a protected token
            let node = range.startContainer;
            let offset = range.startOffset;
            
            // Look for a token right after the cursor
            let nextNode = node.childNodes ? node.childNodes[offset] : null;

            if (nextNode && nextNode.nodeType === 1 && nextNode.classList.contains('protected-token')) {
                event.preventDefault();
                nextNode.parentNode.removeChild(nextNode);
            }
        }
    });

    /**
     * Example function to show what happens when the admin saves the template.
     * It extracts the full HTML content. On the server side, you would parse the
     * HTML, identify the tokens, and save the result (or the HTML itself) to the database.
     */
    function saveTemplate() {
        const contentHtml = editor.innerHTML;
        console.log("--- Certificate Template HTML Content ---");
        console.log(contentHtml);
        
        // For demonstration, we show a success message
        const message = `Template saved successfully! Content length: ${contentHtml.length} characters. Check the console for the HTML output.`;
        
        // Use a clean, AdminLTE-style replacement for alert()
        alert(message); // Using alert here for simplicity in this file, but in a real dashboard, use a toast or modal!
    }

    // A simple replacement for alert that looks better with AdminLTE (optional, but better)
    function alert(message) {
        const alertHtml = `
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="position:fixed; top:20px; right:20px; z-index:1050;">
                <i class="icon fas fa-check"></i> ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        $('body').append(alertHtml);
        setTimeout(() => $('.alert').alert('close'), 5000); // Auto-close after 5 seconds
    }

</script>

