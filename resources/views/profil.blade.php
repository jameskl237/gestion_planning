@extends($layouts)

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <!-- <div class="card"> -->
                    <div class="card author-box">
                        <div class="card-body">
                            <div class="author-box-center">
                                <img alt="image" src="assets/img/users/user-1.png"
                                    class="rounded-circle author-box-picture">
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <a href="#">{{ $user->name }}</a>
                                </div>
                                <div class="author-box-job">{{ $role->nom }}</div>
                            </div>
                            <div class="text-center">
                                <div class="author-box-description">
                                    <div class="card">
                                        <div class="card-header">

                                            <h4>Informations</h4>
                                        </div>
                                        <form action="{{ route('set_information') }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                                </div>
                                        
                                                <div class="form-group">
                                                    <label>Mot de passe actuel</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-lock"></i>
                                                            </div>
                                                        </div>
                                                        <input type="password" name="current_password" class="form-control pwstrength" data-indicator="pwindicator">
                                                    </div>
                                                </div>
                                        
                                                <div class="form-group">
                                                    <label>Nouveau mot de passe </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-lock"></i>
                                                            </div>
                                                        </div>
                                                        <input type="password" name="password" class="form-control pwstrength" data-indicator="pwindicator">
                                                    </div>
                                                </div>
                                        
                                                <div class="form-group">
                                                    <label>Confirmer le mot de passe </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-lock"></i>
                                                            </div>
                                                        </div>
                                                        <input type="password" name="password_confirmation" class="form-control pwstrength" data-indicator="pwindicator">
                                                    </div>
                                                </div>
                                        
                                                <div class="form-group">
                                                    <button type="submit" name="submit" id="submit" class="btn btn-primary m-t-15 waves-effect">Modifier</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                                <div class="w-100 d-sm-none"></div>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </section>
@endsection
