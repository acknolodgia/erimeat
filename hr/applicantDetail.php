<?php
$app = resume::readOne($_GET['Id']);
?>


<div class="row">
    <div class="col-md-12">
        <!-- Personal-Information -->
        <div class="card-box">
            <h4 class="header-title mt-0 m-b-20">Resume Detail</h4>
            <div class="panel-body">
                <div class="text-left">
                    <p class="text-muted font-13"><strong>First Name :</strong>
                      <span class="m-l-15"><?=$app->firstName;?></span>
                    </p>
                    <p class="text-muted font-13"><strong>Last Name :</strong>
                      <span class="m-l-15"><?=$app->lastName;?></span>
                    </p>
                </div>
            </div>
        </div>
        <!-- Personal-Information -->
        <div class="card-box">
        <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#schedule-modal">Schedule an Interview</button>
          <button class="btn btn-default stepy-finish"><a href="process.php?action=denyResume&Id=<?=$app->Id;?>">Deny</a></button>
        </div>
    </div>
  </div>

  <!-- Signup modal content -->
  <div id="schedule-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
          <div class="modal-content">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

              <div class="modal-body">
                  <h2 class="text-uppercase text-center m-b-30">
                      <a href="index.html" class="text-success">
                          <span><img src="assets/images/logo_dark.png" alt="" height="30"></span>
                      </a>
                  </h2>

                  <form class="form-horizontal" action="#">

                                          <div class="form-group account-btn text-center m-t-10">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                    </div>
                  </div>

                                        <div class="form-group account-btn text-center m-t-10">
                    <div class="input-group">
                          <input id="timepicker" type="text" class="form-control">
                          <span class="input-group-addon"><i class="mdi mdi-clock"></i></span>
                      </div>  </div>

                      <div class="form-group account-btn text-center m-t-10">
                          <div class="col-xs-12">
                              <button class="btn w-lg btn-rounded btn-lg btn-custom waves-effect waves-light" type="submit">Sign In</button>
                          </div>
                      </div>

                  </form>

              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
