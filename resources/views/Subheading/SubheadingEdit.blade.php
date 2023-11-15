@extends('layouts.app')
@section('content')
    <section class="content" style="margin-left: 0%;margin-top: 1%">

        <div class="container-sm">
            <div class="card">
                <div class="card-header">
                    <p style="font-family: 'Berlin Sans FB';font-size: 24px">Edit Sub Heading Name</p>
                    <form method="post" action="{{route('subheading_update',$data[0]->id)}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Heading Name</label>
                                <input type="text" value="{{$data[0]->title}}" class="form-control" id="edit" name="sub_name" placeholder="Enter SubHeading name">
                            </div>

                            <br>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="data">Submit</button>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </form>


                </div>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        </div>
        <!-- /.container-fluid -->


    </section>
    {{--    <script>--}}


    {{--const updating=(data)=>{--}}
    {{--console.log(data);--}}
    {{--}--}}
    {{--$(document).ready(function (){--}}
    {{--$(document).on('click','#data',function (event){--}}
    {{--event.preventDefault();--}}
    {{--var data={'edit':$('#edit').val(),}--}}
    {{--console.log(data);--}}
    {{--$.ajaxSetup({--}}
    {{--    headers: {--}}
    {{--        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--    }--}}
    {{--});--}}
    {{--$.ajax({--}}
    {{--url:"/edit/book/name/{id}",--}}
    {{--async:false,--}}
    {{--type:"post",--}}
    {{--    data:data,--}}
    {{--    success:function (data){--}}
    {{--        Swal.fire({--}}
    {{--            title: 'Do you want to save the changes?',--}}
    {{--            showDenyButton: true,--}}
    {{--            showCancelButton: true,--}}
    {{--            confirmButtonText: 'Save',--}}
    {{--            denyButtonText: `Don't save`,--}}
    {{--        }).then((result) => {--}}
    {{--            /* Read more about isConfirmed, isDenied below */--}}
    {{--            if (result.isConfirmed) {--}}
    {{--                Swal.fire('Saved!', '', 'success')--}}
    {{--            } else if (result.isDenied) {--}}
    {{--                Swal.fire('Changes are not saved', '', 'info')--}}
    {{--            }--}}
    {{--        })--}}
    {{--    console.log("Hello ");--}}
    {{--    }--}}
    {{--})--}}
    {{--})--}}
    {{--})--}}





    {{--    </script>--}}

@endsection
