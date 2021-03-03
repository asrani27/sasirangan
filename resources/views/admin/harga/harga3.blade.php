<!DOCTYPE html>

<html>

<head>

    <title>Laravel Ajax Request using X-editable bootstrap Plugin Example</title>



    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>



</head>



<body>

<div class="container">

    <h3>Laravel Ajax Request using X-editable bootstrap Plugin Example</h3>

    <table class="table table-bordered">

        <tr>

            <th>Name</th>

            <th>Email</th>

            <th width="100px">Action</th>

        </tr>

        @foreach($data as $user)

            <tr>

                <td><a href="" class="update" data-name="name" data-type="text" data-pk="{{ $user['bahan_id'] }}" data-title="Enter name">{{ $user['bahan'] }}</a></td>

                <td><a href="" class="update" data-name="email" data-type="email" data-pk="{{ $user['bahan_id'] }}" data-title="Enter email">{{ $user['bahan'] }}</a></td>

                <td><button class="btn btn-danger btn-sm">Delete</button></td>

            </tr>

        @endforeach        

    </table>

</div>

</body>



<script type="text/javascript">



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $('.update').editable({

           url: '/data/bahan/update',
           type: 'post',
           pk: 1,
           name: 'name',
           title: 'Enter name',
           dataType: 'JSON',

           params: function(params) {
               
            params.name = $(this).editable().data('name');
            console.log(params);
            return params;
        }

    });



</script>

</html>
