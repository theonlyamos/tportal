<header id="m_header" class="m-grid__item m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
  <div class="m-container m-container--fluid m-container--full-height">
    <div class="m-stack m-stack--ver m-stack--desktop">

      <!-- BEGIN: Brand -->
      <div class="m-stack__item m-brand  m-brand--skin-dark ">
        <div class="m-stack m-stack--ver m-stack--general">
          <div class="m-stack__item m-stack__item--middle m-stack__item--center m-brand__logo">
            <a href="/admin" class="m-brand__logo-wrapper">
              <img alt="Logo" src="../assets/app/media/img/logos/logo.png" style="width: 50px; height: 50px;" />
            </a>
          </div>
          <div class="m-stack__item m-stack__item--middle m-brand__tools">

            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
            <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
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
        <!-- BEGIN: Topbar -->
        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
          <div class="m-stack__item m-topbar__nav-wrapper">
            <ul class="m-topbar__nav m-nav m-nav--inline">
              <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                m-dropdown-toggle="click">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                  <span class="m-topbar__userpic">
                    <img src="../assets/app/media/img/users/admin.png" alt="admin pic">
                  </span>
                </a>
                <div class="m-dropdown__wrapper">
                  <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                  <div class="m-dropdown__inner">
                    <div class="m-dropdown__header m--align-center" style="background: url(../assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                      <div class="m-card-user m-card-user--skin-dark">
                        <div class="m-card-user__pic">
                          <img src="../assets/app/media/img/users/admin.png" alt="admin pic" style="filter: invert(30%);"/>
                        </div>
                        <div class="m-card-user__details">
                          <strong class="text-secondary">
                            <?php
                            echo $_SESSION['user']['fullname'];
                            ?>
                          </strong>
                          <a href="" class="m-card-user__email m--font-weight-300 m-link text-secondary">
                            <?php
                              echo $_SESSION['user']['email'];
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
                            <a href="profile.php" class="m-nav__link">
                              <i class="m-nav__link-icon flaticon-profile-1"></i>
                              <span class="m-nav__link-title">
                                <span class="m-nav__link-wrap">
                                  <span class="m-nav__link-text">My Profile</span>
                                  <span class="m-nav__link-badge"><span class="m-badge m-badge--success">2</span></span>
                                </span>
                              </span>
                            </a>
                          </li>
                          <li class="m-nav__item">
                            <a href="profile.php" class="m-nav__link">
                              <i class="m-nav__link-icon flaticon-share"></i>
                              <span class="m-nav__link-text">Account Settings</span>
                            </a>
                          </li>
                          <li class="m-nav__separator m-nav__separator--fit">
                          </li>
                          <li class="m-nav__item">
                            <a href="/actions.php?name=logout" class="btn m-btn--pill btn-danger m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
<?php

if ($PAGE_TITLE == "Dashboard"){
  echo <<< _END
              <li id="m_quick_sidebar_toggle" class="m-nav__item">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                  <span class="m-nav__link-icon"><i class="flaticon-menu-button"></i></span>
                </a>
              </li>
_END;
}
?>
            </ul>
          </div>
        </div>

        <!-- END: Topbar -->
      </div>
    </div>
  </div>
</header>