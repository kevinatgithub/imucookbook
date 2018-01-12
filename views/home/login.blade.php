@extends("layout.default")

@section('content')
     <div class="row">
        <div class="col-lg-8">
            <div class="jumbotron">
                <h1>IMU Cook Book</h1>
                <p><strong>recipe</strong>, <em>n</em>. : a set of instructions for making something</p>
            </div>
            <div class="row">
                <div class="col-lg-6">
                <h1>About</h1>
                a book of cooking directions and recipes; broadly : a book of detailed instructions.
                </div>
                <div class="col-lg-6">
                    <h1>Features</h1>
                    <ul>
                        <li>Categorical posting of Article</li>
                        <li>Sharing category of others</li>
                        <li>Voting of Article</li>
                        <li>Top Articles</li>
                        <li>Commenting of Article</li>
                    </ul>                   
                </div>
            </div>
        </div>
         <div class="col-lg-4">
            <ul class="list-group">
                <li class="list-group-item active">User Login</li>
                <li class="list-group-item">
                    @include('components.alert')
                    <form action="" class="form-horizontal" method="POST">
                        <div class="form-group">
                            <label for="" class="control-label col-lg-4">User ID</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="user_id" id="user_id" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-lg-4">Password</label>
                            <div class="col-lg-8">
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-8 col-lg-offset-4">
                                <input type="submit" class="btn btn-default" value="Login">
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
         </div>
     </div>
@stop

@section('scripts')
    <script>
        $("#user_id").focus();
    </script>
@stop