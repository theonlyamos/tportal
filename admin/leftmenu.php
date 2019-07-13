<?php
/**
 * Description
 * @authors theonlyamos (theonlyamos@gmail.com)
 * @date    2019-07-12 13:53:06
 * @version 1.0.0
 */

$menu = array(array("name"  => "Dashboard", 
                    "icon"  => "flaticon-line-graph",
                    "uri"   => "/admin"),
              array("name"  => "Tournaments", 
                    "icon"  => "flaticon-trophy",
                    "badge" => 2,
                    "uri"   => "tournaments.php"),
              array("name"  => "Users", 
                    "icon"  => "flaticon-users",
                    "badge" => "",
                    "uri"   => "users.php"), 
              array("name"  => "Organizations", 
                    "icon"  => "flaticon-map",
                    "badge" => "",
                    "uri"   => "organizations.php"),               
              array("name"  => "Bulk Uploaders", 
                    "icon"  => "fa fa-cloud-upload-alt",
                    "badge" => "",
                    "uri"   => "uploaders.php"),    
              array("name"  => "Reports", 
                    "icon"  => "flaticon-pie-chart",
                    "uri"   => "reports.php"),   
              array("name"  => "Feedback", 
                    "icon"  => "flaticon-share",
                    "badge" => "",
                    "uri"   => "feedback.php"), 
              array("name"  => "Support", 
                    "icon"  => "flaticon-info",
                    "badge" => "",
                    "uri"   => "support.php")      
);

for ($j = 0; $j < count($menu); ++$j){
  $menu_item = $menu[$j];

  if ($menu_item['name'] == $PAGE_TITLE){
    echo <<< _END
                  <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
                    <a href="$menu_item[uri]" class="m-menu__link">
                      <span class="m-menu__item-here"></span><i class="m-menu__link-icon $menu_item[icon]"></i>
                      <span class="m-menu__link-text">$menu_item[name]</span>
_END;
  }
  else {
    echo <<< _END
                  <li class="m-menu__item  m-menu__item" aria-haspopup="true">
                    <a href="$menu_item[uri]" class="m-menu__link">
                      <span class="m-menu__item-here"></span><i class="m-menu__link-icon $menu_item[icon]"></i>
                      <span class="m-menu__link-text">$menu_item[name]</span>
_END;
  }
  if (in_array("badge", $menu_item)) echo '<span class="m-menu__link-badge"><span class="m-badge m-badge--danger">'.$menu_item['badge'].'</span></span>';
  echo <<< _END
                  </a>
                </li>
_END;
}

?>