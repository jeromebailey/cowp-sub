<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>One Page Wonder - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url('css/one-page-wonder.css');?>" rel="stylesheet">
    <link href="<?=base_url('css/login-sign-up.css');?>" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">WP Pal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
              <ul id="login-dp" class="dropdown-menu" style="margin-left: -200px; margin-top: 8px;">
        <li>
           <div class="row">
              <div class="col-md-12">
                Login
                
                 <form class="form" role="form" method="post" action="<?=base_url('Users/validate_login');?>" accept-charset="UTF-8" id="login-nav">
                    <div class="form-group">
                       <label class="sr-only" for="exampleInputEmail2">Email address</label>
                       <select class="form-control" id="user_type" name="user_type" required="required">
                         <option value="">Select User Type</option>
                         <option value="immigration-user">Immigration User</option>
                         <option value="company-user">Registered Company User</option>
                       </select>
                    </div>
                    <div class="form-group">
                       <label class="sr-only" for="exampleInputEmail2">Email address</label>
                       <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required autocomplete="off" name="user_email" id="user_email" >
                    </div>
                    <div class="form-group">
                       <label class="sr-only" for="exampleInputPassword2">Password</label>
                       <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required autocomplete="off" name="user_password" id="user_password">
                                             <div class="help-block text-right"><a href="">Forget the password ?</a></div>
                    </div>
                    <div class="form-group">
                       <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </div>
                    <div class="checkbox">
                       <label>
                       <input type="checkbox"> keep me logged-in
                       </label>
                    </div>
                 </form>
              </div>
           </div>
        </li>
      </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead">
      <div class="overlay">
        <div class="container">
          <h1 class="display-1 text-white">One Page Wonder</h1>
          <h2 class="display-4 text-white">Will Rock Your Socks Off</h2>
        </div>
      </div>
    </header>

    <section>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 order-2">
            <div class="p-5">
              <img class="img-fluid rounded-circle" src="https://unsplash.it/500/500?image=836" alt="">
            </div>
          </div>
          <div class="col-md-6 order-1">
            <div class="p-5">
              <h2 class="display-4">For those about to rock...</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="p-5">
              <img class="img-fluid rounded-circle" src="https://unsplash.it/500/500?image=452" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-5">
              <h2 class="display-4">We salute you!</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 order-2">
            <div class="p-5">
              <img class="img-fluid rounded-circle" src="https://unsplash.it/500/500?image=453" alt="">
            </div>
          </div>
          <div class="col-md-6 order-1">
            <div class="p-5">
              <h2 class="display-4">Let there be rock!</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?=base_url('js/jquery-slim.min.js');?>"></script>
    <script src="<?=base_url('js/popper.min.js');?>"></script>
    <script src="<?=base_url('js/bootstrap.min.js');?>"></script>

  </body>

</html>
