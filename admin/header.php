<header id="m_header" class="m-grid__item m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
  <div class="m-container m-container--fluid m-container--full-height">
    <div class="m-stack m-stack--ver m-stack--desktop">

      <!-- BEGIN: Brand -->
      <div class="m-stack__item m-brand  m-brand--skin-dark ">
        <div class="m-stack m-stack--ver m-stack--general">
          <div class="m-stack__item m-stack__item--middle m-stack__item--center m-brand__logo">
            <a href="index.html" class="m-brand__logo-wrapper">
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
              <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click"
                m-dropdown-persistent="1">
                <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                  <span class="m-nav__link-badge m-badge">0</span>
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
                          <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_msg" role="tab">Messages</a>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
                            <div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
                              <div class="m-list-timeline m-list-timeline--skin-light">
                                <div class="m-list-timeline__items">
                                  <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                    <span class="m-list-timeline__text"></span>
                                    <span class="m-list-timeline__time"></span>
                                  </div>
                                  <div class="m-list-timeline__item">
                                    <span class="m-list-timeline__badge"></span>
                                    <span class="m-list-timeline__text"><span class="m-badge m-badge--success m-badge--wide">pending</span></span>
                                    <span class="m-list-timeline__time"></span>
                                  </div>
                                  <div class="m-list-timeline__item m-list-timeline__item--read">
                                    <span class="m-list-timeline__badge"></span>
                                    <span href="" class="m-list-timeline__text"><span class="m-badge m-badge--danger m-badge--wide">urgent</span></span>
                                    <span class="m-list-timeline__time"></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane" id="topbar_notifications_msg" role="tabpanel">
                            <div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
                              <div class="m-stack__item m-stack__item--center m-stack__item--middle">
                                <span class="">All caught up!<br>No new logs.</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                m-dropdown-toggle="click">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                  <span class="m-topbar__userpic">
                    <img src="../assets/data/profiles/admin.png" alt="admin pic">
                  </span>
                </a>
                <div class="m-dropdown__wrapper">
                  <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                  <div class="m-dropdown__inner">
                    <div class="m-dropdown__header m--align-center" style="background: url(../assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                      <div class="m-card-user m-card-user--skin-dark">
                        <div class="m-card-user__pic">
                          <img src="../assets/data/profiles/admin.png" alt="admin pic" style="filter: invert(100%);">
                        </div>
                        <div class="m-card-user__details">
                          <strong class="text-white">
                            <?php
                            echo $_SESSION['user']['fullname'];
                            ?>
                          </strong>
                          <a href="" class="m-card-user__email m--font-weight-300 m-link text-white">@
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
                            <a href="profile.html" class="m-nav__link">
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
                            <a href="profile.html" class="m-nav__link">
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
            </ul>
          </div>
        </div>

        <!-- END: Topbar -->
      </div>
    </div>
  </div>
</header>