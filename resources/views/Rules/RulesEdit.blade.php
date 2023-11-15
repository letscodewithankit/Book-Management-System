@extends('layouts.app')
@section('content')
    <section class="content" style="margin-left: 0%;margin-top: 1%">
        <div class="container-sm">
            <div class="card">
                <div class="card-header">
                    <p style="font-family: 'Berlin Sans FB';font-size: 24px">Edit Rules Name</p>
                    <form method="post" action="{{route('rules_update',$data[0]->id)}}">
                        @csrf
                        <div class="card-body">
                             <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">C_Description</label>
                                <textarea class="ckeditor form-control" placeholder="Enter C_Description"  name="rdescription">{{$data[0]->cdescription}}</textarea>
                            </div>

                            <br>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="data">Submit</button>
                            </div>

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
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();

        });
    </script>

@endsection
