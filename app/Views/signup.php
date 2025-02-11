<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body class="">
    <div class="container mt-3">

    <h3>Sign Up</h3>

    <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <?= $success; ?>
            </div>
        <?php endif; ?>

        <!-- Display Error Message -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <div id="success-message" class="alert alert-success" style="display:none;"></div>
        <div id="error-message" class="alert alert-danger" style="display:none;"></div>
        <div id="validation-errors" class="alert alert-danger" style="display:none;"></div>


        <form id="signupForm" action="<?= site_url('/signup_action') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
                <label for="exampleInputPassword11">Name</label>
                <input type="text" name="username" class="form-control" id="exampleInputPassword11" placeholder="Name" >
            </div>

            <div class="form-group">
                <label for="exampleInputPassword12">Mobile</label>
                <input type="number" name="mobile" class="form-control" id="exampleInputPassword12" placeholder="Mobile" >
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" >
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
           
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <!-- <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="<?= site_url('/login') ?>">Login</a>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#signupForm').on('submit', function(e){
                e.preventDefault(); // Prevent the default form submission (page refresh)
                
                // Clear previous messages
                $('#success-message').hide().html('');
                $('#error-message').hide().html('');
                $('#validation-errors').hide().html('');

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response){
                        if(response.success) {
                            // Show success message
                            $('#success-message').html(response.success).show();

                            setTimeout(function(){
                                window.location.href = "<?= site_url('login') ?>";
                            }, 2000);
                        }
                        else if(response.error) {
                            // Show error message
                            $('#error-message').html(response.error).show();
                        }
                        else if(response.validation_errors) {
                            // Show validation errors
                            var errorsHtml = '<ul>';
                            $.each(response.validation_errors, function(key, error){
                                errorsHtml += '<li>' + error + '</li>';
                            });
                            errorsHtml += '</ul>';
                            $('#validation-errors').html(errorsHtml).show();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        // Handle any AJAX errors
                        $('#error-message').html("An error occurred: " + textStatus).show();
                    }
                });
            });
        });
    </script>
</body>

</html>