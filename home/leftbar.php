<div class="m-portlet m-portlet--full-height  ">
  <div class="m-portlet__body">
    <div class="m-card-profile">
      <div class="m-card-profile__pic">
        <div class="m-card-profile__pic-wrapper">
          <?php
            if ($_SESSION['user']['picture']){
              echo '<img src="../assets/data/profiles/'.$_SESSION['user']['picture'].'" alt="">';
            }
            else echo '<img src="../assets/app/media/img/users/neutral.png" alt="">';
          ?>
        </div>
      </div>
      <div class="m-card-profile__details">
        <span class="m-card-profile__name">
        <?php
            echo $_SESSION["user"]["fullname"];
        ?>
        </span>
        <a href="" class="m-card-profile__email m-link">
            <?php
            echo $_SESSION["user"]["email"];
            ?></a>
        <div>
          <a href="" class="m-card-profile__icon m-link">
            <i class="m-nav__link-icon flaticon-facebook-logo-button text-info"></i>
          </a>
          <a href="" class="m-card-profile__icon m-link">
            <i class="m-nav__link-icon flaticon-twitter-logo-button text-info"></i>
          </a>
          <a href="" class="m-card-profile__icon m-link">
            <i class="m-nav__link-icon flaticon-linkedin-logo text-info"></i>
          </a>
        </div>
      </div>
    </div>
    <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
      <li class="m-nav__separator m-nav__separator--fit"></li>
      <li class="m-nav__section m--hide">
        <span class="m-nav__section-text">Section</span>
      </li>
      <li class="m-nav__item">
        <a href="/home" class="m-nav__link">
          <i class="m-nav__link-icon flaticon-home"></i>
          <span class="m-nav__link-title">
            <span class="m-nav__link-wrap">
              <span class="m-nav__link-text" data-target="home.html">Home</span>
            </span>
          </span>
        </a>
      </li>
      <li class="m-nav__item">
        <a href="profile.php" class="m-nav__link">
          <i class="m-nav__link-icon flaticon-profile-1"></i>
          <span class="m-nav__link-title">
            <span class="m-nav__link-wrap">
              <span class="m-nav__link-text" data-target="profile.php">My Profile</span>
            </span>
          </span>
        </a>
      </li>
      <li class="m-nav__item">
        <a href="account.php" class="m-nav__link" data-target="acount.html">
          <i class="m-nav__link-icon flaticon-user-settings"></i>
          <span class="m-nav__link-text" data-target="account.html">Account Settings</span>
        </a>
      </li>
      <li class="m-nav__item">
        <a href="tournaments.php" class="m-nav__link" data-target="acount.html">
          <i class="m-nav__link-icon flaticon-trophy"></i>
          <span class="m-nav__link-text" data-target="account.html">Tournaments</span>
        </a>
      </li>
      <li class="m-nav__item">
        <a href="contact.php" class="m-nav__link">
          <i class="m-nav__link-icon flaticon-support"></i>
          <span class="m-nav__link-text" data-target="contact-us.html">Contact Us</span>
        </a>
      </li>
      <li class="m-nav__item">
        <a href="support.php" class="m-nav__link">
          <i class="m-nav__link-icon flaticon-questions-circular-button"></i>
          <span class="m-nav__link-text" data-target="support.html">Support</span>
        </a>
      </li>
      <li class="m-nav__item">
        <a href="feedback.php" class="m-nav__link">
          <i class="m-nav__link-icon flaticon-feed"></i>
          <span class="m-nav__link-text" data-target="feedback.html">Feedback</span>
        </a>
      </li>
    </ul>
  </div>
</div>