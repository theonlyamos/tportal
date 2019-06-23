<?php

require_once '../functions.php';
require_once '../countries.php';

$email = $_SESSION['user']['email'];

$result = queryDB("SELECT email, country, fullname, picture, profession FROM users WHERE email != '$email'
AND completed=TRUE ORDER BY createdAt DESC LIMIT 5");

for ($j = 0; $j < $result->num_rows; ++$j){
	$result->data_seek($j);
	$user = $result->fetch_array(MYSQLI_ASSOC);
	$country = $countries[$user['country']];

echo <<< _END
								<div class="m-portlet m-portlet--bordered-semi m-portlet--rounded-force">
									<a href="">
										<div class="m-portlet__body p-1 px-2">
											<div class="m-widget19">
												<div class="m-widget19__content">
													<div class="m-widget19__header">
														<div class="m-widget19__user-img">
_END;
	if ($user['picture']){
		echo '<img class="m-widget19__img" src="../assets/data/profiles/'.$user['picture'].'" alt="">';
	}
	else echo '<img class="m-widget19__img" src="../assets/app/media/img/users/neutral.png" alt="">';
	echo <<< _END
														</div>
														<div class="m-widget19__info">
															<span class="m-widget19__username">
																$user[fullname]
															</span><br>
															<span class="m-widget19__time">
																$country
															</span>
														</div>
														<div class="m-widget19__stats">
															<span class="m-widget19__number m--font-brand">
_END;
if ($user['profession'] == 'player') echo '<i class="fa fa-user-graduate"></i>';
else if ($user['profession'] == 'coach') echo '<i class="fa fa-user-check"></i>';
if ($user['profession'] == 'arbiter') echo '<i class="fa fa-user-clock"></i>';
echo <<< _END
															</span>
															<span class="m-widget19__comment">
																$user[profession]
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
                  </a>
                </div>
_END;
}
$result->close();
?>