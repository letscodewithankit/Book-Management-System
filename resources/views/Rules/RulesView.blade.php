@extends('layouts.app')
@section('content')
    <section class="content" style="margin-left: 0%;margin-top: 1%">
        @if(session('success'))
            <script>
                Swal.fire(
                    'Good job!',
                    'Rules data add successfully!',
                    'success'
                )
            </script>
        @endif
            @if(session('error'))
                <script>
                    Swal.fire(
                        'Good job!',
                        'The chapter data is already have so this data attached to this chapter!',
                        'success'
                    )
                </script>
            @endif
        <div class="container-sm">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rules Table</h3>
                            <a class="btn btn-primary" class="btn btn-default btn-rounded mb-4" data-bs-toggle="modal" data-bs-target="#modalLoginForm"   style="margin-left: 80%">Add Rules</a>
                        </div>
                        <!-- /.card-header -->
                        <h class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Rules_id</th>
                                    <th>Book_id</th>
                                    <th>Chapter_id</th>
                                    <th>Heading_id</th>
                                    <th>Subheading_id</th>
                                    <th>Subsubheading_id</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $abc)
                                    <tr>
                                        <td>{{$abc->id}}</td>
                                        <td>{{$abc->book_id}}</td>
                                        <td>{{$abc->chapter_id}}</td>
                                        <td>{{$abc->heading_id}}</td>
                                        <td>{{$abc->subheading_id}}</td>
                                        <td>{{$abc->subsubheading_id}}</td>
                                        <td>{{html_entity_decode(strip_tags(str_replace("&nbsp;","",$abc->cdescription)))  }}</td>
                                        <td>
                                            <a href="{{route('rules_edit',$abc->id)}}" class=" btn btn-dark" >Edit</a>
                                            <form method="POST" action="{{ route('Rules.delete', $abc->id) }}" style="display: inline">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip"  title='Delete'>Delete Title</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach


                                </tbody>

                            </table>

                            <div class="d-flex justify-content-center">
                                {!! $data->links() !!}
                            </div>

                            <!-- Modal for add book -->
                            <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h4 class="modal-title w-100 font-weight-bold">Add Rules</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body mx-14">

                                            <form method="post" action="{{route('rules_save')}}">
                                                @csrf
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select book name</label>
                                                                <select name="book_id" id="book_select"  class="form-control" required>
                                                                    <option disabled="disabled" selected="selected">----select----</option>
                                                                    @foreach($book as $abc3)
                                                                        <option value="{{$abc3->id}}">{{$abc3->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select Chapter name</label>
                                                                <select name="chapter_id" id="chapter_data"  class="form-control" required>

                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select heading name</label>
                                                                <select name="heading_id" id="heading_data"  class="form-control" >

                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select subhead 1 name</label>
                                                                <select name="subheading_id" id="subheading_data"  class="form-control" >

                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Select subsubhead 2 name</label>
                                                                <select name="subsubheading_id" id="subsubheading_data"  class="form-control" >

                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div><br>


                                                    <div class="form-group">
                                                        <label><strong>Description :</strong></label>
                                                        <textarea class="ckeditor form-control" name="description"></textarea>
                                                    </div>


                                                    <br>

                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>

                                                </div>
                                                <!-- /.card-body -->
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </section>

    <script>
        document.querySelector('#book_select').onchange = function(){
            var id=parseInt(document.getElementById('book_select').value);

            $.ajax({
                url:"{{url('heading/api/call')}}",
                type:"POST",
                data: {
                    book_id:id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success:function (result) {

                    $('#chapter_data').html('<option disabled selected value="">---Select Chapter---</option>');
                    $.each(result, function (key, value) {
                        $("#chapter_data").append('<option id="chapter_id" value="' + value
                            .id + '">' + value.title + '</option>');
                    });
                }

            });



        }

    </script>

    <script>
        document.querySelector('#chapter_data').onchange = function() {
            var ide = parseInt(document.getElementById('chapter_data').value);
            // console.log(ide);

            $.ajax({
                url:"{{url('subheading/api/call')}}",
                type:"POST",
                data: {
                    chapter_id:ide,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success:function (result) {

                    $('#heading_data').html('<option disabled selected value="">---Select Heading---</option>');
                    $.each(result, function (key, value) {
                        $("#heading_data").append('<option id="heading_id" value="' + value
                            .id + '">' + value.title + '</option>');
                    });
                }

            });


        }
    </script>

    <script>
        document.querySelector('#heading_data').onchange = function() {
            var idee = parseInt(document.getElementById('heading_data').value);
            // console.log(idee);

            $.ajax({
                url:"{{url('subsubheading/api/call')}}",
                type:"POST",
                data: {
                    heading_id:idee,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success:function (result) {

                    $('#subheading_data').html('<option disabled selected value="">---Select Heading---</option>');
                    $.each(result, function (key, value) {
                        $("#subheading_data").append('<option id="subheading_id" value="' + value
                            .id + '">' + value.title + '</option>');
                    });
                }

            });


        }
    </script>

    <script>
        document.querySelector('#subheading_data').onchange = function() {
            var ideee = parseInt(document.getElementById('subheading_data').value);
            console.log(ideee);

            $.ajax({
                url:"{{url('mainsubsubheading/api/call')}}",
                type:"POST",
                data: {
                    subheading_id:ideee,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',


                success:function (result) {
                      console.log(result);
                    $('#subsubheading_data').html('<option disabled selected value="">---Select SubSubHeading---</option>');
                    $.each(result, function (key, value) {
                        $("#subsubheading_data").append('<option id="subsubheading_id" value="' + value
                            .id + '">' + value.title + '</option>');
                    });
                }

            });


        }
    </script>

    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">

        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

    </script>
    </script>


@endsection
