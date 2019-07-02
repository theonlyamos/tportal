<header id="m_header" class="m-grid__item m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
  <div class="m-container m-container--fluid m-container--full-height">
    <div class="m-stack m-stack--ver m-stack--desktop">

      <!-- BEGIN: Brand -->
      <div class="m-stack__item m-brand m-brand--skin-light">
        <div class="m-stack m-stack--ver m-stack--general">
          <div class="m-stack__item m-stack__item--middle m-stack__item--center m-brand__logo">
            <a href="index.html" class="m-brand__logo-wrapper">
              <img alt="" src="../../assets/app/media/img/logos/logo-chess.gif" style="width: 50px; height: 50px;">
            </a>
          </div>
          <div class="m-stack__item m-stack__item--middle m-brand__tools">
            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
            <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
              <span></span>
            </a>

            <!-- END -->

            <!-- BEGIN: Responsive Header Menu Toggler -->
            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
              <span></span>
            </a>

            <!-- END -->

            <!-- BEGIN: Topbar Toggler -->
            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
              <i class="flaticon-more"></i>
            </a>

            <!-- BEGIN: Topbar Toggler -->
          </div>
        </div>
      </div>

      <!-- END: Brand -->
      <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

        <!-- BEGIN: Horizontal Menu -->
        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
        <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark  d-flex align-items-center">
          <h3 style="color: #7b7e8a; font-weight: 100;">
            <?php
              echo '<i class="fa fa-fw '.$PAGE_ICON.'"></i> | ';
              echo '<span>'.$PAGE_TITLE.'</span>';
            ?>
          </h3>
        </div>

        <!-- END: Horizontal Menu -->

        <!-- BEGIN: Topbar -->
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
                        <li class="m-nav__separator m-nav__separator--fit">
                        </li>
                        <li class="m-nav__separator m-nav__separator--fit">
                        </li>
                        <li class="m-nav__item">
                          <a href="/actions.php?name=logout" class="btn btn-danger m-btn--pill m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
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
        <!-- END: Topbar -->
      </div>
    </div>
  </div>
</header>

