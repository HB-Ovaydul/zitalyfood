<div id="password_tab" class="tab-pane fade">
            
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Change Password</h5>
            @include('validation.form')
            <div class="row">
                <div class="col-md-10 col-lg-6">
                    <form action="{{ route('change.password') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Old Password</label>
                            <input id="old_pass" name="old_pass" type="password" class="form-control">
                            <span><input id="show_pass" type="checkbox"> <label for="">Show Password</label></span>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input id="new_pass" name="pass" type="password" class="form-control">
                              <span><input id="s_pass" type="checkbox"> <label for="">Show Password</label></span>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input id="c_pass" name="pass_confirmation" type="password" class="form-control">
                              <span><input id="l_pass" type="checkbox"> <label for="">Show Password</label></span>
                        </div>
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>