@extends('layouts.app')
@section('title') ড্যাশবোর্ড | ব্যবহারকারী সনদ তালিকা @endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <style>
        {{-- .card {
            border-radius: 0.25rem;
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        }
        .card-header {
            background-color: #f8f9fa; 
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
        .profile-image-placeholder {
            width: 90px;
            height: 90px;
            background-color: #ced4da; 
            color: #495057;
            font-size: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            border: 3px solid #fff;
            box-shadow: 0 0 0 2px #adb5bd;
        }
        .btn-print {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        } --}}
    </style>
@endsection

@section('content')
	@section('page-header') ব্যবহারকারী সনদ তালিকা ({{ $user->name }})@endsection
  @section('page-header-right')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">ড্যাশবোর্ড</a></li>
        <li class="breadcrumb-item active">ব্যবহারকারী সনদ তালিকা</li>
    </ol>
  @endsection
    <div class="container-fluid">
		  <div class="row">
              
        <!-- ============================================== -->
        <!-- বাম কলাম: ব্যবহারকারীর মৌলিক তথ্য (COL-MD-4) -->
        <!-- ============================================== -->
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    
                    <!-- প্রোফাইল শিরোনাম/ছবির স্থান -->
                    <div class="text-center">
                        <div class="profile-image-placeholder">
                            <i class="fas fa-user-circle text-primary"></i>
                        </div>
                        <h3 class="profile-username text-center font-weight-bold">
                            <?php echo $user->name ?? 'নাম'; ?>
                        </h3>
                        <p class="text-muted text-center">নাগরিক</p>
                    </div>

                    <!-- ব্যবহারকারীর বিবরণী তালিকা -->
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b><i class="fas fa-id-card mr-1 text-primary"></i> জাতীয় পরিচয়পত্র (এনআইডি)</b> 
                            <a class="float-right text-dark font-weight-bold"><?php echo $user->nid ?? '০১২৩৪৫৬৭৮৯'; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b><i class="fas fa-phone mr-1 text-primary"></i> মোবাইল</b> 
                            <a class="float-right text-dark"><?php echo $user->mobile ?? '+৮৮০১XXXXXXXXX'; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b><i class="fas fa-envelope mr-1 text-primary"></i> ইমেল</b> 
                            <a class="float-right text-dark"><?php echo $user->email ?? 'user@example.com'; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b><i class="fas fa-map-marker-alt mr-1 text-primary"></i> স্থানীয় অফিস আইডি</b> 
                            <a class="float-right text-dark"><?php echo $user->local_office_id ?? 'DHAKA-005'; ?></a>
                        </li>
                    </ul>

                    <!-- অ্যাকশন বাটন (উদাহরণ) -->
                    <button type="button" class="btn btn-primary btn-block">
                        <i class="fas fa-edit mr-1"></i> নাগরিকের তথ্য সম্পাদনা করুন
                    </button>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-4 -->

        <!-- ============================================== -->
        <!-- ডান কলাম: সনদপত্রের তালিকা (COL-MD-8) -->
        <!-- ============================================== -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-file-alt mr-1 text-info"></i> ইস্যুকৃত সনদপত্রসমূহ</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">ক্রমিক নং</th>
                                    <th>সনদপত্রের প্রকার</th>
                                    <th>ইস্যুর তারিখ</th>
                                    <th style="width: 150px">অবস্থা</th>
                                    <th style="width: 120px">পদক্ষেপ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- PHP Loop placeholder for $user->certificates -->
                                <?php 
                                // Mock Certificate Data for display
                                $certificates = [
                                    (object)['id' => 101, 'type' => 'জন্ম নিবন্ধন', 'issue_date' => '2020-05-15', 'status' => 'Issued', 'certificate_id' => 'BR-5678-20'],
                                    (object)['id' => 102, 'type' => 'ডোমিসাইল সার্টিফিকেট', 'issue_date' => '2022-01-20', 'status' => 'Pending Review', 'certificate_id' => 'DC-1234-22'],
                                    (object)['id' => 103, 'type' => 'চারিত্রিক সনদপত্র', 'issue_date' => '2023-11-01', 'status' => 'Issued', 'certificate_id' => 'CC-9012-23'],
                                ];
                                ?>
                                
                                <?php foreach ($certificates as $cert): ?>
                                <tr>
                                    <td><?php echo $cert->id; ?></td>
                                    <td>
                                        <div class="font-weight-bold"><?php echo $cert->type; ?></div>
                                        <small class="text-muted">রেফারেন্স: <?php echo $cert->certificate_id; ?></small>
                                    </td>
                                    <td><?php echo date('d M, Y', strtotime($cert->issue_date)); ?></td>
                                    <td>
                                        <?php 
                                        $statusText = '';
                                        $badgeClass = 'secondary';
                                        
                                        if ($cert->status == 'Issued') {
                                            $statusText = 'ইস্যু হয়েছে';
                                            $badgeClass = 'success';
                                        } elseif ($cert->status == 'Pending Review') {
                                            $statusText = 'পর্যালোচনার অপেক্ষায়';
                                            $badgeClass = 'warning';
                                        } else {
                                            $statusText = 'অন্যান্য';
                                        }
                                        ?>
                                        <span class="badge badge-<?php echo $badgeClass; ?>"><?php echo $statusText; ?></span>
                                    </td>
                                    <td>
                                        <button 
                                            class="btn btn-sm btn-info btn-print" 
                                            onclick="printCertificate('<?php echo $cert->certificate_id; ?>', '<?php echo $cert->type; ?>')"
                                            title="সনদপত্র প্রিন্ট করুন: <?php echo $cert->certificate_id; ?>"
                                        >
                                            <i class="fas fa-print"></i> প্রিন্ট করুন
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                                <?php if (empty($certificates)): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted p-4">
                                        <i class="fas fa-exclamation-circle mr-1"></i> এই নাগরিকের জন্য কোনো সনদপত্র পাওয়া যায়নি।
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-8 -->
    </div>
    <!-- /.row -->
        
    </div>
@endsection

@section('third_party_scripts')
    
@endsection