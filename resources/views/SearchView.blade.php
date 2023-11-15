@extends('layouts.app')
@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <form >
        @csrf
        <!-- Search form -->
        <div class="container" style="margin-top:5% ">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Search Name</h3>
                    </div>

                </div>
            </div><!-- /.container-fluid -->

            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h5 style="display: inline">Book</h5>
                        <select class="select form-control-lg"  class="width" name="book_id" id="book_select" class="form-control" style="display: inline;margin:10px;margin-left: 11.6%;width: 350px" >
                            <option disabled selected>-----Select-----</option>
                            @foreach($book as $abc3)
                                <option value="{{$abc3->id}}">{{$abc3->title}}</option>
                            @endforeach
                        </select><br>


                       <h6 style="display: inline">Search Keyword</h6>
                        <input class="select form-control-lg" class="width" name="search" id="search" placeholder="Enter keyword to search" style="display: inline;margin:10px;margin-left: 5%;width: 350px">

                        <div class="card-footer">
                            <button type="submit" id="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <br>
            <br>
            <div class="container">
                <div class="card card-default">
                    <div class="card-header">

                        <div id="main_data"></div>

                    </div>
                </div>
            </div>

        </div>
        </div>
        </div>

        </div>








    </form>
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
        $("form").submit(function (e) {
            e.preventDefault(e);
            let book_id = parseInt(document.getElementById('book_select').value);
            let search=document.getElementById('search').value;



            $.ajax({
                url: "{{url('datamain/api/call/search')}}",
                type: "POST",
                data:
                    {

                        book_id: book_id,
                        search:search,

                        _token: '{{csrf_token()}}'
                    },
                dataType: 'json',


                success: function (result) {
                    console.log(result);
                    $('#main_data').html('');
                    $('#main_data').append(result);
                }


            });

        });



    </script>
    </form>
@endsection
