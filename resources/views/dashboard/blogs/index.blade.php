@extends('layouts.app')
@section('title') ড্যাশবোর্ড | ব্লগ @endsection

@section('third_party_stylesheets')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/select2-bootstrap4.min.css') }}" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style type="text/css">
  .select2-selection__choice{
      background-color: rgba(0, 123, 255) !important;
  }
  .note-editor.note-frame .note-editing-area .note-editable {
      min-height: 200px; /* Adjust height for the editor */
  }
</style>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')
    @section('page-header') ব্লগসমূহ @endsection
    @section('page-header-right')
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">ড্যাশবোর্ড</a></li>
          <li class="breadcrumb-item active">ব্লগসমূহ</li>
      </ol>
    @endsection
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">ব্লগসমূহ </h3><span style="margin-left: 5px;">(মোটঃ {{ $totalblogs }} টি ব্লগ)</span>
          
                      <div class="card-tools">
                          <form class="form-inline form-group-lg" action="">
                            <div class="form-group">
                              <input type="search-param" class="form-control form-control-sm" placeholder="ব্লগ খুঁজুন" id="search-param" required>
                            </div>
                            <button type="button" id="search-button" class="btn btn-default btn-sm" style="margin-left: 5px;">
                              <i class="fas fa-search"></i> খুঁজুন
                            </button>
                            <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addBlogModal" style="margin-left: 5px;">
                                <i class="fas fa-plus-circle"></i> নতুন ব্লগ যোগ
                            </button>
                          </form>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Title</th>
                                  <th>Author</th>
                                  <th>Info</th>
                                  <th width="10%">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($blogs as $blog)
                              <tr>
                                  <td>
                                      <a href="{{ route('blog.single', $blog->slug) }}" target="_blank">{{ $blog->title }}</a>
                                      <br/>
                                      <span class="badge bg-success">{{ $blog->blogcategory->name }}</span>
                                      {{-- @foreach($blog->tags as $tag)
                                        <span class="badge bg-primary">{{ $tag->name }}</span>
                                      @endforeach --}}
                                  </td>
                                  <td>{{ $blog->user->name }}</td>
                                  <td><i class="far fa-heart"></i> {{ $blog->likes }}, <i class="far fa-eye"></i> {{ $blog->views }}</td>
                                                                
                                  <td>
                                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editBlogModal{{ $blog->id }}">
                                          <i class="far fa-edit"></i>
                                      </button>
                                      {{-- Edit Blog Modal Code --}}
                                      {{-- Edit Blog Modal Code --}}
                                      <!-- Modal -->
                                      <div class="modal fade" id="editBlogModal{{ $blog->id }}" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel" aria-hidden="true" data-backdrop="static">
                                          <div class="modal-dialog modal-xl" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header bg-success">
                                                <h5 class="modal-title" id="editBlogModalLabel">ব্লগ হালনাগাদ</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form method="post" action="{{ route('dashboard.blogs.update', $blog->id) }}" enctype='multipart/form-data'>
                                                <div class="modal-body">
                                                  @csrf
                                                  <input type="text" name="title" value="{{ $blog->title }}" class="form-control mb-3" placeholder="ব্লগ শিরোনাম *" required>
                                                  <input type="text" name="slug" value="{{ $blog->slug }}" class="form-control mb-3" placeholder="ব্লগ স্লাগ (Optional)" required>
                                                  <div class="row">
                                                      <div class="col-md-6">
                                                        <input type="text" name="keywords" value="{{ $blog->keywords }}" class="form-control mb-3" placeholder="SEO keywords (Optional)">
                                                      </div>
                                                      <div class="col-md-6">
                                                        <input type="text" name="description" value="{{ $blog->description }}" class="form-control mb-3" placeholder="SEO Description (Optional)">
                                                      </div>
                                                  </div>
                                                  <textarea id="bodysummernote{{ $blog->id }}" class="summernote-editor" name="body">{{ $blog->body }}</textarea>
                                                  <br/>
                                                  <div class="row">
                                                      <div class="col-md-6">
                                                          <div class="input-group mb-3">
                                                              <select name="blogcategory_id" class="form-control" required>
                                                                  <option selected="" disabled="" value="">ক্যাটাগরি</option>
                                                                  @foreach ($blogcategories as $blogcategory)
                                                                      <option value="{{ $blogcategory->id }}" @if($blogcategory->id == $blog->blogcategory_id) selected @endif>{{ $blogcategory->name }}</option>
                                                                  @endforeach
                                                              </select>
                                                              <div class="input-group-append">
                                                                  <div class="input-group-text"><span class="fas fa-bookmark"></span></div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label for="image">ছবি (প্রয়োজনে)</label>
                                                              <input type="file" id="image" name="featured_image" accept="image/*">
                                                          </div>
                                                          <center>
                                                            @if($blog->featured_image != null)
                                                                <img src="{{ asset('images/blogs/'.$blog->featured_image) }}" id='img-upload' style="width: 250px; height: auto;" class="img-responsive" />
                                                            @else
                                                              <img src="{{ asset('images/placeholder.png')}}" id='img-upload' style="width: 250px; height: auto;" class="img-responsive" />
                                                            @endif
                                                          </center>
                                                      </div>
                                                  </div>    
                                                      
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                                  <button type="submit" class="btn btn-success">দাখিল করুন</button>
                                                </div>
                                            </form>
                                          </div>
                                          </div>
                                      </div>

                                      <script>
                                          $('#bodysummernote{{ $blog->id }}').summernote({
                                            // callbacks: {
                                            //   onChange: function(contents, $editable) {
                                            //     $("textarea#content").html(contents);
                                            //   }
                                            // },
                                            dialogsInBody: true,
                                            placeholder: 'কন্টেন্ট লিখুন *',
                                            tabsize: 3,
                                            height: 300,
                                            toolbar: [
                                              ['style', ['style']],
                                              ['font', ['bold', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
                                              ['color', ['color']],
                                              ['para', ['ul', 'ol', 'paragraph']],
                                              ['table', ['table']],
                                              ['insert', ['link', 'picture', 'video']],
                                              ['view', ['fullscreen', 'codeview', 'help']]
                                            ]
                                          });
                                      </script>

<script type="text/javascript">
    $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });

      $('.btn-file :file').on('fileselect', function(event, label) {
          var input = $(this).parents('.input-group').find(':text'),
              log = label;
          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }
      });
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#img-upload{{ $blog->id }}').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      $("#image{{ $blog->id }}").change(function(){
          readURL(this);
          var filesize = parseInt((this.files[0].size)/1024);
          if(filesize > 10000) {
            $("#image{{ $blog->id }}").val('');
            // toastr.warning('File size is: '+filesize+' Kb. try uploading less than 300Kb', 'WARNING').css('width', '400px;');
            Toast.fire({
                icon: 'warning',
                title: 'File size is: '+filesize+' Kb. try uploading less than 300Kb'
            })
            setTimeout(function() {
            $("#img-upload{{ $blog->id }}").attr('src', '{{ asset('images/placeholder.png') }}');
            }, 1000);
          }
      });

    });
</script>
                                      {{-- Edit Blog Modal Code --}}
                                      {{-- Edit Blog Modal Code --}}
          
                                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteBlogModal{{ $blog->id }}" disabled>
                                          <i class="far fa-trash-alt"></i>
                                      </button>
                                  </td>
                                  {{-- Delete Blog Modal Code --}}
                                  {{-- Delete Blog Modal Code --}}
                                  <!-- Modal -->
                                  <div class="modal fade" id="deleteBlogModal{{ $blog->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteBlogModalLabel" aria-hidden="true" data-backdrop="static">
                                      <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header bg-danger">
                                          <h5 class="modal-title" id="deleteBlogModalLabel">ব্লগ ডিলেট</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                          </div>
                                          <div class="modal-body">
                                            আপনি কি নিশ্চিতভাবে এই ব্লগটি ডিলেট করতে চান?<br/><br/>
                                            <center>
                                                <big><b>{{ $blog->title }}</b></big>
                                            </center>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                          <a href="{{ route('dashboard.blogs.delete', $blog->id) }}" class="btn btn-danger">ডিলেট করুন</a>
                                          </div>
                                      </div>
                                      </div>
                                  </div>
                                  {{-- Delete Blog Modal Code --}}
                                  {{-- Delete Blog Modal Code --}}
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  {{ $blogs->links() }}
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">ক্যাটাগরি সমূহ</h3>
          
                      <div class="card-tools">
                          <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#addBlogCategoryModal">
                              <i class="fas fa-plus-circle"></i> নতুন ক্যাটাগরি
                          </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Category</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($blogcategories as $blogcategory)
                              <tr>
                                  <td>
                                    {{ $blogcategory->name }} <small>({{ $blogcategory->blogs->count() }} টি ব্লগ)</small>
                                  </td>
                              
                                  <td align="right" width="40%">
                                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editBlogCategoryModal{{ $blogcategory->id }}">
                                          <i class="far fa-edit"></i>
                                      </button>
                                      {{-- Edit BlogCategory Modal Code --}}
                                      {{-- Edit BlogCategory Modal Code --}}
                                      <!-- Modal -->
                                      <div class="modal fade" id="editBlogCategoryModal{{ $blogcategory->id }}" tabindex="-1" role="dialog" aria-labelledby="editBlogCategoryModalLabel" aria-hidden="true" data-backdrop="static">
                                          <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header bg-warning">
                                              <h5 class="modal-title" id="editBlogCategoryModalLabel">ক্যাটাগরি হালনাগাদ</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                              </div>
                                              <form method="post" action="{{ route('dashboard.blogs.blogcategory.update', $blogcategory->id) }}">
                                                  <div class="modal-body">
                                                      @csrf
                                                      <div class="input-group mb-3">
                                                          <input type="text"
                                                                  name="name"
                                                                  class="form-control"
                                                                  value="{{ $blogcategory->name }}"
                                                                  placeholder="নাম" required>
                                                          <div class="input-group-append">
                                                              <div class="input-group-text"><span class="far fa-bookmark"></span></div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                                  <button type="submit" class="btn btn-warning">দাখিল করুন</button>
                                                  </div>
                                              </form>
                                          </div>
                                          </div>
                                      </div>
                                      {{-- Edit BlogCategory Modal Code --}}
                                      {{-- Edit BlogCategory Modal Code --}}
          
                                      {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteTopicModal{{ $blogcategory->id }}" disabled>
                                          <i class="far fa-trash-alt"></i>
                                      </button> --}}
                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>
        </div>

    {{-- Add Blog Modal Code --}}
    {{-- Add Blog Modal Code --}}
    <!-- Modal -->
    <div class="modal fade" id="addBlogModal" tabindex="-1" role="dialog" aria-labelledby="addBlogModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title" id="addBlogModalLabel">নতুন ব্লগ যোগ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('dashboard.blogs.store') }}" enctype='multipart/form-data'>
              <div class="modal-body">
                    @csrf
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control mb-3" placeholder="ব্লগ শিরোনাম *" required>
                    <input type="text" name="slug" value="{{ old('slug') }}" class="form-control mb-3" placeholder="ব্লগ স্লাগ (Optional)">
                    <div class="row">
                        <div class="col-md-6">
                          <input type="text" name="keywords" value="{{ old('keywords') }}" class="form-control mb-3" placeholder="SEO keywords (Optional)">
                        </div>
                        <div class="col-md-6">
                          <input type="text" name="description" value="{{ old('description') }}" class="form-control mb-3" placeholder="SEO Description (Optional)">
                        </div>
                    </div>
                    <textarea id="bodysummernote" class="summernote-editor" name="body"></textarea>
                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <select name="blogcategory_id" class="form-control" required>
                                    <option selected="" disabled="" value="">ক্যাটাগরি</option>
                                    @foreach ($blogcategories as $blogcategory)
                                        <option value="{{ $blogcategory->id }}">{{ $blogcategory->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-bookmark"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">ছবি (প্রয়োজনে)</label>
                                <input type="file" id="image" name="featured_image" accept="image/*">
                            </div>
                            <center>
                                <img src="{{ asset('images/placeholder.png')}}" id='img-upload' style="width: 250px; height: auto;" class="img-responsive" />
                            </center>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                <button type="submit" class="btn btn-success">দাখিল করুন</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    {{-- Add Blog Modal Code --}}
    {{-- Add Blog Modal Code --}}

{{-- Add Blog Category Modal Code --}}
{{-- Add Blog Category Modal Code --}}
<!-- Modal -->
<div class="modal fade" id="addBlogCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addBlogCategoryModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="addBlogCategoryModalLabel">নতুন ক্যাটাগরি যোগ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="{{ route('dashboard.blogs.blogcategory.store') }}">
            <div class="modal-body">
                  @csrf
                  <div class="input-group mb-3">
                      <input type="text"
                             name="name"
                             class="form-control"
                             value="{{ old('name') }}"
                             placeholder="নাম" required>
                      <div class="input-group-append">
                          <div class="input-group-text"><span class="far fa-bookmark"></span></div>
                      </div>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
              <button type="submit" class="btn btn-warning">দাখিল করুন</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  {{-- Add Blog Category Modal Code --}}
  {{-- Add Blog Category Modal Code --}}
@endsection

@section('third_party_scripts')
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<!-- Summernote JS for WYSIWYG editor -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script type="text/javascript">
    // Ensure jQuery is loaded before attempting to initialize Summernote
    // Also ensure Bootstrap 4's JavaScript is loaded in your layouts.app
    
    // Ensure jQuery and Summernote are loaded before this script runs
    $(document).ready(function() {
        if ($.fn.summernote) {
            $('.summernote-editor').summernote({
                toolbar: [
                    // Styles (Paragraph, H1-H6, Blockquote)
                    ['style', ['style']],

                    // Basic Text Formatting (Bold, Italic, Strikethrough, Underline, Clear formatting)
                    ['font', ['bold', 'italic', 'strikethrough', 'underline', 'clear']],

                    // Font Family and Font Size
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],

                    // Text Color and Background Color
                    ['color', ['color']],

                    // Paragraph Formatting (Lists, Indent/Outdent, Alignments)
                    ['para', ['ul', 'ol', 'paragraph', 'blockquote']],

                    // Insert Options (Link, Picture, Table, Horizontal Line)
                    ['insert', ['link', 'picture', 'table', 'hr']],

                    // History (Undo/Redo)
                    ['history', ['undo', 'redo']],

                    // Code View
                    ['view', ['codeview']],

                    // Fullscreen Toggle
                    ['misc', ['fullscreen']] // Add fullscreen option for convenience
                ],
                styleTags: [ // Define the styles available in the 'style' dropdown
                    'p',
                    'h1',
                    'h2',
                    'h3',
                    'h4',
                    'h5',
                    'h6',
                    'blockquote'
                ],
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica Neue', 'Helvetica', 'Impact', 'Lucida Grande', 'Tahoma', 'Times New Roman', 'Verdana', 'Inter'], // Example font names
                fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36'], // Example font sizes
                height: 200, // Set the height of the editor area
                dialogsInBody: true, // Prevents modals from being cut off if inside other modals
                callbacks: {
                    // You can add callbacks here for custom functionalities if needed, e.g., image upload
                    // onImageUpload: function(files) {
                    //     // Handle image upload logic here
                    // }
                }
            });
        } else {
            console.error("Summernote is not loaded. Ensure jQuery and Bootstrap 4 JS are loaded before Summernote JS.");
        }

        // Existing custom file input label update
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });


    // Search functionality
    $(document).on('click', '#search-button', function() {
        if($('#search-param').val() != '') {
            // The form action already handles the GET request, so just submit the form
            $(this).closest('form').submit();
        } else {
            $('#search-param').css({ "border": '#FF0000 2px solid'});
            // Assuming Toast.fire is defined globally or included
            if (typeof Toast !== 'undefined') {
                Toast.fire({
                    icon: 'warning',
                    title: 'Write something!'
                });
            } else {
                console.warn('Toast.fire function is not defined. Please include SweetAlert2.');
            }
        }
    });

    $("#search-param").keyup(function(e) {
        if(e.which == 13) { // Enter key
            e.preventDefault(); // Prevent default form submission
            $('#search-button').click(); // Trigger the search button click
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $('.multiple-select').select2({
      // theme: 'bootstrap4',
    });
    // ClassicEditor
    //     .create( document.querySelector( '.summernote' ) )
    //     .then( editor => {
    //             console.log( editor );
    //     } )
    //     .catch( error => {
    //             console.error( error );
    //     } );

    $('#bodysummernote').summernote({
      // callbacks: {
      //   onChange: function(contents, $editable) {
      //     $("textarea#question").html(contents);
      //   }
      // },
      dialogsInBody: true,
      placeholder: 'কন্টেন্ট লিখুন *',
      tabsize: 1,
      height: 300,
      toolbar: [
        ['font', ['bold', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
        ['insert', ['link', 'picture']],
        ['view', ['codeview']]
      ]
    });
</script>
<script type="text/javascript">
    $(document).ready( function() {
      $(document).on('click', '#search-button', function() {
        if($('#search-param').val() != '') {
          var urltocall = '{{ route('dashboard.blogs') }}' +  '/' + $('#search-param').val().replace(/\\|\//g, '%');
          location.href= urltocall;
        } else {
          $('#search-param').css({ "border": '#FF0000 2px solid'});
          Toast.fire({
              icon: 'warning',
              title: 'কিছু লিখে খুঁজুন!'
          })
        }
      });
      $("#search-param").keyup(function(e) {
        if(e.which == 13) {
          if($('#search-param').val() != '') {
            var urltocall = '{{ route('dashboard.blogs') }}' +  '/' + $('#search-param').val().replace(/\\|\//g, '%');
            location.href= urltocall;
          } else {
            $('#search-param').css({ "border": '#FF0000 2px solid'});
            Toast.fire({
                icon: 'warning',
                title: 'কিছু লিখে খুঁজুন!'
            })
          }
        }
      });

      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });

      $('.btn-file :file').on('fileselect', function(event, label) {
          var input = $(this).parents('.input-group').find(':text'),
              log = label;
          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }
      });
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#img-upload').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      $("#image").change(function(){
          readURL(this);
          var filesize = parseInt((this.files[0].size)/1024);
          if(filesize > 10000) {
            $("#image").val('');
            // toastr.warning('File size is: '+filesize+' Kb. try uploading less than 300Kb', 'WARNING').css('width', '400px;');
            Toast.fire({
                icon: 'warning',
                title: 'File size is: '+filesize+' Kb. try uploading less than 300Kb'
            })
            setTimeout(function() {
            $("#img-upload").attr('src', '{{ asset('images/placeholder.png') }}');
            }, 1000);
          }
      });

    });
</script>
@endsection