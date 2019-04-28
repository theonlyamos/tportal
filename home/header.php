<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
  <div class="m-stack__item m-topbar__nav-wrapper">
  <ul class="m-topbar__nav m-nav m-nav--inline">
    <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
      <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
        <span class="m-nav__link-badge m-badge m-badge--metal">0</span>
        <span class="m-nav__link-icon"><i class="flaticon-alert-2"></i></span>
      </a>
      <div class="m-dropdown__wrapper">
        <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
        <div class="m-dropdown__inner">
          <div class="m-dropdown__header m--align-center" style="background: url(../assets/app/media/img/misc/notification_bg.jpg); background-size: cover;">
            <span class="m-dropdown__header-title">0 New</span>
            <span class="m-dropdown__header-subtitle">User Notifications</span>
          </div>
          <div class="m-dropdown__body">
            <div class="m-dropdown__content">
              <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                <li class="nav-item m-tabs__item">
                  <a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
                    Alerts
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
                  <div class="m-scrollable m-scroller" data-scrollable="true" data-height="250" data-mobile-height="200" style="height: 200px; overflow: auto;">
                    <div class="m-list-timeline m-list-timeline--skin-light">
                      <div class="m-list-timeline__items">
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </li>
    <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
      <a href="#" class="m-nav__link m-dropdown__toggle">
        <span class="m-topbar__userpic">
        <?php
          if ($_SESSION['user']['picture']){
            echo '<img src="../assets/data/profiles/'.$_SESSION['user']['picture'].'" alt="">';
          }
          else echo '<img src="../assets/app/media/img/users/neutral.png" alt="">';
        ?>
        </span>
      </a>
      <div class="m-dropdown__wrapper">
        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
        <div class="m-dropdown__inner">
          <div class="m-dropdown__header m--align-center" style="background: url(../assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
            <div class="m-card-user m-card-user--skin-dark">
              <div class="m-card-user__pic">
              <?php
                if ($_SESSION['user']['picture']){
                  echo '<img src="../assets/data/profiles/'.$_SESSION['user']['picture'].'" alt="">';
                }
                else echo '<img src="../assets/app/media/img/users/neutral.png" alt="">';
              ?>
              </div>
              <div class="m-card-user__details">
                <span class="m-card-user__name m--font-weight-500">
                <?php
                echo $_SESSION['user']['fullname'];
                ?>
                </span>
                <a href="" class="m-card-user__email m--font-weight-300 m-link">@
                <?php
                  echo $_SESSION['user']['username'];
                ?>
                </a>
              </div>
            </div>
          </div>
          <div class="m-dropdown__body">
            <div class="m-dropdown__content">
              <ul class="m-nav m-nav--skin-light">
                <li class="m-nav__section m--hide">
                  <span class="m-nav__section-text">Section</span>
                </li>
                <li class="m-nav__item">
                  <a href="/home" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-profile-1"></i>
                    <span class="m-nav__link-title">
                      <span class="m-nav__link-wrap">
                        <span class="m-nav__link-text">Home</span>
                      </span>
                    </span>
                  </a>
                </li>
                <li class="m-nav__item">
                  <a href="profile.php" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-share"></i>
                    <span class="m-nav__link-text">Profile</span>
                  </a>
                </li>
                <li class="m-nav__item">
                  <a href="account.php" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                    <span class="m-nav__link-text">Account Settings</span>
                  </a>
                </li>
                <li class="m-nav__separator m-nav__separator--fit">
                </li>
                <li class="m-nav__separator m-nav__separator--fit">
                </li>
                <li class="m-nav__item">
                  <a href="/actions.php?name=logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </li>
  </ul>
  </div>
  </div>