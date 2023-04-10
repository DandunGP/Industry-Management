@extends('Layouts.AuthTemp')

@section('title', 'Login')

@section('card-auth')
<section class="h-120 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
                    <div class="text-center">
                        <img src="<?= asset('images/logo.png') ?>"
                        style="width: 185px;" alt="logo">
                    </div>

                    <form action="{{ route('loginAuth') }}" method="POST">
                      @csrf
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Enter your username" />
                        </div>
    
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" />
                        </div>
    
                        <div class="text-center pt-1 mb-5 pb-1">
                        <button class="btn btn-primary btn-block fa-lg mb-3" type="submit">Log
                            in</button>
                        </div>
    
                    </form>
  
                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center">
                <img src="<?= asset('images/auth-back.png') ?>" class="auth-background" alt="img-auth">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
