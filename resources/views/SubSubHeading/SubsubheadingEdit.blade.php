@extends('layouts.app')
@section('content')
    <section class="content" style="margin-left: 0%;margin-top: 1%">
        <div class="container-sm">
            <div class="card">
                <div class="card-header">
                    <p style="font-family: 'Berlin Sans FB';font-size: 24px">Edit SubSubheading Name</p>
                    <form method="post" action="{{route('subsubheading_update',$data[0]->id)}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">SubSubhHeading Name</label>
                                <input type="text" value="{{$data[0]->title}}" class="form-control" id="edit" name="subhsubh_name" placeholder="Enter Subsubheading name">
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

@endsection
