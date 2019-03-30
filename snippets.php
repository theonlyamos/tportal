
						<div class="row tournaments-section">
<?php

require_once '../functions.php';

$result = queryDB("SELECT * FROM posts WHERE type = 'tournament' ORDER BY createdAt DESC");

for ($j = 0; $j < $result->num_rows; ++$j){
	$result->data_seek($j);
	$tournament = $result->fetch_array(MYSQLI_ASSOC);

	echo <<< _END
              <div class="col-xl-4 col-lg-3 col-md-6">
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">
                  <div class="m-portlet__head m-portlet__head--fit">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-action">
                        <button type="button" class="btn btn-sm m-btn--pill  btn-primary"><i class="flaticon-placeholder-2"></i>$tournament[country]</button>
                      </div>
                    </div>
                  </div>
                  <div class="m-portlet__body">
                    <div class="m-widget19">
                      <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides">
                        <img src="../assets/app/media/img/bg/chess.png" alt="">
                        <h3 class="m-widget19__title m--font-light">
													$tournament[title]
                        </h3>
                        <div class="m-widget19__shadow"></div>
                      </div>
                      <div class="m-widget19__content">
                        <div class="m-widget19__header">
                          <div class="m-widget19__user-img">
                            <img class="m-widget19__img" src="../assets/app/media/img/users/neutral.png" alt="">
                          </div>
                          <div class="m-widget19__info">
                            <span class="m-widget19__username">
                              $tournament[author]
                            </span><br>
                            <span class="m-widget19__time">
                              $tournament[city]
                            </span>
                          </div>
                          <div class="m-widget19__stats">
                            <span class="m-widget19__number m--font-brand">
                              0
                            </span>
                            <span class="m-widget19__comment">
                              Registered
                            </span>
                          </div>
                        </div>
                        <div class="m-widget19__header row w-100">
													<table class="table table-striped table-borderless table-info col-12">
														<thead>
															<tr>
																<th>Start Dates</th>
																<th>End Dates</th>
															</tr>
														</thead>
														<tbody>
_END;
$startDates = unserialize($tournament['startDates']);
$endDates = unserialize($tournament['endDates']);
for ($k = 0; $k < sizeof($startDates); ++$k){
	echo "<tr><td>".$startDates[$k]."</td><td>".$endDates[$k]."</td></tr>";
}
echo <<< _END
														</tbody>
													</table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
							</div>
_END;
}
?>
            </div>




						<div class="row">
<?php

require_once '../functions.php';

$country = $_SESSION['user']['country'];

$result = queryDB("SELECT username, city, profession, picture, country FROM users WHERE country = '$country' ORDER BY createdAt DESC");

for ($j = 0; $j < $result->num_rows; ++$j){
	$result->data_seek($j);
	$user = $result->fetch_array(MYSQLI_ASSOC);

	echo <<< _END
              <div class="col-md-4 col-lg-3 col-xl-2">
                <div class="m-portlet" style="border-radius: 5px;">
									<div class="m-portlet__head p-0 justify-content-center" style="height: auto !important;">
_END;
if ($user['picture']) {
	echo '<img class="my-4" src="../assets/data/profiles/'.$user[picture].'" alt="" style="width: 100px; height: 100px; border-radius: 50%;">';
}
else echo '<img class="my-4" src="../assets/app/media/img/users/neutral.png" alt="" style="width: 100px; height: 100px; border-radius: 50%;">';
echo <<< _END
                  </div>
                  <div class="m-portlet__body p-0">
                    <div class="m-widget19">
                      <div class="m-widget19__content">
                        <div class="m-widget19__header">
                          <div class="m-widget19__info">
                            <span class="m-widget19__username">
                              @$user[username]
                            </span><br>
                            <span class="m-widget19__time">
                              $user[city]
														</span>
														<br>
                            <span class="m-widget19__time pt-3">
															Profession:
_END;
if ($user['profession'] == 'player') echo '<button type="button" class="btn btn-sm m-btn--pill btn-danger btn-brand"><i class="fa fa-football-ball fa-fw"></i>'.$user[profession].'</button>';
else if ($user['profession'] == 'arbiter') echo '<button type="button" class="btn btn-sm m-btn--pill btn-primary btn-brand"><i class="fa fa-flag fa-fw"></i>'.$user[profession].'</button>';
else if ($user['profession'] == 'coach') echo '<button type="button" class="btn btn-sm m-btn--pill btn-warning btn-brand"><i class="fa fa-user-check fa-fw"></i>'.$user[profession].'</button>';

echo <<< _END
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="m-portlet__foot p-0">
                    <a href="" target="_blank" class="btn m-btn--square btn-outline-dark border-0 w-100">View Profile</a>
                  </div>
                </div>
							</div>
_END;
}

$result->close()
?>

						</div>