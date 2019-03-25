<?php

$name = explode(" ",$_SESSION['user']['fullname']);
$dob = $_SESSION['user']['dob'];
$profession = $_SESSION['user']['profession'];

echo <<< _END
<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
  <div class="m-portlet__head">
      <div class="m-portlet__head-tools">
          <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
              <li class="nav-item m-tabs__item">
                  <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                      <i class="flaticon-share m--hide"></i>
                      Update Profile
                  </a>
              </li>
          </ul>
      </div>
  </div>
  <div class="tab-content">
      <div class="tab-pane active" id="m_user_profile_tab_1">
          <form class="m-form m-form--fit m-form--label-align-right">
              <div class="m-portlet__body">
                  <div class="form-group m-form__group row">
                      <div class="col-10 ml-auto">
                          <h3 class="m-form__section">Profile Settings</h3>
                      </div>
                  </div>
                  <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">Firstname</label>
                      <div class="col-7">
                          <input class="form-control m-input" type="text" value="$name[0]" name="firstname" required>
                      </div>
                  </div>
                  <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">Firstname</label>
                      <div class="col-7">
                          <input class="form-control m-input" type="text" name="lastname" value="$name[1]" required>
                      </div>,
                  </div>
                  <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">Date of Birth</label>
                      <div class="col-7">
                          <input class="form-control m-input" type="date" value="$dob" name="dob", required>
                      </div>
                  </div>
                  <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">Gender</label>
                      <div class="col-7">
                          <div class="m-radio-inline">
                              <label class="m-radio">
_END;
if ($_SESSION['user']['gender'] == 'male'){
    echo '<input type="radio" value="male" name="gender" checked="checked"> Male';
}
else echo '<input type="radio" value="male" name="gender"> Male';

echo <<< _END
                                  
                                  <span></span>
                              </label>
                              <label class="m-radio">
                                  <input type="radio" value="female" name="gender"> Female
                                  <span></span>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">Level</label>
                      <div class="col-7">
                          <div class="m-radio-inline">
                              <label class="m-radio">
                                  <input type="radio" value="school" name="level"> School Level
                                  <span></span>
                              </label>
                              <label class="m-radio">
                                  <input type="radio" value="state" name="level"> State Level
                                  <span></span>
                              </label>
                              <label class="m-radio">
                                  <input type="radio" value="national" name="level"> National Level
                                  <span></span>
                              </label>
                          </div>
                      </div>
                  </div>
                  
                  <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">Address</label>
                      <div class="col-7">
                          <input class="form-control m-input" name="address" type="text" placeholder="L-12-20 Vertex, Cybersquare">
                      </div>
                  </div>
                  <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">Sports</label>
                      <div class="col-7">
                          <input class="form-control m-input" name="sports" type="text" value="Chess">
                      </div>
                  </div>
                  <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">Profession Type</label>
                      <div class="col-7">
                          <input class="form-control m-input" name="profession" type="text" value="$profession">
                      </div>
                  </div>
              </div>
              <div class="m-portlet__foot m-portlet__foot--fit">
                  <div class="m-form__actions">
                      <div class="row">
                          <div class="col-2">
                          </div>
                          <div class="col-7">
                              <button type="reset" class="btn btn-accent m-btn m-btn--air m-btn--custom">Save changes</button>&nbsp;&nbsp;
                              <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
      </div>
      <div class="tab-pane " id="m_user_profile_tab_2">
      </div>
      <div class="tab-pane " id="m_user_profile_tab_3">
      </div>
  </div>
</div>
_END;
?>