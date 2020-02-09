<div class="container">
    <form action="<?php echo base_url()?>home/password_reset" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Your Email address Or Phone Number</label>
            <input type="text" class="form-control" name="email" placeholder="Enter Your Email address Or Phone Number">
            <h6   class="form-text text-danger"><?php if(isset($error)){ echo $error;} ?></h6>
            <h6   class="form-text text-success"><?php if(isset($success)){ echo $success;} ?></h6>
        </div>

        <button type="submit" class="btn btn-primary">Reset your password</button>
    </form>

    </div>