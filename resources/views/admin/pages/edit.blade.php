@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header" style="font-family: 'Times New Roman', Times, serif ; ">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ;">
                    <h1><i class="fas fa-file-alt nav-icon"></i>&nbsp;Page / Edit</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('pages.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i><strong
                            style="font-family: 'Times New Roman', Times, serif;">Back to Page</strong>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content" style="font-family: 'Times New Roman', Times, serif ; ">
        <!-- Default box -->
        <div class="container-fluid">
            @include("admin.message")
            <form action="" method="post" id="pageForm" name="pageForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif ; ">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input value="{{ $page->name }}" type="text" name="name" id="name" class="form-control"
                                        placeholder="Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input value="{{ $page->slug }}" type="text" name="slug" id="slug" class="form-control"
                                        placeholder="Slug">
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" class="summernote" cols="30"
                                        rows="10">{!! $page->content !!} </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3" style="font-family: 'Times New Roman', Times, serif; font-weight: bold ;">
                                    <label for="status">Show On Home</label>
                                    <select name="showHome" id="showHome" class="form-control">
                                        <option {{ ($page->showHome == 'Yes') ? 'selected' : '' }} value="Yes"
                                            style="font-family: 'Times New Roman', Times, serif;">Yes
                                        </option>
                                        <option {{ ($page->showHome == 'No') ? 'selected' : '' }} value="No"
                                            style="font-family: 'Times New Roman', Times, serif;">No
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-outline-light btn-primary">Update</button>
                    <a href="{{ route('pages.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
    <script>
        $("#pageForm").submit(function (event) {
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route("pages.update", $page->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response["status"] == true) {

                        window.location.href = "{{ route('pages.index') }}";

                        $("#name").removeClass('is-invalid').siblings('p')
                            .removeClass('invalid-feedback').html("");

                        $("#slug").removeClass('is-invalid').siblings('p')
                            .removeClass('invalid-feedback').html("");
                    } else {
                        var errors = response['errors'];
                        if (errors['name']) {
                            $("#name").addClass('is-invalid').siblings('p')
                                .addClass('invalid-feedback').html(errors['name']);
                        } else {
                            $("#name").removeClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }

                        if (errors['slug']) {
                            $("#slug").addClass('is-invalid').siblings('p')
                                .addClass('invalid-feedback').html(errors['slug']);
                        } else {
                            $("#slug").removeClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                    }

                }, error: function (jqXHR, exception) {
                    console.log("Something went wrong");
                }
            });
        });

        $("#name").change(function () {
            element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'get',
                data: { title: element.val() },
                dataType: 'json',
                success: function (response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response["status"] == true) {
                        $("#slug").val(response["slug"]);
                    }
                }
            });
        });


    </script>

@endsection