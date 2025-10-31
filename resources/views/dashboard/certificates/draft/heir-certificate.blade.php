<style>
    .draft-container {
        position: relative;
        padding: 20px;
        border: 2px dashed #007bff; /* Primary color border */
        border-radius: 10px;
        background-color: #ffffff;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .draft-watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        color: rgba(220, 53, 69, 0.15); /* Semi-transparent red */
        font-size: 120px;
        font-weight: bold;
        pointer-events: none;
        user-select: none;
        z-index: 10;
    }
    .certificate-info {
        position: relative;
        z-index: 20; /* Ensure text is above watermark */
    }
    .info-label {
        font-weight: 600;
        color: #495057;
    }
    .heir-table th {
        background-color: #f8f9fa;
    }
</style>

<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="card card-primary card-outline">
            <div class="card-header no-print">
                <h3 class="card-title">খসড়া - ওয়ারিশ সনদ</h3>
                <div class="card-tools">
                    <span class="badge badge-warning">অবস্থা: {{ $certificate->status == 0 ? 'খসড়া' : 'অনুমোদিত' }}</span>
                </div>
            </div>
            <div class="card-body">

                @php
                    // Check if data payload exists and is accessible
                    $payload = $certificate->data_payload ?? null;
                    $applicant = $payload['applicant'] ?? [];
                    $heirs = $payload['heirs'] ?? [];
                @endphp

                @if ($payload)
                    <div class="draft-container">
                        <div class="draft-watermark">খসড়া খসড়া খসড়া</div>
                        <div class="certificate-info">
                            <h4 class="text-center mb-4 text-primary">ওয়ারিশান সনদপত্র</h4>
                            <hr>

                            <!-- Applicant Information Section -->
                            <h5 class="mb-3">আবেদনকারীর তথ্য (Applicant Details)</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><span class="info-label">নাম (Name):</span> {{ $applicant['name'] ?? 'N/A' }}</p>
                                    <p><span class="info-label">পিতা (Father):</span> {{ $applicant['father'] ?? 'N/A' }}</p>
                                    <p><span class="info-label">মাতা (Mother):</span> {{ $applicant['mother'] ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><span class="info-label">পরিচয়পত্র (ID Type):</span> {{ $applicant['id_type'] ?? 'N/A' }}</p>
                                    <p><span class="info-label">পরিচয় নং (ID No.):</span> {{ $applicant['id_value'] ?? 'N/A' }}</p>
                                    <p><span class="info-label">ইউনিয়ন/পৌরসভা:</span> {{ $applicant['union'] ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p><span class="info-label">ঠিকানা (Address):</span>
                                        গ্রাম: {{ $applicant['village'] ?? 'N/A' }},
                                        ওয়ার্ড: {{ $applicant['ward'] ?? 'N/A' }},
                                        পোস্ট অফিস: {{ $applicant['post_office'] ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>

                            <hr class="mt-4 mb-4">

                            <!-- Heirs Data Section -->
                            <h5 class="mb-3">ওয়ারিশগণের তালিকা (List of Heirs)</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm heir-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">ক্রমিক</th>
                                            <th style="width: 25%">নাম</th>
                                            <th style="width: 20%">সম্পর্ক</th>
                                            <th style="width: 20%">জন্ম তারিখ</th>
                                            <th style="width: 20%">পরিচয় নং</th>
                                            <th style="width: 10%">মন্তব্য</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($heirs as $index => $heir)
                                            <tr>
                                                <td>{{ bangla($index + 1) }}</td>
                                                <td>{{ $heir['name'] ?? '--' }}</td>
                                                <td>{{ $heir['relation'] ?? '--' }}</td>
                                                <td>{{ $heir['dob'] ?? '--' }}</td>
                                                <td>{{ $heir['id_data'] ?? '--' }}</td>
                                                <td>{{ $heir['remark'] ?? '--' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">কোন ওয়ারিশের তথ্য পাওয়া যায়নি।</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <hr class="mt-4">

                            <!-- Footer/Signature Placeholder -->
                            {{-- <div class="row mt-5">
                                <div class="col-4 text-center">
                                    <p class="border-top pt-2">আবেদনকারীর স্বাক্ষর</p>
                                </div>
                                <div class="col-4 text-center">
                                    <p>&nbsp;</p>
                                </div>
                                <div class="col-4 text-center">
                                    <p class="border-top pt-2">চেয়ারম্যান/মেয়র/কর্তৃপক্ষের স্বাক্ষর</p>
                                </div>
                            </div> --}}

                            <small class="d-block text-right text-muted mt-3">
                                আবেদনের সিরিয়াল: {{ $certificate->unique_serial ?? 'N/A' }} |
                                জমা দেওয়ার সময়: {{ $certificate->data_payload['submission_timestamp'] ?? 'N/A' }}
                            </small>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">
                        Certificate data payload is missing or invalid.
                    </div>
                @endif

            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-info no-print" onclick="window.print()">
                    <i class="fas fa-print"></i> খসড়া প্রিন্ট
                </button>
                <a href="{{ route('dashboard.certificates.edit', $certificate->unique_serial) }}" class="btn btn-warning no-print">
                    <i class="fas fa-print"></i> সংশোধন করুন
                </a>
                

                <form action="{{ route('dashboard.certificates.update', $certificate->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script type="text/javascript">
                      const ToastAprv = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: true,
                        showCancelButton: true,
                        timerProgressBar: false,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                      })
                    </script>
                        <button type="button" class="btn btn-success no-print" onclick="return ToastAprv.fire({ icon: 'warning', title: 'আপনি কি নিশ্চিত? এই সনদ স্থায়ীভাবে অনুমোদন করা হবে।' })">
                            <i class="fas fa-print"></i> অনুমোদন করুন
                        </button>
                        
                    </form>
                <!-- Add your edit/approve/reject buttons here -->
            </div>
        </div>
    </div>
</div>